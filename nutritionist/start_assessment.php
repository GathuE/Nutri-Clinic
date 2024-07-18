<?php
session_start();
error_reporting(E_ALL);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Nutrition Care Process";
		$page_title = "Nutrition Care Process";

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
                                                <div class="card-title">Stage One : Client History <br>
                                                <a href="clients" class="btn btn-warning btn-xs">View All Clients</a>
                                                    <div class="card-title-right">
                                                        <span>
                                                            <p id="client_details"> 
                                                                Client Name : <?php echo htmlentities($result->clientname);?><br>
                                                                Phone Number : <?php echo htmlentities($result->phonenumber);?><br>
                                                            </p> 
                                                        </span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
											<div class="card-body">
											<form method="post" action="classes/process_client_history">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="client_id" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                            <input type="hidden" name="client_name" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                            <input type="hidden" name="client_phone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>1. PC <small id="success_emphasy">Chief Complaints</small></label>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="pc" id="pc" oninput="validateentries();" rows="5" placeholder="Enter your Notes Here.."></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>2. HPC <small id="success_emphasy">History of Presenting Complaints</small></label>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="hpc" id="hpc" rows="5" placeholder="Enter your Notes Here.."></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label>3. MHx<small id="success_emphasy">Medical History</small></label>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="mhx" id="mhx" rows="5" placeholder="Enter your Notes Here.."></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>4. FmHx <small id="success_emphasy">Family History</small></label>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="fmhx" id="fmhx" rows="5" placeholder="Enter your Notes Here.."></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label>5. SHx <small id="success_emphasy">Social & Economic History</small></label>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="shx" id="shx" rows="5" placeholder="Enter your Notes Here.."></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>6. DrugHx <small id="success_emphasy">Drug and Supplement History</small></label>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="dhx" id="dhx" oninput="validateentries();" rows="5" placeholder="Enter your Notes Here.."></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <span class="input_error" id="entry_error"></span>
                                                    </div>
                                                </div>

												<div class="card-action">
														<input type="submit" name="save_history" id="save_history" class="btn btn-success btn-xs" value="Submit History" style="display:none;" >
                                                        <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                </div>
											</form>
                                                <div id="next_button">
                                                    <a class="btn btn-success btn-xs" href="proceed_assessment?view=<?php echo htmlentities($result->ID);?>">Proceed </a>
                                                </div>
												<script>
                                                    function validateentries(){
                                                        var pc_entry = document.getElementById("pc").value;
                                                        var dhx_entry = document.getElementById("dhx").value;

                                                        let text;

                                                        if(pc_entry != '' && dhx_entry != ''){
                                                            document.getElementById("save_history").style.display = "block";
                                                            document.getElementById("entry_error").style.display = "none";
                                                        }
                                                        else{
                                                            text = "Please Fill all the Fields to Proceed!";
                                                            document.getElementById("save_history").style.display = "none";
                                                            document.getElementById("entry_error").style.display = "block";
                                                            document.getElementById("entry_error").innerHTML = text;

                                                        }
                                                    }
                                                </script>
												
													

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