<?php
class email
{
	function email($info='')
	{
		$emilinfo=$info?$info:$GLOBALS['emailinfo'];
		
		include (ROOT_PATH.'/inc/email.class.php');
		$smtpserver = $emilinfo['smtp'];//SMTP������
		$smtpserverport =$emilinfo['port'];//SMTP�������˿�
		$smtpuser =$emilinfo['account'];//SMTP���������û��ʺ�
		$smtppass = $emilinfo['pass'];//SMTP���������û�����
		$this->smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
		$this->smtpusermail=$emilinfo['email'];
		
	}
	function send($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype="HTML")
	{
		$smtpusermail=$smtpusermail?$smtpusermail:$this->smtpusermail;
		$this->smtp->debug = false;//�Ƿ���ʾ���͵ĵ�����Ϣ
		return $this->smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
	}
	
}