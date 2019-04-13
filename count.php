<?php
//Database Check
	include_once('db.php');
		while(true)
	{
		$sql2="select max(substring(invoice_no, 21, 3)) as max_val from invoice_head";
		$stmt2 = $conn->prepare($sql2);
		$sql2Result2=$stmt2->execute(); 
		$stmt2->setFetchMode(PDO::FETCH_ASSOC);
		$count2 = $stmt2->rowCount();
		$invoice_no = 'DDAS/INST/';
		$currentYear = substr(date("Y"),-2); 
		$nextYear =  (int)$currentYear + 1;
		$year_prefix = $currentYear."-".$nextYear;
		$month = date("M");
		$invoice_no = $invoice_no.$year_prefix.'/'.$month.'/';
		if($count2==0){
			$invoice_no=$invoice_no.'001';
		} elseif ($count2>0){
			while ($row1 = $stmt2->fetch()) {
				$maxVal=$row1["max_val"];
				$newMaxval=$maxVal+1;
				$addVal=str_pad($newMaxval, 3, '0', STR_PAD_LEFT);
				$invoice_no=$invoice_no.$addVal;
						echo $invoice_no;
			}
		}
		$res = 'select invoice_no from invoice_head where invoice_no=:invoice_no';
		$stmt1 = $conn->prepare($res);
		$stmt1->bindParam(':invoice_no', $invoice_no, PDO::PARAM_STR);
		$stmt1->execute();
		$count = $stmt1->rowCount();
		if($count==0)
			break;

	}
?>