<?php 
	include 'config.php';
	session_start();
	if(isset($_GET['login'])) {	
		$username = $_POST['username'];
		$password = $_POST['password'];    
			
		//Überprüfung des Passworts
		if( in_array($username, $valid_users) && $password == $valid_passwords[$username]) {
			$_SESSION['userid'] = $username;
			header("location: index.php");
			exit();
		} else {
			$errorMessage = "Benutzername oder Passwort war ungültig<br>";
		}  
	}
?>
<html>

<head>
  <title>Login</title>    
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<?php 
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>
<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>Anmeldung</h2>
				</div>
					<form action="?login=1" method="post">
					<div class="form-group">
						<label for="username">Benutzername</label>
						<input type="text" name="username" class="form-control" 
							value="">
                    </div>
					 
					<div class="form-group">
						<label for="password">Passwort</label>
						<div>
							<input id="password-field" style="margin-right: -4px; display: inline-block" type="password" name="password" class="form-control" value="">
							<i id="password-toggle" style="cursor: pointer; display: inline-block; margin-left: -30px;" class="glyphicon glyphicon-eye-close"></i>
						</div>
                    </div>
					 
					<input class="btn btn-primary" type="submit" value="Login">
					</form> 
			</div>
		</div>
	</div>
</div>
</body>

<script>
const togglePassword = document.querySelector('#password-toggle');
const password = document.querySelector('#password-field');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('glyphicon-eye-open');
	this.classList.toggle('glyphicon-eye-close');
});
</script>

</html>