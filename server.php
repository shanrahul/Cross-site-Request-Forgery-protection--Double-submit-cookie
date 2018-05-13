<?php

session_start();
	function loginvalidater($user_CSRF,$user_sessionID,$username,$password)
	{
	  if( $user_CSRF==$_COOKIE['csrftoken']&& $user_sessionID==session_id() && $username == 'admin' && $password == '123' )
	  {
			echo "<script> alert('Login Sucessfull!!') </script>";
	  	echo "Welcome User "."</br>";
			echo "Visit ".'<a href="https://blackwolftech08.blogspot.com/", target="_blank" >'. "blackwolftech08" ."</a>"." For Tutorial";

	  }
	  else
	  {
			echo"<script> alert('Login Failed') </script>";
		  }
	}

	if(isset ($_POST["submt"]))
	{
 ob_end_clean();

loginvalidater($_POST['csrf'],$_COOKIE['session_id'],$_POST['username'],$_POST['password']);
	}


?>
