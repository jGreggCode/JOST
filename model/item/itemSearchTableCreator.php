<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = 'SELECT * FROM item';
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();
	
	$output = '<table id="itemSearchTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%; height: 50%;">
				<thead>
					<tr>
						<th>Product ID</th>
						<th>Category</th>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Discount %</th>
						<th>Stock</th>
						<th>Unit Price</th>
						<th>Status</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $row['productID'] . '</td>' .
						'<td>' . $row['category'] . '</td>' .
						'<td>' . $row['itemNumber'] . '</td>' .
						'<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $row['productID'] . '">' . $row['itemName'] . '</a></td>' .
						'<td>' . $row['discount'] . '</td>' .
						'<td>' . $row['stock'] . '</td>' .
						'<td>' . $row['unitPrice'] . '</td>' .
						'<td>' . $row['status'] . '</td>' .
						'<td>' . $row['description'] . '</td>' .
						'<td>' . '<input type="button" class="addOrder btn btn-primary" id="addOrder_' . $row['productID'] . '" name="addOrder" value="Add Order"/>'  . '</td>' .
					'</tr>';
	}
	
	$itemDetailsSearchStatement->closeCursor();

    echo '</tbody>
    </table>';
	
	echo $output;
?>