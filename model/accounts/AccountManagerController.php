<?php
	require_once 'AccountManager.php';

    // Handle AJAX request
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUsingAccountID'])) {
        $accountID = intval($_POST['deleteUsingAccountID']);

        // Initialize your database connection
        $db = $conn; 

        $accountManager = new AccountManager($db);
        $response = $accountManager->deleteAccount($accountID);

        // Return JSON response
		header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activateAccountEmail'])) {
		$accountEmail = trim($_POST['activateAccountEmail']);
	
		$db = $conn;
	
		$accountManager = new AccountManager($db);
		$response = $accountManager->activateAccount($accountEmail);
		echo "console.log(", json_encode($response), ")";
	
		// Return JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
		exit;
	}