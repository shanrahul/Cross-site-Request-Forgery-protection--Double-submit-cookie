<?php
    //start a session - users browser
    session_start();
    //setting a cookie
    $sessionID = session_id(); //storing session id
    //generate CSRF token
    if(empty($_SESSION['key']))
    {
        $_SESSION['key']=bin2hex(random_bytes(32));
    }
  	$csrf = hash_hmac('sha256', 'this is some string: index.php', $_SESSION['key']);
		//set cookies for the session id and csrf token
    setcookie("session_id",$sessionID,time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
    setcookie("csrftoken",$csrf,time()+3600,"/","localhost",false,true); //csrf token cookie
?>

<html>
	<head>
		<title>CSRF Protection Double Submit cookie - IT16103696 </title>



  <style>
    	#frmLogin {
    		padding: 20px 60px;
    		background: #B6E0FF;
    		color: #555;
    		display: inline-block;
    		border-radius: 4px;
    	}
    	.field-group {
    		margin-top:15px;
    	}
    	.input-field {
    		padding: 8px;
    		width: 200px;
    		border: #A3C3E7 1px solid;
    		border-radius: 4px;
    	}
    	.form-submit-button {
    		background: #65C370;
    		border: 0;
    		padding: 8px 20px;
    		border-radius: 4px;
    		color: #FFF;
    		text-transform: uppercase;
    	}
    	.member-dashboard {
    		padding: 40px;
    		background: #D2EDD5;
    		color: #555;
    		border-radius: 4px;
    		display: inline-block;
    	}
    	.member-dashboard a {
    		color: #09F;
    		text-decoration:none;
    	}
    	.error-message {
    		text-align:center;
    		color:#FF0000;
    	}
    </style>

	</head>
	<body >
		<form method="POST" action="server.php" id="frmLogin">

      	<div class="field-group">
        <div><label for="login">Username</label></div>
        <div><input name="username" type="text" ></div>

      <div class="field-group">
  		<div><label for="password">Password</label></div>
  		<div><input name="password" type="password"></div>


      	<div class="field-group">
				<input type="hidden" id="token" name="csrf">
				<div><input type="submit" name="submt" value="Login" class="form-submit-button" ></span></div>
    		</div>
				<!-- read the csrf token value -->
				<script> document.getElementById("token").value = '<?php echo $csrf; ?>' </script>

		</form>


	</body>
</html>
