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
                                                <div class="card-title">Stage Two : Client Assessment <br>
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
											<form method="post" action="classes/process_client_assessment">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="client_id" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                            <input type="hidden" name="client_name" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                            <input type="hidden" name="client_phone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <span class="input_error" id="entry_error"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6>ANTHROPOMETRY</h6>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label><span id="small_emphasy">*</span> Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="weight" id="weight" oninput="validate_assessment_data();">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><span id="small_emphasy">*</span> Height <small id="success_emphasy">(cms)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="height" id="height" oninput="validate_assessment_data();calculate_bmi();">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>BMI</label>
                                                                <input type="text" class="form-control input-full" name="bmi" id="bmi" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><span id="small_emphasy">*</span> Waist Circumference <small id="success_emphasy">(cms)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="waistcircumference" id="waistcircumference" oninput="validate_assessment_data();">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label><span id="small_emphasy">*</span>Age in Years & Months</label>
                                                <div class="row mt-0">
                                                    <div class="col-md-6">
                                                        <label><small id="success_emphasy">(yrs)</small></label>
                                                        <input type="number" min="0" class="form-control input-full" name="years" id="years" oninput="sum_age();validate_assessment_data();" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label><small id="success_emphasy">(months)</small></label>
                                                        <input type="number" min="0" class="form-control input-full" name="months" id="months" oninput="sum_age();validate_assessment_data();" required>
                                                    </div>
                                                </div>
                                                <div class="row mt-0">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control input-full" name="age" id="age" readonly>   
                                                    </div>   
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label><span id="small_emphasy">*</span>Gender</label>
                                                            <select class="form-control input-full" name="gender" id="gender" onchange="validate_assessment_data();" required>
                                                                <option value="">Choose Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div id="combo" style="display:none;">
                                                    <div class="row mt-3">
                                                            <div class="col-sm-6">
                                                                <label><span id="small_emphasy">*</span>Pregnant</label>
                                                                    <select class="form-control input-full" name="pregnant" id="pregnant" required>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No" selected >No</option>
                                                                    </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label><span id="small_emphasy">*</span>Lactating</label>
                                                                    <select class="form-control input-full" name="lactating" id="lactating" required>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No" selected >No</option>
                                                                    </select>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <h6>Conduct BIA Assessment?</h6>
                                                        <p class="demo">
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio" name="optionsRadios" id="conduct_assessment" onclick="Check();" value="Yes">
                                                                <span class="form-radio-sign">Yes</span>
                                                            </label>
                                                            <label class="form-radio-label">
                                                                <input class="form-radio-input" type="radio" name="optionsRadios" id="skip_assessment" onclick="Check();" value="No" checked>
                                                                <span class="form-radio-sign">No</span>
                                                            </label>
                                                        </p>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                    function Check() 
                                                        {
                                                            if(document.getElementById('conduct_assessment').checked){
                                                                document.getElementById('bia_assessment').style.display = 'block';
                                                            }
                                                            else{
                                                                document.getElementById('bia_assessment').style.display = 'none';
                                                            }
                                                        }

                                                </script>
                                                <div class="row mt-3" id="bia_assessment" style="display:none;">
                                                    <div class="col-md-12">
                                                        <h6>BIA - ASSESSMENT <small id="success_emphasy">(Optional)</small> </h6>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Fat %</label>
                                                                <input type="number" min="0" class="form-control input-full" name="fat_percentage" id="fat_percentage">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Bone Mass <small id="success_emphasy">(Kgs)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="bone_mass" id="bone_mass">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Visceral Fat</label>
                                                                <input type="number" min="0" class="form-control input-full" name="visceral_fat" id="visceral_fat">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Muscle Mass <small id="success_emphasy">(%)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="muscle_mass" id="muscle_mass">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Physique Rating</label>
                                                                <input type="number" min="0" class="form-control input-full" name="physique_rating" id="physique_rating">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>BMR <small id="success_emphasy">(Kcals)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="bmr" id="bmr">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Metabolic Age <small id="success_emphasy">(yrs)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="metabolic_age" id="metabolic_age">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Total Body Water <small id="success_emphasy">(%)</small></label>
                                                                <input type="number" min="0" class="form-control input-full" name="body_water" id="body_water">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <h6><span id="small_emphasy">*</span> BIOCHEMICAL ASSESSMENT</h6>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="biochemical_assessment" id="biochemical_assessment" oninput="validate_assessment_data();" rows="5" placeholder="Interprete Lab Results Here.."></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6><span id="small_emphasy">*</span> CLINICAL ASSESSMENT (O/E)</h6>
                                                        <textarea class="form-control input-pill" style="resize:none;" name="clinical_assessment" id="clinical_assessment" oninput="validate_assessment_data();"  rows="5" placeholder="Include Vital Signs.."></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <span class="input_error" id="entry_error"></span>
                                                    </div>
                                                </div>

												<div class="card-action">
														<input type="submit" name="save_assessment" id="save_assessment" class="btn btn-success btn-xs" value="Submit Assessment" style="display:none;" >
                                                        <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                </div>
											</form>
                                                <div id="next_button">
                                                    <a class="btn btn-warning btn-xs" href="start_assessment?view=<?php echo htmlentities($result->ID);?>">Back</a>
                                                    <a class="btn btn-success btn-xs" href="final_assessment?view=<?php echo htmlentities($result->ID);?>">Proceed </a>
                                                </div>
												<script>
                                                    function validate_assessment_data(){
                                                        var a  = document.getElementById("weight").value;
                                                        var b = document.getElementById("height").value;
                                                        var c = document.getElementById("waistcircumference").value;
                                                        var d = document.getElementById("biochemical_assessment").value;
                                                        var e = document.getElementById("clinical_assessment").value;
                                                        var f = document.getElementById("age").value;
                                                        var g = document.getElementById("gender").value;
                                                        var h = document.getElementById("pregnant").value;
                                                        var i = document.getElementById("lactating").value;
                                                        

                                                        let text;

                                                        if(a != '' && b != '' && c != '' && d != '' && e != '' && f != '' && g != '' && h != '' && i != ''){
                                                            document.getElementById("save_assessment").style.display = "block";
                                                            document.getElementById("entry_error").style.display = "none";
                                                        }
                                                        else{
                                                            text = "Please Fill all the Marked Fields to Proceed!";
                                                            document.getElementById("save_assessment").style.display = "none";
                                                            document.getElementById("entry_error").style.display = "block";
                                                            document.getElementById("entry_error").innerHTML = text;

                                                        }
                                                    }

                                                    function calculate_bmi(){
                                                        var weight  = document.getElementById("weight").value;
                                                        var height = document.getElementById("height").value;
                                                        var convertedheight = height/100;

                                                        var bmi = (weight / (convertedheight * convertedheight)).toFixed(2);

                                                        document.getElementById("bmi").value = bmi;

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