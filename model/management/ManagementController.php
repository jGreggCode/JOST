<?php
	require_once 'Management.php';
	require_once '../audit/insertAudit.php';


    // Handle AJAX request
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUsingItemID'])) {
        $productID = intval($_POST['deleteUsingItemID']);

        // Initialize your database connection
        $db = $conn; 

        $management = new Management($db);
        $response = $management->itemDelete($productID);

		insertAudit('Account: ' . '(' . $_SESSION['userid'] . ')' . ' Deleted Item ' . $productID);

        // Return JSON response
        echo json_encode($response);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUsingProductID'])) {
        $productID = intval($_POST['updateUsingProductID']);
        $itemName = $_POST['updateUsingItemName'];
        $itemNumber = $_POST['updateUsingItemNumber'];
        $itemCategory = $_POST['updateUsingItemCategory'];
        $itemDescription = $_POST['updateUsingItemDescription'];
        $itemCosting = $_POST['updateUsingItemCosting'];
        $itemStock = $_POST['updateUsingItemStock'];
        $itemUnitPrice = $_POST['updateUsingItemUnitPrice'];

        // Initialize your database connection
        $db = $conn; 

        $management = new Management($db);
        $response = $management->itemUpdate($productID, $itemNumber, $itemName, $itemCategory, $itemDescription, $itemCosting, $itemStock, $itemUnitPrice);

		insertAudit('Account: ' . '(' . $_SESSION['userid'] . ')' . ' Updated Item ' . $productID);

        // Return JSON response
        echo json_encode($response);
        exit();
    }
