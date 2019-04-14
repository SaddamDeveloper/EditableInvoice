
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Tax Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script type='text/javascript' src='js/jquery-3.3.1.min.js'></script>
  	<script src="js/jquery-ui.js"></script>
  	<script src="js/jspdf.min.js"></script>
	<script src="js/sweetalert2.min.js"></script>
  	<script src="js/jspdf.plugin.autotable.js"></script>
  	<script src="js/custom-date.js"></script>
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<style type="text/css">
		.button{
			margin: 10px;
			background-color: #4CAF50; border: none;
		  color: white;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		}
	</style>
</head>

<body>

	<div id="page-wrap">

		<textarea id="header">TAX INVOICE</textarea>
		
		<span style="font-size: 12px; font-weight:800;">Name & Address of Shop:</span>
		<div id="identity">
            <div id="address">Imran Hossain, Three Bothers Computer Lab, Satrakanara Bazar (Near Maszid)</div>

            <table id="meta">
                <tr>
                    <td class="meta-head">INVOICE NO:</td>
                    <td><input type="text" readonly id="invoice_no"></td>
                </tr>
                <tr>
                    <td class="meta-head">INVOICE DATE:</td>
                    <td><input type="text" id="date" value="<?php echo date('Y-m-d') ?>"></td>
                </tr>
            </table>
		<div style="clear:both"></div>
		<table style="width: 900px;">
			<tr>
				<td width="10%">
						<span style="font-size: 18px; font-weight:800;">Bill To:</span>
				</td>
				<td width="90%">
					<div id="customer">
			            <textarea rows="4" cols="40" id="customer-title" class="bill_to"></textarea>	
					</div>					
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span style="font-size: 12px;">Being the Fees Charged for audit of CSD Trade Surplus Fund accounts along with the GST @18%</span>
				</td>
			</tr>
		</table>
		<table id="items">
		  <tr>
		  	<th>Sl.No</th>
		      <th style="width:40%;">Description</th>
		      <th style="width:20%;">Quantity</th>
		      <th style="width:25%;">Rate</th>
		      <th style="width:10%;">Amount(RS)</th>
		  </tr>
		  <div>
		  <tr class="item-row" id="row1">
		  	<td>1</td>
		      <td class="item-name"><div class="delete-wpr"><div style="text-align: center;"><textarea class="description requiredField" placeholder="Description" id="description1"></textarea></div><a class="delete" href="javascript:;" title="Remove row"><img src="images/cross.png" width="12px"></a></div></td>
		      <td ><textarea class="qty requireField" id="qty1"></textarea></td>
		      <td><textarea class="rate requiredField" placeholder="" id="rate1"></textarea></td>
		      <td><input type="text" readonly class="amount" id="amount1" placeholder="₹ 0.00"></td>
		  </tr>
		  </div>
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row"><img src="images/plus.png" width="18px">&nbsp;&nbsp;&nbsp;ADD NEW</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Taxable Value:</td>
		      <td align="center">(A)</td>
		      <td class="taxabale_value"><input type="text" readonly id="taxable_value" placeholder="₹ 0.00"></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">SGST: <input id="sgstRate" type="text" value="9" style="width: 15px" onkeypress="return isNumberKey(event,this)"><span>%</span></td>
		      <td align="center">(B)</td>
		      <td class="total-value"><input type="text" readonly id="sgst" placeholder="₹ 0.00" ></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">CGST: <input id="cgstRate" type="text" value="9" style="width: 15px" onkeypress="return isNumberKey(event,this)"><span>%</span></td>
		      <td align="center">(C)</td>
		      <td class="total-value"><input type="text" readonly id="cgst" placeholder="₹ 0.00"></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td class="total-line">Total Tax</td>
		      <td align="center">(D)(B+C)</td>
		      <td class="total-value"><input type="text" readonly placeholder="₹ 0.00" id="total_tax"></td>
		  </tr>
		  <tr>
		  	<td colspan="2">Invoice Value(in words)</td>
		  	<td><input type="text" name="invoiceval" placeholder="Type in words"></td>
		      <td class="total-line" colspan="3">Total Invoice Amount</td>
		  </tr>
		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="1" class="total-line balance">(A+D)</td>
		      <td class="total-value balance"><input type="text" readonly name="" placeholder="₹ 0.00" id="total_invoice_amount" class="due"></td>
		  </tr>
		   <tr>
		  	<td rowspan="3" colspan="2">Net Invoice Value(in words)</td>
		  	<td rowspan="3"><input type="text" name="netinvoice" placeholder="Type in words"></td>
		      <td class="total-line">Less: Advance</td>
		      <td><input type="text" name="less_advance" id="less_advance" placeholder="₹ 0.00" onkeypress="return isNumberKey(event,this)"></td>
		  </tr>
		  <tr>
		  	<td class="total-line">AV No.</td>
		  	<td><input type="text" name="avNo" id="avNo" placeholder="AV No."></td>
		  </tr>
		  <tr>
		  	<td class="total-line">Net Invoice Amount</td>
		  	<td><input type="text" name="net_invoice_amt" id="net_invoice_amt" value='' placeholder="₹ 0.00"></td>
		  </tr>
		
		</table>
		
		<div class="buttons">
			<button class="button" id="savenprint" name="savenprint" style="float: right; opacity: 0.4" disabled="disabled">Save & Print</button>
			<button id="generatePDF" class="button" style="float: right;">Generate Receipt</button>
		</div>
	</div>
	<script type='text/javascript' src='js/example.js'></script>
</body>

</html>