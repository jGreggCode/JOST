<?php

    session_start();
    require_once('../../inc/config/constants.php');
    require_once('../../inc/config/db.php');

    if(isset($_POST['saleDetailsCustomerID'])) {

        $sellerID = $_SESSION['userid'];
        $saleItems = json_decode($_POST['saleItems'], true); // Decode the JSON string into an array
        $saleDetailsCustomerID = $_POST['saleDetailsCustomerID'];
        $saleDetailsCustomerName = $_POST['saleDetailsCustomerName'];
        $saleDetailsSaleDate = $_POST['saleDetailsSaleDate'];
        $saleDetailsCash = $_POST['saleDetailsCash'];
        $saleDetailsDiscount = $_POST['saleDetailsDiscount'];
        $saleDetailsItemStatus = $_POST['saleDetailsItemStatus'];

        // Check if mandatory fields are not empty
		if(!empty($sellerID) && 
            isset($saleItems) && 
            isset($saleDetailsCustomerID) && 
            isset($saleDetailsCash) &&
            isset($saleDetailsItemStatus)) {

                // Check if customerID is empty
			if($saleDetailsCustomerID == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a Customer ID.</div>';
				exit();
			}

            if(filter_var($saleDetailsCustomerID, FILTER_VALIDATE_INT) === 0 || filter_var($saleDetailsCustomerID, FILTER_VALIDATE_INT)){
				// Valid customerID
			} else {
				// customerID is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid Customer ID</div>';
				exit();
			}

			if($saleDetailsCash == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid payment mode.</div>';
				exit();
			}

            foreach ($saleItems as $item) {
                $itemNumber = $item['itemNumber'];
                $requestedQuantity = $item['quantity'];
                
                $stockQuery = "SELECT stock FROM item WHERE itemNumber = :itemNumber";
                $stockQueryStatment = $conn->prepare($stockQuery);
                $stockQueryStatment->execute([
                    'itemNumber' => $itemNumber
                ]);

                if ($stockQueryStatment->rowCount() > 0) {
                    $row = $stockQueryStatment->fetch(PDO::FETCH_ASSOC);
                    $currentStock = $row['stock'];
                    if ($currentStock < $requestedQuantity) {
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Insufficient stock for item: ', $itemNumber, ' (Requested: ', $requestedQuantity, ' Available: ', $currentStock, ').</div>';
                        exit();
                    }
                }

                $insertSaleSql = 'INSERT INTO sale(customerID, customerName, saleDate, payment, status, sellerID) VALUES(:customerID, :customerName, :saleDate, :payment, :status, :sellerID)';
                $insertSaleStatement = $conn->prepare($insertSaleSql);
                $insertSaleStatement->execute([
                    'customerID' => $saleDetailsCustomerID, 
                    'customerName' => $saleDetailsCustomerName,
                    'saleDate' => $saleDetailsSaleDate,
                    'payment' => $saleDetailsCash,
                    'status' => $saleDetailsItemStatus,
                    'sellerID' => $sellerID
                ]);

                $saleID = $conn->lastInsertId();

                $itemAddSql = "INSERT INTO order_items (saleID, itemNumber, quantity, unitPrice) VALUES (:saleID, :itemNumber, :quantity, :unitPrice)";
                $itemAddStatement = $conn->prepare($itemAddSql);
                $itemNum = 0;

                foreach ($saleItems as $item) {
                    $itemNumber = $item['itemNumber'];
                    $quantity = $item['quantity'];
                    $unitPrice = $item['unitPrice'];

                    $itemAddStatement->execute([
                        'saleID' => $saleID,
                        'itemNumber' => $itemNumber,
                        'quantity' => $quantity,
                        'unitPrice' => $unitPrice
                    ]);

                    $updateItemSql = "UPDATE item SET stock = stock - :quantity WHERE itemNumber = :itemNumber";
                    $updateItemStatement = $conn->prepare($updateItemSql);
                    $updateItemStatement->execute([
                        'quantity' => $quantity,
                        'itemNumber' => $itemNumber
                    ]);

                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Order has been successfully added!</div>';
                }
                exit();
            }
        }

    } 