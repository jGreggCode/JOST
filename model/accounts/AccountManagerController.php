<?php
	require_once 'AccountManager.php';
	require_once '../../send.php';


    // Handle AJAX request
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUsingAccountID'])) {
        $accountID = intval($_POST['deleteUsingAccountID']);

        // Initialize your database connection
        $db = $conn; 

        $accountManager = new AccountManager($db);
        $response = $accountManager->deleteAccount($accountID);

        // Return JSON response
        echo json_encode($response);
        exit();
    }

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activateAccountEmail'])) {
		$accountEmail = trim($_POST['activateAccountEmail']);
		$accountType = trim($_POST['activateAccountType']);
	
		$db = $conn;
	
		$accountManager = new AccountManager($db);
		$response = $accountManager->activateAccount($accountEmail);
		
		if ($response['status'] === 'success') {
			accountActivatedEmail($accountType, $accountEmail);
			$message = 'Account Activated and Email notification has been sent.';
			$response = ['status' => 'success', 'message' => $message];
		} 
		
		echo json_encode($response);
		exit();
	}
