<?php
	session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	require_once('../../inc/errorhandling.php');
	
	$loginUsername = '';
	$loginPassword = '';
	$hashedPassword = '';
	
	if(isset($_POST['loginUsername'])){
		$loginUsername = $_POST['loginUsername'];
		$loginPassword = $_POST['loginPassword'];
		
		if(!empty($loginUsername) && !empty($loginUsername)){
			
			// Sanitize username
			$loginUsername = filter_var($loginUsername, FILTER_SANITIZE_STRING);
			
			// Check if username is empty
			if($loginUsername == ''){
				redirectToLoginWithError("Enter a username!");
				exit();
			}
			
			// Check if password is empty
			if($loginPassword == ''){
				redirectToLoginWithError("Enter a password!");
				exit();
			}
			
			// Encrypt the password
			$hashedPassword = md5($loginPassword);
			
			// Check the given credentials
			$checkUserSql = 'SELECT * FROM user WHERE username = :username AND password = :password';
			$checkUserStatement = $conn->prepare($checkUserSql);
			$checkUserStatement->execute(['username' => $loginUsername, 'password' => $hashedPassword]);
			
			// Check if user exists or not
			if($checkUserStatement->rowCount() > 0){
				// Valid credentials. Hence, start the session
				$row = $checkUserStatement->fetch(PDO::FETCH_ASSOC);

				if ($row['status'] === 'Disabled') {
					redirectToLoginWithError("Wait for the admin to activate your account");
					exit();
				}

				$_SESSION['loggedIn'] = '1';
				$_SESSION['userid'] = $row['userID'];
				$_SESSION['fullName'] = $row['fullName'];
				$_SESSION['usertype'] = $row['usertype'];
				$_SESSION['status'] = $row['status'];
				$_SESSION['sales'] = $row['sales'];
				$_SESSION['sold'] = $row['sold'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['mobile'] = $row['mobile'];
				$_SESSION['location'] = $row['location'];

				$getSalesSql = 'SELECT SUM(sales) AS total_sales FROM user';
				$getSalesStatement = $conn->prepare($getSalesSql); // Fixed the variable name
				$getSalesStatement->execute();

				// Fetch the result
				$result = $getSalesStatement->fetch(PDO::FETCH_ASSOC);

				// Store the total_sales value in session
				$_SESSION['companysales'] = $result['total_sales'] ?? 0;
				
				/*
				if ($_SESSION['usertype'] === 'Admin') {
					header('Location: ../../dashboard.php');
					exit();
				} elseif ($_SESSION['usertype'] === 'Reseller') {
					header('Location: ../../reseller.php');
					exit();
				} elseif ($_SESSION['usertype'] === 'Employee') {
					header('Location: ../../employee.php');
					exit(); // Fallback for other user types
				}
				*/
				header('Location: ../../dashboard.php');
				exit();
			} else {
				// Redirect to login with error message in query parameter
				redirectToLoginWithError("User not found");
			}
		} else {
			redirectToLoginWithError("Enter username and password");
			exit();
		}
	}
?>