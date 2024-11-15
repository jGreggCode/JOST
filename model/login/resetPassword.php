<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$resetPasswordPassword1 = '';
	$resetPasswordPassword2 = '';
	$hashedPassword = '';
	
	if(isset($_POST['changePassword1'])){
		$resetPasswordPassword1 = htmlentities($_POST['changePassword1']);
		$resetPasswordPassword2 = htmlentities($_POST['changePassword2']);
		$changePassUserDetailsUserID = htmlentities($_POST['changePassUserDetailsUserID']);
		
		if(!empty($resetPasswordPassword1) && !empty($resetPasswordPassword2)){

			if ($resetPasswordPassword1 !== $resetPasswordPassword2) {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Password does not match!</div>';
				exit();
			} else {

				$hashedPassword = md5($resetPasswordPassword1);
				$updatePasswordSql = 'UPDATE user SET password = :password WHERE userID = :userID';
				$updatePasswordStatement = $conn->prepare($updatePasswordSql);
				$updatePasswordStatement->execute([
					'password' => $hashedPassword, 
					'userID' => $changePassUserDetailsUserID
				]);
				
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Password reset complete. Please login using your new password.</div>';
				
				exit();
			}
			
		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Enter all fields</div>';
			exit();
		}
	}
?>