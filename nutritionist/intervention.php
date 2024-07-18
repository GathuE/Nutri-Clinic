<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Intervention ";
		$page_title = "Intervention";


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

							<!-- Place Other Contents Here -->

                            <?php 
									error_reporting(E_ALL & E_NOTICE);
									include 'includes/db_conn.php'; 
									$id=$_GET['view'];
									$sql = "SELECT * FROM walkin_clients WHERE ID='$id'";
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


									<div class="card">
										<div class="card-header">
												<div class="card-title">Stage Five : Nutrition Intervention <br>
                                                <a href="clients" class="btn btn-warning btn-xs">View All Clients</a>
                                                    <div class="card-title-right">
                                                        <span>
                                                            <p id="client_details"> 
                                                                Client Name : <?php echo htmlentities($result->clientname);?><br>
                                                                Phone Number : <?php echo htmlentities($result->phonenumber);?><br>
                                                            </p> 
                                                        </span>

                                                        <!-- Directive Buttons -->

                                                        <div id="next_button">
                                                            <a class="btn btn-warning btn-xs" href="client_dri?view=<?php echo htmlentities($result->ID);?>">Back</a>
                                                            <a class="btn btn-success btn-xs" href="#?view=<?php echo htmlentities($result->ID);?>">Proceed</a>
                                                        </div>

                                                        
                                                    </div>
                                                </div>
										</div>

										<div class="card-body">
												<div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="client_id" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                            <input type="hidden" name="client_name" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                            <input type="hidden" name="client_phone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>


												<div class="row mt-0">
                                                    <div class="col-sm-12">
                                                        <div class="container">
                                                            <span id="success_emphasy">Please make a Nutrition Intervention as guided by the Nutrition Diagnostic Statement.</span>
															<br>
                                                            <ul class="nav nav-tabs">
                                                                <li><a class="btn btn-info btn-xs" data-toggle="tab" href="#nutrition_counseling">Nutrition Counseling</a></li> &nbsp;
                                                                <li><a class="btn btn-primary btn-xs" data-toggle="tab" href="#prescription">Prescription</a></li> &nbsp;
                                                                <li><a class="btn btn-success btn-xs" data-toggle="tab" href="#orderlist">Order List</a></li> &nbsp;
                                                                <li><a class="btn btn-warning btn-xs" data-toggle="tab" href="#mealplan">Meal Plan</a></li> &nbsp;
																<li><a class="btn btn-warning btn-xs" data-toggle="tab" href="#document_printout">Print</a></li> 
                                                            </ul>

															<div class="tab-content">

																<!-- Nutrition Counseling Tab -->

																	<div id="nutrition_counseling" class="tab-pane fade">
																		<br>
																		<span id="success_emphasy">Nutrition Counseling</span>

																			<form method="post" action="" id="counseling-form">
																				<div class="row">
																					<div class="col-md-12">
                                                                                            <textarea class="form-control input-pill" style="resize:none;margin-right:auto;margin-left:auto;font-size:12px;" name="nutrition_counseling" id="nutrition_counseling" oninput="validatecounseling();" rows="3" placeholder="Type Here.." required></textarea>
																					</div>
																				</div>
																				<div class="row mt-3">
																					<div class="col-md-12">
																						<span class="input_error" id="counseling_error"></span>
																					</div>
																				</div>
																				<div class="row mt-3">
																					<div class="card-action">
																							<input type="submit" name="save_counseling" id="save_counseling" class="btn btn-success btn-xs" value="Save Counseling" style="display:none;" >
																							<input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
																					</div>
																				</div>
																			</form>
																	</div>


																	<script>
																		function validatecounseling(){
																			var counseling = document.getElementById("nutrition_counseling").value;
													
																			let text;

																			if(counseling != ''){
																				document.getElementById("save_counseling").style.display = "block";
																				document.getElementById("counseling_error").style.display = "none";
																			}
																			else{
																				text = "Please Type in your Nutrition Counseling!!";
																				document.getElementById("save_counseling").style.display = "none";
																				document.getElementById("counseling_error").style.display = "block";
																				document.getElementById("counseling_error").innerHTML = text;

																			}
																		}
                                                                	</script>

																<!-- Nutrition Counseling Tab -->

																<!-- Prescription Tab -->

																	<div id="prescription" class="tab-pane fade">
																		<br>
																		<span id="success_emphasy">Prescription</span>

																		<?php 
																				error_reporting(E_ALL & E_NOTICE);
																				include 'includes/db_conn.php'; 
																				$id=$_GET['view'];
																				$sql = "SELECT * FROM walkin_clients WHERE ID='$id'";
																				$query= $conn->prepare($sql);
																				$query-> execute();
																				$results = $query -> fetchAll(PDO::FETCH_OBJ);
																				if($query -> rowCount() > 0)
																				{
																				foreach($results as $resultk)
																				{
																		?>

																			<form method="post" action="classes/print_prescription" id="prescription-form">
																				<div class="row">
																					<div class="col-md-6">
																						<input type="hidden" name="client_refno" id="client_refno" value="<?php echo htmlentities($resultk->ID);?>">
                                                                                        <input type="text" class="form-control input-pill" style="font-size:12px;" name="prescription_one" id="prescription_one" oninput="validateprescription();"  placeholder="First Prescription..."><br>
																						<input type="text" class="form-control input-pill" style="font-size:12px;" name="prescription_two" id="prescription_two" oninput="validateprescription();"  placeholder="Second Prescription..."><br>
																						<input type="text" class="form-control input-pill" style="font-size:12px;" name="prescription_three" id="prescription_three" oninput="validateprescription();"  placeholder="Third Prescription..."><br>
																					</div>
																					<div class="col-md-6">
																						<input type="text" class="form-control input-pill" style="font-size:12px;" name="prescription_four" id="prescription_four" oninput="validateprescription();"  placeholder="Fourth Prescription..."><br>
																						<input type="text" class="form-control input-pill" style="font-size:12px;" name="prescription_five" id="prescription_five" oninput="validateprescription();"  placeholder="Fifth Prescription..."><br>
																						<input type="text" class="form-control input-pill" style="font-size:12px;" name="prescription_six" id="prescription_six" oninput="validateprescription();"  placeholder="Sixth Prescription..."><br>
																					</div>
																				</div>
																				<div class="row mt-3">
																					<div class="col-md-12">
																						<span class="input_error" id="prescription_error"></span>
																					</div>
																				</div>
																				<div class="row mt-3">
																					<div class="card-action">
																							<input type="submit" name="save_prescription" id="save_prescription" class="btn btn-success btn-xs" value="Save & Print Prescription" style="display:none;" >
																							<input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
																					</div>
																				</div>
																			</form>


																		<?php }} 
																				else{
																					echo '<p>No Data Found !!</p>';
																					} 
																		?>


																	</div>


																	<script>
																		function validateprescription(){
																			var prescription_one = document.getElementById("prescription_one").value;
													
																			let text;

																			if(prescription_one != ''){
																				document.getElementById("save_prescription").style.display = "block";
																				document.getElementById("prescription_error").style.display = "none";
																				document.getElementById("prescription_two").disabled = false;
																				document.getElementById("prescription_three").disabled = false;
																				document.getElementById("prescription_four").disabled = false;
																				document.getElementById("prescription_five").disabled = false;
																				document.getElementById("prescription_six").disabled = false;
																			}
																			else{
																				text = "You have not made any Prescription Yet!!";
																				document.getElementById("save_prescription").style.display = "none";
																				document.getElementById("prescription_two").disabled = true;
																				document.getElementById("prescription_three").disabled = true;
																				document.getElementById("prescription_four").disabled = true;
																				document.getElementById("prescription_five").disabled = true;
																				document.getElementById("prescription_six").disabled = true;
																				document.getElementById("prescription_error").style.display = "block";
																				document.getElementById("prescription_error").innerHTML = text;

																			}
																		}
                                                                	</script>

																<!-- Prescription Tab -->

																<!-- OrderList Tab -->

																	<div id="orderlist" class="tab-pane fade">
																		<br>
																		<span id="success_emphasy">OrderList</span>

																		<div class="card">
																			<div class="row">
																				<div class="col-md-12">

																				</div>
																			</div>
																		</div>
																		

																	</div>

																<!-- OrderList Tab -->

																<!-- Mealplan Tab -->

																	<div id="mealplan" class="tab-pane fade">
																		<br>
																		<span id="success_emphasy">Mealplan</span>
																		

																	</div>

																<!-- Mealplan Tab -->

																<!-- Document Printing Tab -->

																<div id="document_printout" class="tab-pane fade">
																		<br>
																		<span id="success_emphasy">Please Select the Document to Print.</span>

																		<form method="post" action="classes/print_prescription">

																			<input type="hidden" name="client_refno" id="client_refno" value="<?php echo htmlentities($resultk->ID);?>">

																			<input type="submit" name="submit" class="btn btn-success btn-xs" value="Prescription" >
																		
																		</form>
																	</div>

																<!-- Document Printing Tab -->

															</div>
														</div>
													</div>
												</div>


										</div>
									</div>

                                    
                                </div>
                            </div>

							<?php }} 
									else{
										echo '<p>No Data Found !!</p>';
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