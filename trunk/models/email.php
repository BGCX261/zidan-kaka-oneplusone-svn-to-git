<?php
class email
{
	function email($info='')
	{
		$emilinfo=$info?$info:$GLOBALS['emailinfo'];
		
		include (ROOT_PATH.'/inc/email.class.php');
		$smtpserver = $emilinfo['smtp'];//SMTP服务器
		$smtpserverport =$emilinfo['port'];//SMTP服务器端口
		$smtpuser =$emilinfo['account'];//SMTP服务器的用户帐号
		$smtppass = $emilinfo['pass'];//SMTP服务器的用户密码
		$this->smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$this->smtpusermail=$emilinfo['email'];
		
	}
	function send($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype="HTML")
	{
		$smtpusermail=$smtpusermail?$smtpusermail:$this->smtpusermail;
		$this->smtp->debug = false;//是否显示发送的调试信息
		return $this->smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
	}
	
}