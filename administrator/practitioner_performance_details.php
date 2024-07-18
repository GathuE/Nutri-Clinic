<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Staff Details";
		$page_title = "Staff Information";


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
							<hr>
							<!-- Place Info Cards Here -->
                           
							<!-- Place Other Contents Here -->

							<?php 

                                error_reporting(E_ALL & E_NOTICE);
                                include 'includes/db_conn.php'; 
                                $email = $_GET['view'];
                                $sql = "SELECT * FROM practitioners 
								INNER JOIN practitioner_data ON practitioners.ID=practitioner_data.practitioner_id 
                                WHERE practitioners.email='$email'";
                                $query= $conn->prepare($sql);
                                $query-> execute();
                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                if($query -> rowCount() > 0)
                                {
                                foreach($results as $result)
                                {
                                
                             ?>
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" id="employee_card">
										<h6 id="employee_heading">Employee Details</h6>
											<div class="row">
												<div class="col-sm-12 col-md-12">
                                                   <p>Name : <?php echo htmlentities($result->name);?><br> 
                                                   Specialty : <?php echo htmlentities($result->specialty);?><br> 
                                                  Region : <?php echo htmlentities($result->region);?><br>   
                                                   Phonenumber : <?php echo htmlentities($result->phonenumber);?><br> 
												   Email : <?php echo htmlentities($result->email);?> </p> 
                                                </div>
											</div>
											<br>
											<div class="row">
												<div class="col-6 col-sm-6 col-md-6">
                                                    <?php 
                                                        error_reporting(E_ALL & E_NOTICE);
                                                        include 'includes/db_conn.php';
                                                        $email = $_GET['view'];
                                                        $sql ="SELECT id from referral_data where referrer_id='$email'";
                                                        $query = $conn -> prepare($sql);
                                                        $query->execute();
                                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                        $referrals=$query->rowCount();

                                                    ?>
                                                    <button class="btn btn-block btn-warning">
                                                        <span id="referrals_count">
                                                            <?php echo htmlentities($referrals);?>
                                                        </span> 
                                                        <p><small> Successful Refferals</small></p>
                                                    </button>
												   
												</div>
                                                <div class="col-6 col-sm-6 col-md-6">
                                                    <?php 
                                                        error_reporting(E_ALL & E_NOTICE);
                                                        include 'includes/db_conn.php';
                                                        $email = $_GET['view'];
                                                        $sql ="SELECT round(sum(cost_amount)*40/100) as total from referral_data 
                                                        join plan_costs on plan_costs.goal_name=referral_data.goal 
                                                        where referrer_id='$email'";
                                                        $query = $conn -> prepare($sql);
                                                        $query->execute();
                                                        $results=$query->fetch(PDO::FETCH_OBJ);
                                                    ?>

                                                    <button class="btn btn-block btn-info">
                                                        <small>Revenue Earned</small>
                                                        <p>Ksh
                                                            <span id="total_revenue">
                                                                <?php echo htmlentities($results->total); ?>
                                                            </span> <br>
                                                    </button>
												
												</div>
											</div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-6">
                                                 <?php 
                                                        error_reporting(E_ALL & E_NOTICE);
                                                        include 'includes/db_conn.php';
                                                        $email = $_GET['view'];
                                                        $sql ="SELECT sum(total_paidout) as paidamount from referral_payments
                                                        where refferer_identity='$email'";
                                                        $query = $conn -> prepare($sql);
                                                        $query->execute();
                                                        $results=$query->fetch(PDO::FETCH_OBJ);
                                                ?>

                                                    <button class="btn btn-block btn-primary">
                                                        <small>Paid Out Amount</small>
                                                        <p>Ksh
                                                            <span id="total_paidout">
                                                                <?php echo htmlentities($results->paidamount); ?>
                                                            </span> 
                                                        </p>
                                                    </button>
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-6">
                                                    <button class="btn btn-block btn-danger">
                                                        <small>Balance</small>
                                                        <p>Ksh
                                                            <span id="balanceamount"></span> 
                                                        </p>
                                                    </button>
                                                </div>
                                            </div>

                                            <script type="text/javascript">
                                                window.onload = hidepaymentbutton;
                                                function hidepaymentbutton() {

                                                    document.getElementById("payment_button").style.display = "none";
                                                    var referrals = document.getElementById("referrals_count").innerText;

                                                    if(referrals == '0'){
                                                        document.getElementById("payment_button").style.display = "none";
                                                    }else{
                                                        document.getElementById("payment_button").style.display = "block";
                                                    }

                                                    var totalrevenue = document.getElementById("total_revenue").innerText;
                                                    document.getElementById("revenue").value = totalrevenue ;

                                                    var totalpaidout = document.getElementById("total_paidout").innerText;
                                                    document.getElementById("paid").value = totalpaidout ;

                                                    var balanceamount = totalrevenue - totalpaidout;

                                                    document.getElementById("balanceamount").innerText = balanceamount ;
                                                    document.getElementById("balance").value = balanceamount ;
                                                }
                                            </script>

                                                <form method="post" action="practitioner_record_payment">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                                <input type="hidden" name="userid" value="<?php echo $email;?>">
                                                                <input type="hidden" name="revenue" id="revenue">
                                                                <input type="hidden" name="paid" id="paid">
                                                                <input type="hidden" name="balance" id="balance">
                                                        </div>
                                                    </div>

                                                    <div class="card-action" id="payment_button">
                                                        <button class="btn btn-success" type="submit">Record New Payment</button>
                                                    </div>
                                                </form>
                                            
                                    </div>
                                </div>
                                
                            </div>

							<?php }} 
									else{
                                        echo 'No Data Found !!';
                                        } 
                            ?>
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