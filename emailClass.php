<?php
class email{
	public $sendFrom = "";
	public $sendTo="";
	public $subject="";
	public $message="";
	
	
	//sets the information from the form into the variables
	//SETTERS
	function setSendFrom($inSendFrom)
	{
		$this->sendFrom = "From:".$inSendFrom. "\r\n";
	}
	
	function setSendTo($inSendTo)
	{
		$this->sendTo = $inSendTo;	
	}
	
	function setSubject($inSubject)
	{
		$this->subject= $inSubject;	
	}
	
	function setMessage($inMessage)
	{
		$inMessage = wordwrap($inMessage, 80);
		$inMessage = htmlentities($inMessage);
		$this->message= $inMessage;	
	}
	//END SETTERS
	
	//returns the information from the variables to the View
	//GETTERS
	function getSendFrom()
	{
		return $this->sendFrom;
	}
	function getSendTo()
	{
		return $this->sendTo;	
	}
	function getSubject()
	{
		return $this->subject;	
	}
	function getMessage()
	{
		return $this->message;	
	}
	//END GETTERS
	
	function sendMail() //Uses the mail function
	{
	if(mail($this->sendTo,$this->subject,$this->message,$this->sendFrom)){
			return "Your Email Has Been Sent!";
    }else{
       	 return "Something Went Wrong :-(";
    } //End If Statement
	} //End Send Mail Function
}// End Class
?>