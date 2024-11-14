<?php
	session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	$usertype = $_SESSION['usertype'];
	$userid = $_SESSION['userid'];
	
	$uPrice = 0;
	$qty = 0;
	$totalPrice = 0;

	if ($usertype === 'Admin') {
		$saleDetailsSearchSql = 'SELECT * FROM sale';
		$saleDetailsSearchStatement = $conn->prepare($saleDetailsSearchSql);
		$saleDetailsSearchStatement->execute();
	} else {
		$saleDetailsSearchSql = 'SELECT * FROM sale WHERE sellerID = :sellerID';
		$saleDetailsSearchStatement = $conn->prepare($saleDetailsSearchSql);
		$saleDetailsSearchStatement->execute(['sellerID' => $userid]);
	}

	$output = '<table id="saleDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Item Number</th>
						<th>Customer ID</th>
						<th>Customer Name</th>
						<th>Seller ID</th>
						<th>Item Name</th>
						<th>Order Date</th>
						<th>Discount %</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Status</th>
						<th>Total Price</th>
						<th>Invoice</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $saleDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		$uPrice = $row['unitPrice'];
		$qty = $row['quantity'];
		$discount = $row['discount'];
		$totalPrice = $uPrice * $qty * ((100 - $discount)/100);
			
		$output .= '<tr>' .
						'<td>' . $row['saleID'] . '</td>' .
						'<td>' . $row['itemNumber'] . '</td>' .
						'<td>' . $row['customerID'] . '</td>' .
						'<td>' . $row['customerName'] . '</td>' .
						'<td>' . $row['sellerID'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['saleDate'] . '</td>' .
						'<td>' . $row['discount'] . '</td>' .
						'<td>' . $row['quantity'] . '</td>' .
						'<td>' . $row['unitPrice'] . '</td>' .
						'<td>' . $row['status'] . '</td>' .
						'<td>' . $totalPrice . '</td>' .
						'<td> <a href="generatePDF.php?invID='. $row['saleID'] .'&ACTION=VIEW" style="color: blue; font-weight: bold;">Invoice</a> </td>' .
					'</tr>';
	}
	
	$saleDetailsSearchStatement->closeCursor();
	
	echo $output;
?>


