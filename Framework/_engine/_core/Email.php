<?php
namespace Framework\_engine\_core;
require_once($_SERVER['DOCUMENT_ROOT'] .'/Utilities/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

/**
 * Class: Email
 *    
 * This class emails messages from the server
 */
class Email{
	/**
	 * Create a new PHPMailer instance
	 *
	 * @access private
	 */
	private $mail = null;

	/**
  	 * Creates a Email object, sets all email variables into the message
  	 * 
  	 * @access public            
  	 */
 	public function __construct($To, $From, $Reply_To, $Subject, $Message, $smtpInfo){
 		$this->mail = new \PHPMailer();
 		$this->mail->isSMTP();
 		//Set the hostname of the mail server
		$this->mail->Host = $smtpInfo['host'];
		
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->mail->Port = $smtpInfo['port'];

		//Set the encryption system to use - ssl (deprecated) or tls
		$this->mail->SMTPSecure = 'tls';

		if($smtpInfo['auth']){
			$this->mail->SMTPAuth = true;
			//Username to use for SMTP authentication
			$this->mail->Username = $smtpInfo['username'];
			//Password to use for SMTP authentication
			$this->mail->Password = $smtpInfo['password'];
		} else {
			$this->mail->SMTPAuth = false;
		}
		//Set who the message is to be sent from
		$this->mail->setFrom($From['email'], $From['name']);

		//Set an alternative reply-to address
		$this->mail->addReplyTo($Reply_To['email'], $Reply_To['name']);

		//Set who the message is to be sent to
		$this->mail->addAddress($To['email'], $To['name']);
		$this->mail->Subject = $Subject;
		$this->mail->Body = $Message['body'];
		$this->mail->AltBody = $Message['altbody'];
 	}

 	/**
 	 * Sends email to one or many recipient addresses. Validates the addresses before sending out mail
 	 *
 	 * @access public
 	 */
 	public function sendEmail(){
 		//send the message, check for errors
		if (!$this->mail->send()) {
		    return "Mailer Error: " . $this->mail->ErrorInfo;
		} else {
		    return "Message sent!";
		}
 	}
}
?>