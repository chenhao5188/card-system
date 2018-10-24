<?php
require_once 'WxPay.Exception.php'; require_once 'WxPay.Config.php'; require_once 'WxPay.Data.php'; class WxPayApi { public static function unifiedOrder($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/pay/unifiedorder'; if (!$spd139aa->IsOut_trade_noSet()) { throw new WxPayException('缺少统一支付接口必填参数out_trade_no！'); } else { if (!$spd139aa->IsBodySet()) { throw new WxPayException('缺少统一支付接口必填参数body！'); } else { if (!$spd139aa->IsTotal_feeSet()) { throw new WxPayException('缺少统一支付接口必填参数total_fee！'); } else { if (!$spd139aa->IsTrade_typeSet()) { throw new WxPayException('缺少统一支付接口必填参数trade_type！'); } } } } if ($spd139aa->GetTrade_type() == 'JSAPI' && !$spd139aa->IsOpenidSet()) { throw new WxPayException('统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！'); } if ($spd139aa->GetTrade_type() == 'NATIVE' && !$spd139aa->IsProduct_idSet()) { throw new WxPayException('统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！'); } if (!$spd139aa->IsNotify_urlSet()) { $spd139aa->SetNotify_url(WxPayConfig::NOTIFY_URL); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function orderQuery($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/pay/orderquery'; if (!$spd139aa->IsOut_trade_noSet() && !$spd139aa->IsTransaction_idSet()) { throw new WxPayException('订单查询接口中，out_trade_no、transaction_id至少填一个！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function closeOrder($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/pay/closeorder'; if (!$spd139aa->IsOut_trade_noSet()) { throw new WxPayException('订单查询接口中，out_trade_no必填！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function refund($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/secapi/pay/refund'; if (!$spd139aa->IsOut_trade_noSet() && !$spd139aa->IsTransaction_idSet()) { throw new WxPayException('退款申请接口中，out_trade_no、transaction_id至少填一个！'); } else { if (!$spd139aa->IsOut_refund_noSet()) { throw new WxPayException('退款申请接口中，缺少必填参数out_refund_no！'); } else { if (!$spd139aa->IsTotal_feeSet()) { throw new WxPayException('退款申请接口中，缺少必填参数total_fee！'); } else { if (!$spd139aa->IsRefund_feeSet()) { throw new WxPayException('退款申请接口中，缺少必填参数refund_fee！'); } else { if (!$spd139aa->IsOp_user_idSet()) { throw new WxPayException('退款申请接口中，缺少必填参数op_user_id！'); } } } } } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, true, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function refundQuery($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/pay/refundquery'; if (!$spd139aa->IsOut_refund_noSet() && !$spd139aa->IsOut_trade_noSet() && !$spd139aa->IsTransaction_idSet() && !$spd139aa->IsRefund_idSet()) { throw new WxPayException('退款查询接口中，out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function downloadBill($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/pay/downloadbill'; if (!$spd139aa->IsBill_dateSet()) { throw new WxPayException('对账单接口中，缺少必填参数bill_date！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); if (substr($sp5241d0, 0, 5) == '<xml>') { return ''; } return $sp5241d0; } public static function micropay($spd139aa, $sp2006c7 = 10) { $spdfc1ea = 'https://api.mch.weixin.qq.com/pay/micropay'; if (!$spd139aa->IsBodySet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数body！'); } else { if (!$spd139aa->IsOut_trade_noSet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数out_trade_no！'); } else { if (!$spd139aa->IsTotal_feeSet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数total_fee！'); } else { if (!$spd139aa->IsAuth_codeSet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数auth_code！'); } } } } $spd139aa->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']); $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function reverse($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/secapi/pay/reverse'; if (!$spd139aa->IsOut_trade_noSet() && !$spd139aa->IsTransaction_idSet()) { throw new WxPayException('撤销订单API接口中，参数out_trade_no和transaction_id必须填写一个！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, true, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function report($spd139aa, $sp2006c7 = 1) { $spdfc1ea = 'https://api.mch.weixin.qq.com/payitil/report'; if (!$spd139aa->IsInterface_urlSet()) { throw new WxPayException('接口URL，缺少必填参数interface_url！'); } if (!$spd139aa->IsReturn_codeSet()) { throw new WxPayException('返回状态码，缺少必填参数return_code！'); } if (!$spd139aa->IsResult_codeSet()) { throw new WxPayException('业务结果，缺少必填参数result_code！'); } if (!$spd139aa->IsUser_ipSet()) { throw new WxPayException('访问接口IP，缺少必填参数user_ip！'); } if (!$spd139aa->IsExecute_time_Set()) { throw new WxPayException('接口耗时，缺少必填参数execute_time_！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetUser_ip($_SERVER['REMOTE_ADDR']); $spd139aa->SetTime(date('YmdHis')); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); return $sp5241d0; } public static function bizpayurl($spd139aa, $sp2006c7 = 6) { if (!$spd139aa->IsProduct_idSet()) { throw new WxPayException('生成二维码，缺少必填参数product_id！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetTime_stamp(time()); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); return $spd139aa->GetValues(); } public static function shorturl($spd139aa, $sp2006c7 = 6) { $spdfc1ea = 'https://api.mch.weixin.qq.com/tools/shorturl'; if (!$spd139aa->IsLong_urlSet()) { throw new WxPayException('需要转换的URL，签名用原串，传输需URL encode！'); } $spd139aa->SetAppid(WxPayConfig::APPID); $spd139aa->SetMch_id(WxPayConfig::MCHID); $spd139aa->SetNonce_str(self::getNonceStr()); $spd139aa->SetSign(); $sp12ef03 = $spd139aa->ToXml(); $spf3487d = self::getMillisecond(); $sp5241d0 = self::postXmlCurl($sp12ef03, $spdfc1ea, false, $sp2006c7); $spbcb528 = WxPayResults::Init($sp5241d0); self::reportCostTime($spdfc1ea, $spf3487d, $spbcb528); return $spbcb528; } public static function notify($sp9a1eb3, &$spbfa8f4) { $sp12ef03 = file_get_contents('php://input'); try { $spbcb528 = WxPayResults::Init($sp12ef03); } catch (WxPayException $sp2a4a9a) { $spbfa8f4 = $sp2a4a9a->errorMessage(); return false; } return call_user_func($sp9a1eb3, $spbcb528); } public static function getNonceStr($sp58d92e = 32) { $spa9e43c = 'abcdefghijklmnopqrstuvwxyz0123456789'; $spb67857 = ''; for ($sp1b7341 = 0; $sp1b7341 < $sp58d92e; $sp1b7341++) { $spb67857 .= substr($spa9e43c, mt_rand(0, strlen($spa9e43c) - 1), 1); } return $spb67857; } public static function replyNotify($sp12ef03) { echo $sp12ef03; } private static function reportCostTime($spdfc1ea, $spf3487d, $sp1835de) { if (WxPayConfig::REPORT_LEVENL == 0) { return; } if (WxPayConfig::REPORT_LEVENL == 1 && array_key_exists('return_code', $sp1835de) && $sp1835de['return_code'] == 'SUCCESS' && array_key_exists('result_code', $sp1835de) && $sp1835de['result_code'] == 'SUCCESS') { return; } $spa57f73 = self::getMillisecond(); $sp2d9894 = new WxPayReport(); $sp2d9894->SetInterface_url($spdfc1ea); $sp2d9894->SetExecute_time_($spa57f73 - $spf3487d); if (array_key_exists('return_code', $sp1835de)) { $sp2d9894->SetReturn_code($sp1835de['return_code']); } if (array_key_exists('return_msg', $sp1835de)) { $sp2d9894->SetReturn_msg($sp1835de['return_msg']); } if (array_key_exists('result_code', $sp1835de)) { $sp2d9894->SetResult_code($sp1835de['result_code']); } if (array_key_exists('err_code', $sp1835de)) { $sp2d9894->SetErr_code($sp1835de['err_code']); } if (array_key_exists('err_code_des', $sp1835de)) { $sp2d9894->SetErr_code_des($sp1835de['err_code_des']); } if (array_key_exists('out_trade_no', $sp1835de)) { $sp2d9894->SetOut_trade_no($sp1835de['out_trade_no']); } if (array_key_exists('device_info', $sp1835de)) { $sp2d9894->SetDevice_info($sp1835de['device_info']); } try { self::report($sp2d9894); } catch (WxPayException $sp2a4a9a) { } } private static function postXmlCurl($sp12ef03, $spdfc1ea, $sp32289c = false, $sp4dca5e = 30) { $spde874d = curl_init(); curl_setopt($spde874d, CURLOPT_TIMEOUT, $sp4dca5e); if (WxPayConfig::CURL_PROXY_HOST != '0.0.0.0' && WxPayConfig::CURL_PROXY_PORT != 0) { curl_setopt($spde874d, CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST); curl_setopt($spde874d, CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT); } curl_setopt($spde874d, CURLOPT_URL, $spdfc1ea); curl_setopt($spde874d, CURLOPT_SSL_VERIFYPEER, TRUE); curl_setopt($spde874d, CURLOPT_SSL_VERIFYHOST, 2); curl_setopt($spde874d, CURLOPT_HEADER, FALSE); curl_setopt($spde874d, CURLOPT_RETURNTRANSFER, TRUE); if ($sp32289c == true) { curl_setopt($spde874d, CURLOPT_SSLCERTTYPE, 'PEM'); curl_setopt($spde874d, CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH); curl_setopt($spde874d, CURLOPT_SSLKEYTYPE, 'PEM'); curl_setopt($spde874d, CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH); } else { curl_setopt($spde874d, CURLOPT_SSL_VERIFYPEER, false); } curl_setopt($spde874d, CURLOPT_POST, TRUE); curl_setopt($spde874d, CURLOPT_POSTFIELDS, $sp12ef03); $sp1835de = curl_exec($spde874d); if ($sp1835de) { curl_close($spde874d); return $sp1835de; } else { $sp6980f9 = curl_errno($spde874d); \Log::error('WxPat.Api.postXmlCurl Error: ' . curl_error($spde874d)); curl_close($spde874d); throw new WxPayException("curl出错，错误码: {$sp6980f9}"); } } private static function getMillisecond() { $spd2330d = explode(' ', microtime()); $spd2330d = $spd2330d[1] . $spd2330d[0] * 1000; $spd114f9 = explode('.', $spd2330d); $spd2330d = $spd114f9[0]; return $spd2330d; } }