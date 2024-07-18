<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Record Staff Payment";
		$page_title = "Record Payment";

		
		$id = $_SESSION['ID'];
		$username = $_SESSION['username'];
		$role = $_SESSION['role'];
		$profile_pic = $_SESSION['profile_pic'];
		$phonenumber = $_SESSION['phonenumber'];
		$email = $_SESSION['email'];
		
?>
<!-- Header Included Here -->
<?php include 'includes/header.php' ?>

	<div class="wrapper">

		<!-- Top Nav Included Here -->
		<?php include 'includes/top_nav.php' ?>

		<!-- Sidebar Included Here -->
		<?php include 'includes/sidebar_nav.php' ?>

		<div class="main-panel">
				<div class="content">
						<div class="container-fluid">
							<div class="row">
								<div class="col">
									<h4 class="page-title"><?php echo $page_title ?></h4>
								</div>
								<div class="col">
									<?php include 'includes/errors.php'; ?>
								</div>
							</div>
							<!-- Place Info Cards Here -->

							<!-- Place Other Contents Here -->

                            <?php 
                                $staffid = $_POST['userid'];
                                $revenue = $_POST['revenue'];
                                $paid = $_POST['paid'];
                                $balance = $_POST['balance'];


                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form enctype="multipart/form-data" method="post" action="classes/practitioner_record_payment">
                                            <input type="hidden" name="staffid" id="staffid" value="<?php echo htmlentities($staffid)?> ">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Total Amount(Earned):</label>
                                                                <div class="col-md-9 p-0">
                                                                    <input type="text" class="form-control input-full" name="totalrevenue" id="totalrevenue" value="<?php echo htmlentities($balance)?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Amount Paid Out:</label>
                                                                <div class="col-md-9 p-0">
                                                                    <input type="number" class="form-control input-full" name="amount" id="amount" oninput="validateinput();checkbalance();" required>
                                                                    <span class="input_error" id="amount_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">New Balance:</label>
                                                                <div class="col-md-9 p-0">
                                                                    <input type="text" class="form-control input-full" name="balance" id="balance" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Transaction Code:</label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="transactioncode" id="transactioncode" oninput="validateinput();" required>
                                                                </div>
                                                                <span class="input_error" id="code_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-action">
                                                        <button  class="btn btn-success" type="submit" name="recordpayment" id="recordpayment">Record Payment</button>
                                                        <button  class="btn btn-danger"  type="reset" >Cancel</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="card-action">
                                    <a class="btn btn-success" href="practitioner_performance_details?view=<?php echo $staffid; ?>">Back To Performance</a>
                                </div>
                            <!-- Place Other Contents Here -->



                            <script>
                                function validateinput(){
                                    var amount = document.getElementById("amount").value;
                                    var code = document.getElementById("transactioncode").value;

                                    var minpay = /^\d{3,5}$/;
                                    var codecount = /^[0-9a-zA-Z]{10}$/;

                                    let text;

                                    //Amount
                                    if(!minpay.test(amount)){
                                        text = "Cannot Process a Payment Below 100 or Above 20,000 Ksh!";
                                        document.getElementById("amount_error").style.display = "block";
                                        document.getElementById("amount_error").innerHTML = text;
                                        document.getElementById("recordpayment").disabled = true;
                                    }
                                    else{
                                        document.getElementById("amount_error").style.display = "none";
                                        document.getElementById("recordpayment").disabled = false;
                                    }
                                    
                                    //Transcation Code
                                    if(!codecount.test(code)){
                                        text = "Please Enter a Valid Transaction Code";
                                        document.getElementById("code_error").style.display = "block";
                                        document.getElementById("code_error").innerHTML = text;
                                        document.getElementById("recordpayment").disabled = true;
                                    }
                                    else{
                                        document.getElementById("code_error").style.display = "none";
                                        document.getElementById("recordpayment").disabled = false;
                                    }

                                }

                                function checkbalance(){
                                    var totalrevenue = document.getElementById("totalrevenue").value;
                                    var paidamount = document.getElementById("amount").value;

                                    var balanceamount = totalrevenue - paidamount;

                                    document.getElementById("balance").value = balanceamount ;

                                    let text;

                                    if(paidamount > totalrevenue){
                                        text = "Entered Amount Exceeds Earned Amount!!";
                                        document.getElementById("amount_error").style.display = "block";
                                        document.getElementById("amount_error").innerHTML = text;
                                        document.getElementById("recordpayment").disabled = true;
                                    }
                                    else{
                                        document.getElementById("amount_error").style.display = "none";
                                        document.getElementById("recordpayment").disabled = false;
                                    }


                                }
                                
                            </script>

						</div>
				</div>

			<!-- Guide Footer Included Here -->
			<?php include 'includes/guide_footer.php' ?>
		</div>
	</div>

	<!-- License Modal Included Here -->
	<?php include 'includes/license_modal.php' ?>	

	<!-- Footer Included Here -->
	<?php include 'includes/footer.php' ?>	
	
<?php }
?>