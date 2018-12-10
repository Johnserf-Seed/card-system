<?php
class AlipayAcquireRefundRequest { private $operatorId; private $operatorType; private $outRequestNo; private $outTradeNo; private $refIds; private $refundAmount; private $refundReason; private $tradeNo; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setOperatorId($sp517618) { $this->operatorId = $sp517618; $this->apiParas['operator_id'] = $sp517618; } public function getOperatorId() { return $this->operatorId; } public function setOperatorType($spabeefb) { $this->operatorType = $spabeefb; $this->apiParas['operator_type'] = $spabeefb; } public function getOperatorType() { return $this->operatorType; } public function setOutRequestNo($spea8901) { $this->outRequestNo = $spea8901; $this->apiParas['out_request_no'] = $spea8901; } public function getOutRequestNo() { return $this->outRequestNo; } public function setOutTradeNo($sp9489f3) { $this->outTradeNo = $sp9489f3; $this->apiParas['out_trade_no'] = $sp9489f3; } public function getOutTradeNo() { return $this->outTradeNo; } public function setRefIds($sp85c250) { $this->refIds = $sp85c250; $this->apiParas['ref_ids'] = $sp85c250; } public function getRefIds() { return $this->refIds; } public function setRefundAmount($spdf2b93) { $this->refundAmount = $spdf2b93; $this->apiParas['refund_amount'] = $spdf2b93; } public function getRefundAmount() { return $this->refundAmount; } public function setRefundReason($spd67ef9) { $this->refundReason = $spd67ef9; $this->apiParas['refund_reason'] = $spd67ef9; } public function getRefundReason() { return $this->refundReason; } public function setTradeNo($spb79a48) { $this->tradeNo = $spb79a48; $this->apiParas['trade_no'] = $spb79a48; } public function getTradeNo() { return $this->tradeNo; } public function getApiMethodName() { return 'alipay.acquire.refund'; } public function setNotifyUrl($sp57a09c) { $this->notifyUrl = $sp57a09c; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp076915) { $this->returnUrl = $sp076915; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp77cff5) { $this->terminalType = $sp77cff5; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spb66900) { $this->terminalInfo = $spb66900; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp7cadc0) { $this->prodCode = $sp7cadc0; } public function setApiVersion($sp06df85) { $this->apiVersion = $sp06df85; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp47bfc8) { $this->needEncrypt = $sp47bfc8; } public function getNeedEncrypt() { return $this->needEncrypt; } }