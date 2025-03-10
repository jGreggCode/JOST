<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$registerFullName = '';
	$registerUsername = '';
	$registerUserType = '';
	$registerEmail = '';
	$registerPassword1 = '';
	$registerPassword2 = '';
	$hashedPassword = '';
	
	function isValidEmail($registerEmail) {
		$pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
		return preg_match($pattern, $registerEmail);
	}
	
	if(isset($_POST['registerUsername'])){
		$registerFullName = htmlentities($_POST['registerFullName']);
		$registerUsername = htmlentities($_POST['registerUsername']);
		$registerUserType = htmlentities($_POST['registerUserType']);
		$registerEmail = htmlentities($_POST['registerEmail']);
		$registerPassword1 = htmlentities($_POST['registerPassword1']);
		$registerPassword2 = htmlentities($_POST['registerPassword2']);
		
		if(!empty($registerFullName) && !empty($registerUsername) && !empty($registerUserType) && !empty($registerPassword1) && !empty($registerPassword2)){
			
			// Sanitize name
			$registerFullName = filter_var($registerFullName, FILTER_SANITIZE_STRING);
			
			// Check if name is empty
			if($registerFullName == ''){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your name.</div>';
				exit();
			}
			
			// Check if username is empty
			if($registerUsername == ''){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your username.</div>';
				exit();
			}

			if($registerUsername == ''){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your username.</div>';
				exit();
			}
			
			// Check if both passwords are empty
			if($registerEmail == ''){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your Email.</div>';
				exit();
			}

			if (!isValidEmail($registerEmail)) {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Invalid Email!</div>';
				exit();
			}
			
			// Check if username is available
			$usernameCheckingSql = 'SELECT * FROM user WHERE username = :username';
			$usernameCheckingStatement = $conn->prepare($usernameCheckingSql);
			$usernameCheckingStatement->execute(['username' => $registerUsername]);

			// Check if email is available
			$emailCheckingSql = 'SELECT * FROM user WHERE email = :email';
			$emailCheckingStatement = $conn->prepare($emailCheckingSql);
			$emailCheckingStatement->execute(['email' => $registerEmail]);
			
			if($usernameCheckingStatement->rowCount() > 0){
				// Username already exists. Hence can't create a new user
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Username not available. Please select a different username.</div>';
				exit();
			} else if ($emailCheckingStatement->rowCount() > 0) {
				// Email already exists. Hence can't create a new user
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Username not available. Please select a different Email.</div>';
				exit();
			} else {
				// Check if passwords are equal
				if($registerPassword1 !== $registerPassword2){
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Passwords do not match.</div>';
					exit();
				} else {
					// Start inserting user to DB
					// Encrypt the password
					$hashedPassword = md5($registerPassword1);
					$insertUserSql = 'INSERT INTO user(usertype, fullName, email, username, password) VALUES(:usertype, :fullName, :email, :username, :password)';
					$insertUserStatement = $conn->prepare($insertUserSql);
					$insertUserStatement->execute(['usertype' => $registerUserType, 'fullName' => $registerFullName, 'email' => $registerEmail, 'username' => $registerUsername, 'password' => $hashedPassword]);
					

					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Registration complete.</div>';
					exit();
				}
			}
		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>