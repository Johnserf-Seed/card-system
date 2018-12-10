<?php
class AlipayMobilePublicAccountResetRequest { private $agreementId; private $bindAccountNo; private $bizContent; private $displayName; private $fromUserId; private $realName; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setAgreementId($sp57543d) { $this->agreementId = $sp57543d; $this->apiParas['agreement_id'] = $sp57543d; } public function getAgreementId() { return $this->agreementId; } public function setBindAccountNo($sp17a648) { $this->bindAccountNo = $sp17a648; $this->apiParas['bind_account_no'] = $sp17a648; } public function getBindAccountNo() { return $this->bindAccountNo; } public function setBizContent($spc7d01c) { $this->bizContent = $spc7d01c; $this->apiParas['biz_content'] = $spc7d01c; } public function getBizContent() { return $this->bizContent; } public function setDisplayName($sp510e5e) { $this->displayName = $sp510e5e; $this->apiParas['display_name'] = $sp510e5e; } public function getDisplayName() { return $this->displayName; } public function setFromUserId($speeae56) { $this->fromUserId = $speeae56; $this->apiParas['from_user_id'] = $speeae56; } public function getFromUserId() { return $this->fromUserId; } public function setRealName($sp253f95) { $this->realName = $sp253f95; $this->apiParas['real_name'] = $sp253f95; } public function getRealName() { return $this->realName; } public function getApiMethodName() { return 'alipay.mobile.public.account.reset'; } public function setNotifyUrl($sp57a09c) { $this->notifyUrl = $sp57a09c; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp076915) { $this->returnUrl = $sp076915; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp77cff5) { $this->terminalType = $sp77cff5; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spb66900) { $this->terminalInfo = $spb66900; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp7cadc0) { $this->prodCode = $sp7cadc0; } public function setApiVersion($sp06df85) { $this->apiVersion = $sp06df85; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp47bfc8) { $this->needEncrypt = $sp47bfc8; } public function getNeedEncrypt() { return $this->needEncrypt; } }