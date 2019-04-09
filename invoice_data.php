<?php
include_once('db.php');
	$invoice_data = json_decode($_POST['data']);
	$sql1="INSERT INTO invoice_head VALUES(:invoice_no, :bill_to, :gstin, :date, :taxable_value, :total_tax, :total_invoice_amount, :advance_amount )";
	$stmt1 = $conn->prepare($sql1);
	$stmt1->bindParam(':invoice_no', $invoice_data->obj2->invoice_no, PDO::PARAM_STR);
	$stmt1->bindParam(':bill_to', $invoice_data->obj2->bill_to, PDO::PARAM_STR);
	$stmt1->bindParam(':gstin', $invoice_data->obj2->gstin, PDO::PARAM_STR);
	$stmt1->bindParam(':date', $invoice_data->obj2->date, PDO::PARAM_STR);
	$stmt1->bindParam(':taxable_value', $invoice_data->obj2->taxable_value, PDO::PARAM_STR);
	$stmt1->bindParam(':total_tax', $invoice_data->obj2->total_tax, PDO::PARAM_STR);
	$stmt1->bindParam(':total_invoice_amount', $invoice_data->obj2->total_invoice_amount, PDO::PARAM_STR);
	$stmt1->bindParam(':advance_amount', $invoice_data->obj2->advance_amount, PDO::PARAM_STR);
	$sql1Result=$stmt1->execute();
	if($sql1Result){
		foreach($invoice_data->obj as $row){
			$sql2="INSERT INTO invoice_row_data (sac, description, pos, invoice_no) VALUES (:sac, :description, :pos, :invoice_no)";
			$stmt2 = $conn->prepare($sql2);
			$stmt2->bindParam(':sac', $row->sac, PDO::PARAM_STR);
			$stmt2->bindParam(':description', $row->description, PDO::PARAM_STR);
			$stmt2->bindParam(':pos', $row->pos, PDO::PARAM_STR);
			$stmt2->bindParam(':invoice_no', $row->invoice_no, PDO::PARAM_STR);
			$sql2Result=$stmt2->execute();
		}
	}
	if($sql1Result && $sql2Result){
		echo 0;
	} else echo 1;
?>