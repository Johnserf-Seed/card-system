<?php
class WxPayNotify extends WxPayNotifyReply { public final function Handle($spb2032b = true) { $spfe67da = WxpayApi::notify(array($this, 'NotifyCallBack'), $spfb4ab0); if ($spfe67da == false) { $this->SetReturn_code('FAIL'); $this->SetReturn_msg($spfb4ab0); $this->ReplyNotify(false); return; } else { $this->SetReturn_code('SUCCESS'); $this->SetReturn_msg('OK'); } $this->ReplyNotify($spb2032b); } public function NotifyProcess($sp2bb3bd, &$spfb4ab0) { return true; } public final function NotifyCallBack($sp2bb3bd) { $spfb4ab0 = 'OK'; $spfe67da = $this->NotifyProcess($sp2bb3bd, $spfb4ab0); if ($spfe67da == true) { $this->SetReturn_code('SUCCESS'); $this->SetReturn_msg('OK'); } else { $this->SetReturn_code('FAIL'); $this->SetReturn_msg($spfb4ab0); } return $spfe67da; } private final function ReplyNotify($spb2032b = true) { if ($spb2032b == true && $this->GetReturn_code() == 'SUCCESS') { $this->SetSign(); } WxpayApi::replyNotify($this->ToXml()); } }