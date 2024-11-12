<?php
session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemNumber = htmlentities($_POST['itemDetailsItemNumber']);
	
	if(isset($_POST['itemDetailsItemNumber'])){
		
		// Check if mandatory fields are not empty
		if(!empty($itemNumber)){
			
			// Sanitize item number
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

			// Check if the item is in the database
			$itemSql = 'SELECT itemNumber FROM item WHERE itemNumber=:itemNumber';
			$itemStatement = $conn->prepare($itemSql);
			$itemStatement->execute(['itemNumber' => $itemNumber]);
			
			if($itemStatement->rowCount() > 0){
				
				// Item exists in DB. Hence start the DELETE process
				$deleteItemSql = 'DELETE FROM item WHERE itemNumber=:itemNumber';
				$deleteItemStatement = $conn->prepare($deleteItemSql);
				$deleteItemStatement->execute(['itemNumber' => $itemNumber]);

				$time = date('Y-m-d H:i:s');
				$action = "Item Deleted (Item)";
				$insertAuditSql = 'INSERT INTO audit(`time`, userID, usertype, userName, Action) VALUES(:time, :userID, :usertype, :userName, :Action)';
		
				$insertAuditStatement = $conn->prepare($insertAuditSql);
				$insertAuditStatement->execute(['time' => $time, 'userID' => $_SESSION['userid'], 'usertype' => $_SESSION['usertype'], 'userName' => $_SESSION['fullName'], 'Action' => $action]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item deleted.</div>';
				exit();
				
			} else {
				// Item does not exist, therefore, tell the user that he can't delete that item 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			// Item number is empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the item number</div>';
			exit();
		}
	}
?>