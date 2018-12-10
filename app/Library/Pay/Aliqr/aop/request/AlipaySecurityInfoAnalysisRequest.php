<?php
class AlipaySecurityInfoAnalysisRequest { private $envClientBaseBand; private $envClientBaseStation; private $envClientCoordinates; private $envClientImei; private $envClientImsi; private $envClientIosUdid; private $envClientIp; private $envClientMac; private $envClientScreen; private $envClientUuid; private $jsTokenId; private $partnerId; private $sceneCode; private $userAccountNo; private $userBindBankcard; private $userBindBankcardType; private $userBindMobile; private $userIdentityType; private $userRealName; private $userRegDate; private $userRegEmail; private $userRegMobile; private $userrIdentityNo; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setEnvClientBaseBand($sp4f9c9c) { $this->envClientBaseBand = $sp4f9c9c; $this->apiParas['env_client_base_band'] = $sp4f9c9c; } public function getEnvClientBaseBand() { return $this->envClientBaseBand; } public function setEnvClientBaseStation($sp4bc731) { $this->envClientBaseStation = $sp4bc731; $this->apiParas['env_client_base_station'] = $sp4bc731; } public function getEnvClientBaseStation() { return $this->envClientBaseStation; } public function setEnvClientCoordinates($sp8572f9) { $this->envClientCoordinates = $sp8572f9; $this->apiParas['env_client_coordinates'] = $sp8572f9; } public function getEnvClientCoordinates() { return $this->envClientCoordinates; } public function setEnvClientImei($spa33dd7) { $this->envClientImei = $spa33dd7; $this->apiParas['env_client_imei'] = $spa33dd7; } public function getEnvClientImei() { return $this->envClientImei; } public function setEnvClientImsi($sp90881e) { $this->envClientImsi = $sp90881e; $this->apiParas['env_client_imsi'] = $sp90881e; } public function getEnvClientImsi() { return $this->envClientImsi; } public function setEnvClientIosUdid($spf48d28) { $this->envClientIosUdid = $spf48d28; $this->apiParas['env_client_ios_udid'] = $spf48d28; } public function getEnvClientIosUdid() { return $this->envClientIosUdid; } public function setEnvClientIp($sp88d3da) { $this->envClientIp = $sp88d3da; $this->apiParas['env_client_ip'] = $sp88d3da; } public function getEnvClientIp() { return $this->envClientIp; } public function setEnvClientMac($spc215d1) { $this->envClientMac = $spc215d1; $this->apiParas['env_client_mac'] = $spc215d1; } public function getEnvClientMac() { return $this->envClientMac; } public function setEnvClientScreen($sp16f3b1) { $this->envClientScreen = $sp16f3b1; $this->apiParas['env_client_screen'] = $sp16f3b1; } public function getEnvClientScreen() { return $this->envClientScreen; } public function setEnvClientUuid($spe464c4) { $this->envClientUuid = $spe464c4; $this->apiParas['env_client_uuid'] = $spe464c4; } public function getEnvClientUuid() { return $this->envClientUuid; } public function setJsTokenId($sp52e8ca) { $this->jsTokenId = $sp52e8ca; $this->apiParas['js_token_id'] = $sp52e8ca; } public function getJsTokenId() { return $this->jsTokenId; } public function setPartnerId($sp29c75c) { $this->partnerId = $sp29c75c; $this->apiParas['partner_id'] = $sp29c75c; } public function getPartnerId() { return $this->partnerId; } public function setSceneCode($sp6bcfec) { $this->sceneCode = $sp6bcfec; $this->apiParas['scene_code'] = $sp6bcfec; } public function getSceneCode() { return $this->sceneCode; } public function setUserAccountNo($sp39d9bf) { $this->userAccountNo = $sp39d9bf; $this->apiParas['user_account_no'] = $sp39d9bf; } public function getUserAccountNo() { return $this->userAccountNo; } public function setUserBindBankcard($spb30a2c) { $this->userBindBankcard = $spb30a2c; $this->apiParas['user_bind_bankcard'] = $spb30a2c; } public function getUserBindBankcard() { return $this->userBindBankcard; } public function setUserBindBankcardType($spe60e13) { $this->userBindBankcardType = $spe60e13; $this->apiParas['user_bind_bankcard_type'] = $spe60e13; } public function getUserBindBankcardType() { return $this->userBindBankcardType; } public function setUserBindMobile($spb715cd) { $this->userBindMobile = $spb715cd; $this->apiParas['user_bind_mobile'] = $spb715cd; } public function getUserBindMobile() { return $this->userBindMobile; } public function setUserIdentityType($spc22473) { $this->userIdentityType = $spc22473; $this->apiParas['user_identity_type'] = $spc22473; } public function getUserIdentityType() { return $this->userIdentityType; } public function setUserRealName($spdd3a44) { $this->userRealName = $spdd3a44; $this->apiParas['user_real_name'] = $spdd3a44; } public function getUserRealName() { return $this->userRealName; } public function setUserRegDate($sp1041ec) { $this->userRegDate = $sp1041ec; $this->apiParas['user_reg_date'] = $sp1041ec; } public function getUserRegDate() { return $this->userRegDate; } public function setUserRegEmail($spf10afd) { $this->userRegEmail = $spf10afd; $this->apiParas['user_reg_email'] = $spf10afd; } public function getUserRegEmail() { return $this->userRegEmail; } public function setUserRegMobile($sp60e2f9) { $this->userRegMobile = $sp60e2f9; $this->apiParas['user_reg_mobile'] = $sp60e2f9; } public function getUserRegMobile() { return $this->userRegMobile; } public function setUserrIdentityNo($spb809e4) { $this->userrIdentityNo = $spb809e4; $this->apiParas['userr_identity_no'] = $spb809e4; } public function getUserrIdentityNo() { return $this->userrIdentityNo; } public function getApiMethodName() { return 'alipay.security.info.analysis'; } public function setNotifyUrl($sp57a09c) { $this->notifyUrl = $sp57a09c; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp076915) { $this->returnUrl = $sp076915; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp77cff5) { $this->terminalType = $sp77cff5; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spb66900) { $this->terminalInfo = $spb66900; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp7cadc0) { $this->prodCode = $sp7cadc0; } public function setApiVersion($sp06df85) { $this->apiVersion = $sp06df85; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp47bfc8) { $this->needEncrypt = $sp47bfc8; } public function getNeedEncrypt() { return $this->needEncrypt; } }