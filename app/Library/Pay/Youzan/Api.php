<?php
namespace App\Library\Pay\Youzan; use App\Library\Pay\ApiInterface; class Api implements ApiInterface { private $url_notify = ''; private $url_return = ''; public function __construct($sp7a2170) { $this->url_notify = SYS_URL_API . '/pay/notify/' . $sp7a2170; $this->url_return = SYS_URL . '/pay/return/' . $sp7a2170; } private function getAccessToken($sp54f11a) { $spae2649 = $sp54f11a['client_id']; $spf9b0fb = $sp54f11a['client_secret']; $sp506eb5 = array('kdt_id' => $sp54f11a['kdt_id']); $spfe67da = (new Open\Token($spae2649, $spf9b0fb))->getToken('self', $sp506eb5); if (!isset($spfe67da['access_token'])) { \Log::error('Pay.Youzan.goPay.getToken Error: ' . json_encode($spfe67da)); throw new \Exception('平台支付Token获取失败'); } return $spfe67da['access_token']; } function goPay($sp54f11a, $spd2bbfa, $sp942f8c, $spd86457, $sp5f71a2) { $sp8339d0 = strtolower($sp54f11a['payway']); try { $sp5b4958 = $this->getAccessToken($sp54f11a); $sp936877 = new Open\Client($sp5b4958); } catch (\Exception $spa0e498) { \Log::error('Pay.Youzan.goPay getAccessToken error', array('exception' => $spa0e498)); throw new \Exception('支付渠道响应超时，请刷新重试'); } $sp636f0e = array('qr_type' => 'QR_TYPE_DYNAMIC', 'qr_price' => $sp5f71a2, 'qr_name' => $sp942f8c, 'qr_source' => $spd2bbfa); $spfe67da = $sp936877->get('youzan.pay.qrcode.create', '3.0.0', $sp636f0e); $spfe67da = isset($spfe67da['response']) ? $spfe67da['response'] : $spfe67da; if (!isset($spfe67da['qr_url'])) { \Log::error('Pay.Youzan.goPay.getQrcode Error: ' . json_encode($spfe67da)); throw new \Exception('平台支付二维码获取失败'); } \App\Order::whereOrderNo($spd2bbfa)->update(array('pay_trade_no' => $spfe67da['qr_id'])); header('location: /qrcode/pay/' . $spd2bbfa . '/youzan_' . strtolower($sp8339d0) . '?url=' . urlencode($spfe67da['qr_url'])); die; } function verify($sp54f11a, $sp0a40c9) { $sp60916b = isset($sp54f11a['isNotify']) && $sp54f11a['isNotify']; $spae2649 = $sp54f11a['client_id']; $spf9b0fb = $sp54f11a['client_secret']; if ($sp60916b) { $spa2ee1e = file_get_contents('php://input'); $sp2bb3bd = json_decode($spa2ee1e, true); if (@$sp2bb3bd['test']) { echo 'test success'; return false; } try { $spfb4ab0 = $sp2bb3bd['msg']; } catch (\Exception $spa0e498) { \Log::error('Pay.Youzan.verify get input error#1', array('exception' => $spa0e498, 'post_raw' => $spa2ee1e)); echo 'fatal error'; return false; } $spc15242 = $spae2649 . '' . $spfb4ab0 . '' . $spf9b0fb; $spc768dc = md5($spc15242); if ($spc768dc != $sp2bb3bd['sign']) { \Log::error('Pay.Youzan.verify, sign error $sign_string:' . $spc15242 . ', $sign' . $spc768dc); echo 'fatal error'; return false; } else { echo json_encode(array('code' => 0, 'msg' => 'success')); } $spfb4ab0 = json_decode(urldecode($spfb4ab0), true); if ($sp2bb3bd['type'] === 'TRADE_ORDER_STATE' && $spfb4ab0['status'] === 'TRADE_SUCCESS') { try { $sp5b4958 = $this->getAccessToken($sp54f11a); $sp936877 = new Open\Client($sp5b4958); } catch (\Exception $spa0e498) { \Log::error('Pay.Youzan.verify getAccessToken error#1', array('exception' => $spa0e498)); echo 'fatal error'; return false; } $sp636f0e = array('tid' => $spfb4ab0['tid']); $spfe67da = $sp936877->get('youzan.trade.get', '3.0.0', $sp636f0e); if (isset($spfe67da['error_response'])) { \Log::error('Pay.Youzan.verify with error：' . $spfe67da['error_response']['msg']); echo 'fatal error'; return false; } $sp4ed5f7 = $spfe67da['response']['trade']; $spc73e3b = \App\Order::where('pay_trade_no', $sp4ed5f7['qr_id'])->first(); if ($spc73e3b) { $spf0058e = $spfb4ab0['tid']; $sp0a40c9($spc73e3b->order_no, intval($sp4ed5f7['payment'] * 100), $spf0058e); } } return true; } else { $spd2bbfa = @$sp54f11a['out_trade_no']; if (strlen($spd2bbfa) < 5) { throw new \Exception('交易单号未传入'); } $spc73e3b = \App\Order::whereOrderNo($spd2bbfa)->firstOrFail(); if (!$spc73e3b->pay_trade_no || !strlen($spc73e3b->pay_trade_no)) { return false; } try { $sp5b4958 = $this->getAccessToken($sp54f11a); $sp936877 = new Open\Client($sp5b4958); } catch (\Exception $spa0e498) { \Log::error('Pay.Youzan.verify getAccessToken error#2', array('exception' => $spa0e498)); throw new \Exception('支付渠道响应超时，请刷新重试'); } $sp636f0e = array('qr_id' => $spc73e3b->pay_trade_no, 'status' => 'TRADE_RECEIVED'); $spfe67da = $sp936877->get('youzan.trades.qr.get', '3.0.0', $sp636f0e); $sp1313a1 = isset($spfe67da['response']) ? $spfe67da['response'] : $spfe67da; if (!isset($sp1313a1['total_results'])) { \Log::error('Pay.Youzan.verify with error：The result of [youzan.trades.qr.get] has no key named [total_results]', array('result' => $spfe67da)); return false; } if ($sp1313a1['total_results'] > 0 && count($sp1313a1['qr_trades']) > 0 && isset($sp1313a1['qr_trades'][0]['qr_id']) && $sp1313a1['qr_trades'][0]['qr_id'] === $spc73e3b->pay_trade_no) { $sp35d213 = $sp1313a1['qr_trades'][0]; $spf0058e = $sp35d213['tid']; $sp0a40c9($spd2bbfa, intval($sp35d213['real_price'] * 100), $spf0058e); return true; } else { return false; } } } }