<?php

// Server key from Firebase Console
define( 'API_ACCESS_KEY', 'YOUR FIREBASE CLOUD MESSAGING API KEY' ); // Replace it with your Firebase Cloud Messaging server Key

if($_SERVER["REQUEST_METHOD"] == "POST")
{

// POST values
$token= $_POST["token"];
$title= $_POST["title"];
$message= $_POST["message"];
$postlink= $_POST["postlink"];

// Push Data's
$data = array(
"to" => "$token",
"notification" => array( 
"title" => "$title", 
"body" => "$message", 
"icon" => "https://example.com/icon.png", // replace it with your PUSH ICON URL
"click_action" => "$postlink")
);

// Print Output in JSON Format
$data_string = json_encode($data); 
     
// FCM API Token URL
$url = "https://fcm.googleapis.com/fcm/send";

//Curl Headers
$headers = array
(
     'Authorization: key=' . API_ACCESS_KEY, 
     'Content-Type: application/json'
);  

$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $url);                                                                 
curl_setopt($ch, CURLOPT_POST, 1);  
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                     
// Variable for Print the Result
$result = curl_exec($ch);

curl_close ($ch);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- meta character set -->
<meta charset="utf-8">

<!-- Always force latest IE rendering engine or request Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Mobile Specific Meta -->
<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>

<title>FCM Push Notification</title>
<meta name="Description" content="Subscribe to our Blog Post Updates.">
<link href='https://www.mskian.com/msk.ico' rel='icon' type='image/x-icon'/>

<!-- CSS and Fonts -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {
  background: #eee !important;
  font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  
}
.login-form{
	margin:3% auto 0;
	max-width:380px;
}
.login-form h1{
	font-size: 30pt;
	font-weight: 700;
    letter-spacing: -1px;
    font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}
.form-header,.form-footer{
	background-color: rgba(255, 255, 255, .8);
  	border: 1px solid rgba(0,0,0,0.1);
}
.form-signin{
	padding: 45px 35px 45px;
  	background-color: #fff;
  	border: 1px solid rgba(0,0,0,0.1);  
  	border-bottom: 0px; 
  	border-top: 0px;  
}
.form-register{
	padding: 45px 35px 45px;
  	background-color: #fff;
  	border: 1px solid rgba(0,0,0,0.1);  
  	border-bottom: 0px; 
  	border-top: 0px; 
}
.form-header{
	text-align: center;
	padding: 15px 40px;
	border-radius: 10px 10px 0 0;
}
.form-header i{font-size:60px;}
.form-footer {
	padding: 15px 40px;	
}
.form-signin-heading{
	margin-bottom: 30px;
}
.bt-login{
    background-color: #ff8627;
    color: #ffffff;
    padding-bottom: 10px;
    padding-top: 10px;
    transition: background-color 300ms linear 0s;
}
.form-signin .form-control, .form-register .form-control{
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus, .form-register .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
input.parsley-error,
select.parsley-error,
textarea.parsley-error {    
    border-color:#843534;
    box-shadow: none;
}
input.parsley-error:focus,
select.parsley-error:focus,
textarea.parsley-error:focus {    
    border-color:#843534;
    box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 6px #ce8483
}
.parsley-errors-list {
    list-style-type: none;
    opacity: 0;
    transition: all .3s ease-in;

    color: #d16e6c;
    margin-top: 5px;
    margin-bottom: 0;
  padding-left: 0;
}
.parsley-errors-list.filled {
    opacity: 1;
    color: #a94442;
}
</style>


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<body>
<br />

<div class="container">
<div class="login-form">
<h2 class="text-center">Send Push Notification</h2>
<div class="form-header">
<i class="fa fa-bell"></i>
</div>
<form class="form-signin" method="post">
<div class="form-group">
<textarea class="form-control" name="token" required data-parsley-trigger="keyup" placeholder="FCM Token"></textarea>
</div>
<div class="form-group">
<input class="form-control" type="text" name="title" required data-parsley-trigger="keyup" placeholder="Push Title">
</div>
<div class="form-group">
<textarea class="form-control" name="message" required data-parsley-trigger="keyup" placeholder="Push Message"></textarea>
</div>
<div class="form-group">
<input class="form-control" type="text" name="postlink" required data-parsley-trigger="keyup" placeholder="Click Action Link">
</div>
<button type="submit" class="btn btn-block bt-login">Send Push</button>
</form>
<br />
<br />
</div>
</div>

<div class="container">
<div class="row">
<div class="col-lg-6 col-lg-offset-3 text-center">
<?php
if(isset($_POST['token'])) {
// Display Output
echo "<p>&nbsp;</p>";
echo "<pre>$result</pre>";
echo "<pre>The Json Data : $data_string</pre>";
}
?>
</div>
</div>
</div>
<br />
<br />

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.5.1/parsley.min.js"></script>

<script>
$(document).ready(function(){
	$('form').parsley();
});
</script>


</body>
</html>