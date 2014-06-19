<?php
if(isset($_POST) ){
     
    //form validation vars
    $formok = true;
    $errors = array();
     
    //submission data
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y');
    $time = date('H:i:s');
     
    //form data
    $name = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $telephone = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);
    
        
    //php validation
    if(empty($name))
    {
    	$formok = false;
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter your name!'));
        die($output);
    }
   
 	if(empty($email))
	{
    	$formok = false;
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter your email address!'));
        die($output);
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$formok = false;
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
        die($output);
	}
	
 	
    if(empty($message))
    {
      $formok = false;
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a message!'));
        die($output);
    }
    elseif(strlen($message)<10)
    {
      $formok = false;
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a message longer than 10 characters!'));
        die($output);
    }
    
    //send email if all is ok
    if($formok)
    {
        $headers = "From: info@hmillie.com" . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        $emailbody = "<p>You have received a new message from the contact form on your website.</p>
                      <p><strong>Name: </strong> {$name} </p>
                      <p><strong>Email Address: </strong> {$email} </p>
                      <p><strong>Telephone: </strong> {$telephone} </p>
                      <p><strong>Message: </strong> {$message} </p>
                      <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";
         
        mail("hmillison@gmail.com","New Message!",$emailbody,$headers);
     	$output = json_encode(array('type'=>'message', 'text' => 'Thank you for your email. I will respond ASAP!'));
        die($output);    
    }
            
}
?>