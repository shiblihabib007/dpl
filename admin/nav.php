<?php
if(isset($_SESSION["user"])){
	ob_start();
	
?>
<?php 
$sql = "SELECT * FROM company";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
   
		while($row = mysqli_fetch_array($result)) {
			$company_full_name=$row['company_full_name'];
			$company_title=$row['company_title'];
			$address_line_1 =$row['address_line_1'];
			$address_line_2 =$row['address_line_2'];
			$address_line_3 =$row['address_line_3'];
		}
	}
?>
<nav class="navbar navbar-default">
<h2 class="text-center mycolor company-name"><?php echo ucwords($company_full_name);?></h2>

<p class="text-center user-status"><span>User Status: </span><?php echo ucwords($_SESSION["user"]);?></p>
<?php
}
else{
	
	echo "user nai";
}
?>
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">DPL</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li class="active"><a href="home.php">HOME <span class="sr-only">(current)</span></a></li>-->
        <!--<li><a href="#">Company Info</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="company_info.php">Company Info</a></li>
			<li role="separator" class="divider"></li>
			
			 <li><a href="add_cash_box_system.php">Add CASH-BOX to System</a></li>
            <li><a href="add_bank_to_system.php">Add Bank to System</a></li>
			 <li class="disabled"><a href="edit_bank.php">Edit Bank Info</a></li>
			 <li role="separator" class="divider"></li>
			  <li><a href="all_expense.php">All Expense Categories</a></li>
			  <li><a href="add_expense_item_manualy_info.php">Add New Expense Category</a></li>
			 <li role="separator" class="divider"></li>
            <li><a href="all_supplier.php">All Suppliers</a></li>
            <li><a href="add_supplier_manualy_info.php">Add New Supplier</a></li>
			<li role="separator" class="divider"></li>
            <li><a href="add_perchase_item_manualy_info.php">Add New Perchase Item</a></li>
            
			<li role="separator" class="divider"></li>
			
            <li><a href="all_client.php">All Clients</a></li>
			<li><a href="add_client_manualy_info.php">Add New Client</a></li>
			
			<li><a href="edit_client.php"> Edit Client info</a></li>
			<li role="separator" class="divider"></li>
			 <li><a href="all_sale_item.php">All Sale Items</a></li>
			<li><a href="add_item_manualy_info.php">Add New Sale Item</a></li>
			<li><a href="edit_sale_item.php">Edit Sale Items</a></li>
            <li class="disabled"><a href="add_item_from_file.php">Add Sale Items From File</a></li>
            <li role="separator" class="divider"></li>
            
			
            
           
           
			<li role="separator" class="divider"></li>
			
			<li><a href="add_employee_manualy_info.php">Add Employee Info</a></li>
			<li><a href="add_worker_manualy_info.php">Add Worker Info</a></li>
			

            
           
          </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Purchase/Expenses <span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li><a href="all_perchase_items.php">Purchase</a></li>
            <!--<li><a href="perchase_edit.php">Purchase Edit</a></li>-->
			
            <li><a href="perchase_approve.php">Purchase (Approve)</a></li>
            <li><a href="perchase_reject.php">Purchase (Reject)</a></li>
            <li><a href="perchase_approved_list.php">(All Approved) Purchase </a></li>
			<li role="separator" class="divider"></li>
			
            <li><a href="all_espense_items.php">Expenses</a></li>
            <!--<li><a href="perchase_edit.php">Purchase Edit</a></li>-->
			
             <li><a href="approve_espense.php">Approve Expenses</a></li>
             <li><a href="reject_espense.php">Reject Expenses</a></li>
			 <li role="separator" class="divider"></li>
			 <li><a href="all_available_stock.php">Stock-Out</a></li>
			
           
          </ul>
        </li>
		
		 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bill & Challan <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="all_Items.php">Price Quotation</a></li>
            <li><a href="quotation_edit.php">Price Quotation (Edit)</a></li>
            <li><a href="quotation_print.php">Price Quotation (Print)</a></li>
			<li role="separator" class="divider"></li>
            <li><a href="current_price_quotation.php">Approve Price Quotation</a></li>
            <li><a href="current_price_quotation_for_delete.php">Reject Price Quotation</a></li>
			<li role="separator" class="divider"></li>
            <li><a href="bill_print.php">Bill & Delivery Challan (Print)</a></li>
          </ul>
        </li>
		
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="all_Items_for_bill_recieve.php">Cheque Recieve From Bill</a></li>
            <li><a href="all_Items_for_bill_recieve_cash.php">Cash Recieve From Bill</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="all_purchase_for_bill_payment_cheque.php">Cheque Payment</a></li>
            <li><a href="all_purchase_for_bill_payment_cash.php">Cash Payment</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="cheque_deposit.php">Cheque Deposit</a></li>
            <li><a href="cash_deposit_to_bank.php">Cash Deposit To Bank</a></li>
            <li><a href="cash_deposit.php">Cash Deposit</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="bank_to_bank_transection.php">Bank To Bank Transaction</a></li>
            <li><a href="cash_withdraw.php">Cash Withdraw</a></li>
            <!--<li><a href="bill_recieve_cash_to_bank.php">Cash Recieve From Bill</a></li>-->
			<li role="separator" class="divider"></li>
			<li><a href="wastage_cash_deposit.php">Wastage Cash Receive</a></li>
			<li role="separator" class="divider"></li>
            <li class="disabled"><a href="all_employee_and_worker_loan.php">Employee And Worker Loan</a></li>
            
            
          </ul>
        </li>
		
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
          <ul class="dropdown-menu">
			 <li><a href="report_purchase.php">Purchase Report</a></li>
			<li><a href="report_current_stocks.php">Available Stocks</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="report_expense.php">Expense Report </a></li>
			<li role="separator" class="divider"></li>
            <li><a href="report_cash_deposit.php">Cash Deposit Report</a></li>
            <li><a href="report_cheque_deposit.php">Cheque Deposit Report</a></li>
            <li><a href="report_cash_withdraw.php">Cash Withdraw Report</a></li>
            <li><a href="report_cheque_withdraw.php">Cheque Withdraw Report</a></li>
            <li role="separator" class="divider"></li>
			<li><a href="all_bank.php">All Bank</a></li>

          
          
            
          </ul>
        </li>
		
		
		
		
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
		
      </form>
      <ul class="nav navbar-nav navbar-right">
		<!--<li><a href="reset.php">reset</a></li>-->
        <li><a href="backup.php">Backup</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>