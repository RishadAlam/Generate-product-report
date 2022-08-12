<?php
	// Database Connect
	$conn = mysqli_connect("localhost", "root", "", "product_table");
	
	// API file
	$file = "https://raw.githubusercontent.com/Bit-Code-Technologies/mockapi/main/purchase.json";
	$data = file_get_contents($file);

	// APi json decode
	$array = json_decode($data, true);


	// Insert Database from Api
	foreach ($array as $row) {
		$sql = "INSERT INTO product(customer_name, order_no, user_phone, product_code, product_name, product_price, purchase_quantity) VALUES ('{$row["name"]}','{$row["order_no"]}','{$row["user_phone"]}','{$row["product_code"]}','{$row["product_name"]}','{$row["product_price"]}','{$row["purchase_quantity"]}')";

		mysqli_query($conn, $sql);
	}

	// Load product report from database
	$sql2 = "SELECT * FROM product ORDER BY purchase_quantity DESC";
	$query2 = mysqli_query($conn, $sql2);

	$output = "";
	if (mysqli_num_rows($query2) > 0) {
		
		// empty Arrays
		$price = array();
		$quantity = array();
		$total = array();

		while ($rows = mysqli_fetch_assoc($query2)) {
			$output .= "<tr>
							<td>" . $rows['product_name'] . "</td>
							<td>" . $rows['customer_name'] . "</td>
							<td>" . $rows['purchase_quantity'] . "</td>
							<td>" . $rows['product_price'] . "</td>
							<td>" . ($rows['product_price']*$rows['purchase_quantity']) . "</td>
						</tr>";

			// define array value
			$price[] = $rows['product_price'];
			$quantity[] = $rows['purchase_quantity'];
			$total[] = ($rows['product_price']*$rows['purchase_quantity']); 
		}

		// Gross Total table
		$output .= "<tr><td class='text-end' colspan='2'>Gross Total:</td><td>" . array_sum($quantity) . "</td><td>" . array_sum($price) . "</td><td>" . array_sum($total) .  "</td></tr>";
	}else{
		$output .= "No records Found!";
	}

	echo $output;
	mysql_close($conn);
