<?php
require_once 'alipay_core.function.php'; require_once 'alipay_md5.function.php'; class AlipayNotify { var $https_verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&'; var $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?'; var $alipay_config; function __construct($spa44e81) { $this->alipay_config = $spa44e81; } function AlipayNotify($spa44e81) { $this->__construct($spa44e81); } function verifyNotify() { if (empty($_POST)) { return false; } else { $sp17ea0d = $this->getSignVeryfy($_POST, $_POST['sign']); $spd1a382 = 'false'; if (!empty($_POST['notify_id'])) { $spd1a382 = $this->getResponse($_POST['notify_id']); } if (preg_match('/true$/i', $spd1a382) && $sp17ea0d) { return true; } else { return false; } } } function verifyReturn() { if (empty($_GET)) { return false; } else { $sp17ea0d = $this->getSignVeryfy($_GET, $_GET['sign']); $spd1a382 = 'false'; if (!empty($_GET['notify_id'])) { $spd1a382 = $this->getResponse($_GET['notify_id']); } if (preg_match('/true$/i', $spd1a382) && $sp17ea0d) { return true; } else { return false; } } } function getSignVeryfy($sp93f5cb, $spc768dc) { $sp874f21 = paraFilter($sp93f5cb); $sp6ee5b2 = argSort($sp874f21); $sp985ba1 = createLinkString($sp6ee5b2); $sp36c2b9 = false; switch (strtoupper(trim($this->alipay_config['sign_type']))) { case 'MD5': $sp36c2b9 = md5Verify($sp985ba1, $spc768dc, $this->alipay_config['key']); break; default: $sp36c2b9 = false; } return $sp36c2b9; } function getResponse($sp9c5d2f) { $sp1188c8 = strtolower(trim($this->alipay_config['transport'])); $spdd370b = trim($this->alipay_config['partner']); $spfabee4 = ''; if ($sp1188c8 == 'https') { $spfabee4 = $this->https_verify_url; } else { $spfabee4 = $this->http_verify_url; } $spfabee4 = $spfabee4 . 'partner=' . $spdd370b . '&notify_id=' . $sp9c5d2f; $spd1a382 = getHttpResponseGET($spfabee4, $this->alipay_config['cacert']); return $spd1a382; } }