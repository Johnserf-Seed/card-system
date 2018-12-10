<?php
class HttpClient { var $host; var $port; var $path; var $method; var $postdata = ''; var $cookies = array(); var $referer; var $accept = 'text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*'; var $accept_encoding = 'gzip'; var $accept_language = 'en-us'; var $user_agent = 'Incutio HttpClient v0.9'; var $timeout = 20; var $use_gzip = true; var $persist_cookies = true; var $persist_referers = true; var $debug = false; var $handle_redirects = true; var $max_redirects = 5; var $headers_only = false; var $username; var $password; var $status; var $headers = array(); var $content = ''; var $errormsg; var $redirect_count = 0; var $cookie_host = ''; function __construct($sp062847, $spe4db2b = 80) { $this->host = $sp062847; $this->port = $spe4db2b; } function get($sp20529e, $sp2bb3bd = false) { $this->path = $sp20529e; $this->method = 'GET'; if ($sp2bb3bd) { $this->path .= '?' . $this->buildQueryString($sp2bb3bd); } return $this->doRequest(); } function post($sp20529e, $sp2bb3bd) { $this->path = $sp20529e; $this->method = 'POST'; $this->postdata = $this->buildQueryString($sp2bb3bd); return $this->doRequest(); } function buildQueryString($sp2bb3bd) { $sp88b9f9 = ''; if (is_array($sp2bb3bd)) { foreach ($sp2bb3bd as $spc95936 => $spfa4469) { if (is_array($spfa4469)) { foreach ($spfa4469 as $sp1188fa) { $sp88b9f9 .= urlencode($spc95936) . '=' . $sp1188fa . '&'; } } else { $sp88b9f9 .= urlencode($spc95936) . '=' . $spfa4469 . '&'; } } $sp88b9f9 = substr($sp88b9f9, 0, -1); } else { $sp88b9f9 = $sp2bb3bd; } return $sp88b9f9; } function doRequest() { if (!($sp7e03f4 = @fsockopen($this->host, $this->port, $sp50780f, $spf6b08c, $this->timeout))) { switch ($sp50780f) { case -3: $this->errormsg = 'Socket creation failed (-3)'; break; case -4: $this->errormsg = 'DNS lookup failure (-4)'; break; case -5: $this->errormsg = 'Connection refused or timed out (-5)'; break; default: $this->errormsg = 'Connection failed (' . $sp50780f . ')'; $this->errormsg .= ' ' . $spf6b08c; $this->debug($this->errormsg); } return false; } socket_set_timeout($sp7e03f4, $this->timeout); $spceaf29 = $this->buildRequest(); $this->debug('Request', $spceaf29); fwrite($sp7e03f4, $spceaf29); $this->headers = array(); $this->content = ''; $this->errormsg = ''; $sp1e9782 = true; $sp602f62 = true; while (!feof($sp7e03f4)) { $sp7c6222 = fgets($sp7e03f4, 4096); if ($sp602f62) { $sp602f62 = false; if (!preg_match('/HTTP\\/(\\d\\.\\d)\\s*(\\d+)\\s*(.*)/', $sp7c6222, $sp817c50)) { $this->errormsg = 'Status code line invalid: ' . htmlentities($sp7c6222); $this->debug($this->errormsg); return false; } $this->status = $sp817c50[2]; $this->debug(trim($sp7c6222)); continue; } if ($sp1e9782) { if (trim($sp7c6222) == '') { $sp1e9782 = false; $this->debug('Received Headers', $this->headers); if ($this->headers_only) { break; } continue; } if (!preg_match('/([^:]+):\\s*(.*)/', $sp7c6222, $sp817c50)) { continue; } $spc95936 = strtolower(trim($sp817c50[1])); $spfa4469 = trim($sp817c50[2]); if (isset($this->headers[$spc95936])) { if (is_array($this->headers[$spc95936])) { $this->headers[$spc95936][] = $spfa4469; } else { $this->headers[$spc95936] = array($this->headers[$spc95936], $spfa4469); } } else { $this->headers[$spc95936] = $spfa4469; } continue; } $this->content .= $sp7c6222; } fclose($sp7e03f4); if (isset($this->headers['content-encoding']) && $this->headers['content-encoding'] == 'gzip') { $this->debug('Content is gzip encoded, unzipping it'); $this->content = substr($this->content, 10); $this->content = gzinflate($this->content); } if ($this->persist_cookies && isset($this->headers['set-cookie']) && $this->host == $this->cookie_host) { $sp49db5b = $this->headers['set-cookie']; if (!is_array($sp49db5b)) { $sp49db5b = array($sp49db5b); } foreach ($sp49db5b as $sp57b59a) { if (preg_match('/([^=]+)=([^;]+);/', $sp57b59a, $sp817c50)) { $this->cookies[$sp817c50[1]] = $sp817c50[2]; } } $this->cookie_host = $this->host; } if ($this->persist_referers) { $this->debug('Persisting referer: ' . $this->getRequestURL()); $this->referer = $this->getRequestURL(); } if ($this->handle_redirects) { if (++$this->redirect_count >= $this->max_redirects) { $this->errormsg = 'Number of redirects exceeded maximum (' . $this->max_redirects . ')'; $this->debug($this->errormsg); $this->redirect_count = 0; return false; } $spbc6168 = isset($this->headers['location']) ? $this->headers['location'] : ''; $spee54e9 = isset($this->headers['uri']) ? $this->headers['uri'] : ''; if ($spbc6168 || $spee54e9) { $spadfef0 = parse_url($spbc6168 . $spee54e9); return $this->get($spadfef0['path']); } } return true; } function buildRequest() { $spfc203b = array(); $spfc203b[] = "{$this->method} {$this->path} HTTP/1.0"; $spfc203b[] = "Host: {$this->host}"; $spfc203b[] = "User-Agent: {$this->user_agent}"; $spfc203b[] = "Accept: {$this->accept}"; if ($this->use_gzip) { $spfc203b[] = "Accept-encoding: {$this->accept_encoding}"; } $spfc203b[] = "Accept-language: {$this->accept_language}"; if ($this->referer) { $spfc203b[] = "Referer: {$this->referer}"; } if ($this->cookies) { $sp57b59a = 'Cookie: '; foreach ($this->cookies as $spc95936 => $sp4d089d) { $sp57b59a .= "{$spc95936}={$sp4d089d}; "; } $spfc203b[] = $sp57b59a; } if ($this->username && $this->password) { $spfc203b[] = 'Authorization: BASIC ' . base64_encode($this->username . ':' . $this->password); } if ($this->postdata) { $spfc203b[] = 'Content-Type: application/x-www-form-urlencoded'; $spfc203b[] = 'Content-Length: ' . strlen($this->postdata); } $spceaf29 = implode('
', $spfc203b) . '

' . $this->postdata; return $spceaf29; } function getStatus() { return $this->status; } function getContent() { return $this->content; } function getHeaders() { return $this->headers; } function getHeader($spcfb29a) { $spcfb29a = strtolower($spcfb29a); if (isset($this->headers[$spcfb29a])) { return $this->headers[$spcfb29a]; } else { return false; } } function getError() { return $this->errormsg; } function getCookies() { return $this->cookies; } function getRequestURL() { $spadfef0 = 'http://' . $this->host; if ($this->port != 80) { $spadfef0 .= ':' . $this->port; } $spadfef0 .= $this->path; return $spadfef0; } function setUserAgent($sp0af8e2) { $this->user_agent = $sp0af8e2; } function setAuthorization($spe2328e, $sp22d3ef) { $this->username = $spe2328e; $this->password = $sp22d3ef; } function setCookies($sp0f09dd) { $this->cookies = $sp0f09dd; } function useGzip($spc9e7be) { $this->use_gzip = $spc9e7be; } function setPersistCookies($spc9e7be) { $this->persist_cookies = $spc9e7be; } function setPersistReferers($spc9e7be) { $this->persist_referers = $spc9e7be; } function setHandleRedirects($spc9e7be) { $this->handle_redirects = $spc9e7be; } function setMaxRedirects($spe63642) { $this->max_redirects = $spe63642; } function setHeadersOnly($spc9e7be) { $this->headers_only = $spc9e7be; } function setDebug($spc9e7be) { $this->debug = $spc9e7be; } function quickGet($spadfef0) { $sp1cf170 = parse_url($spadfef0); $sp062847 = $sp1cf170['host']; $spe4db2b = isset($sp1cf170['port']) ? $sp1cf170['port'] : 80; $sp20529e = isset($sp1cf170['path']) ? $sp1cf170['path'] : '/'; if (isset($sp1cf170['query'])) { $sp20529e .= '?' . $sp1cf170['query']; } $sp936877 = new HttpClient($sp062847, $spe4db2b); if (!$sp936877->get($sp20529e)) { return false; } else { return $sp936877->getContent(); } } static function quickPost($spadfef0, $sp2bb3bd) { $sp1cf170 = parse_url($spadfef0); $sp062847 = $sp1cf170['host']; $spe4db2b = isset($sp1cf170['port']) ? $sp1cf170['port'] : 80; $sp20529e = isset($sp1cf170['path']) ? $sp1cf170['path'] : '/'; $sp936877 = new HttpClient($sp062847, $spe4db2b); if (!$sp936877->post($sp20529e, $sp2bb3bd)) { return false; } else { return $sp936877->getContent(); } } function debug($spfb4ab0, $sp1b616a = false) { if ($this->debug) { print '<div style="border: 1px solid red; padding: 0.5em; margin: 0.5em;"><strong>HttpClient Debug:</strong> ' . $spfb4ab0; if ($sp1b616a) { ob_start(); print_r($sp1b616a); $spb0c78a = htmlentities(ob_get_contents()); ob_end_clean(); print '<pre>' . $spb0c78a . '</pre>'; } print '</div>'; } } }