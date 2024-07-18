<?php
session_start();
error_reporting(0);
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
                                                <div class="card-title">Stage Four : Client Diet Analysis <br>
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
                                                            <a class="btn btn-warning btn-xs" href="final_assessment?view=<?php echo htmlentities($result->ID);?>">Back</a>
                                                            <a class="btn btn-success btn-xs" href="intervention?view=<?php echo htmlentities($result->ID);?>">Proceed</a>
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
                                                            <span id="success_emphasy">Choose one Predictive Equation to Calculate Client Nutrients</span>
                                                            <ul class="nav nav-tabs">
                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#iom" onclick="return special_conditions_iom();">IOM 2006 Eq</a></li>
                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#harris" onclick="return special_conditions_harris();">Harris Benedict Eq</a></li>
                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#mifflin" onclick="return special_conditions_mifflin();">Mifflin St.Jeor Eq</a></li>
                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#kcalsbwt" onclick="return special_conditions_kcalsbwt();">Kcals/BodyWeight Eq</a></li>
                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#who" onclick="return special_conditions_who();">WHO(1985) Eq</a></li>
                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#schofield" onclick="return special_conditions_schofield();">Schofield Eq</a></li>
                                                                <li><a class="btn btn-success btn-xs" data-toggle="tab" href="#diagnosticdata">Diagnosis Data</a></li>&nbsp;
                                                                <li><a class="btn btn-warning btn-xs" data-toggle="tab" href="#makediagnosis">Make Diagnosis</a></li>

                                                            </ul>

                                                <div class="tab-content">

                                    <?php 
                                            error_reporting(E_ALL & E_NOTICE);
                                            include 'includes/db_conn.php'; 
                                            $id=$_GET['view'];
                                            $sql = "SELECT * FROM walkin_assessmentdata WHERE user_id='$id'";
                                            $query= $conn->prepare($sql);
                                            $query-> execute();
                                            $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                            if($query -> rowCount() > 0)
                                            {
                                            foreach($results as $result)
                                            {
                                    ?>

                                                                <div id="iom" class="tab-pane fade">
                                                                    <br>
                                                                    <span id="success_emphasy">Institute of Medicine(2006)</span>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form method="post" action="" id="iom-form">
                                                                                                <input type="hidden" id="iom_client_id" value="<?php echo htmlentities($result->user_id); ?>">
                                                                                                <input type="hidden" id="iom_clientname" value="<?php echo htmlentities($result->client_name); ?>">
                                                                                                <input type="hidden" id="iom_clientphone" value="<?php echo htmlentities($result->client_phone); ?>">

                                                                                                <input type="hidden" class="form-control input-full" id="iom_formula" value="iom" readonly>
                                                                                        <div class="row mt-0">
                                                                                            <div class="col-md-6">
                                                                                                <label>Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="iom_weight" value="<?php echo htmlentities($result->weight); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Height <small id="success_emphasy">(cms)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="iom_height" value="<?php echo htmlentities($result->height); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Age <small id="success_emphasy">(yrs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="iom_age" value="<?php echo htmlentities($result->age_sum); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Gender</label>
                                                                                                <input type="text" class="form-control input-full" id="iom_gender" value="<?php echo htmlentities($result->gender); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="gender_combo_iom" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label>Pregnant </label>
                                                                                                    <input type="text" class="form-control input-full" id="iom_pregnant" value="<?php echo htmlentities($result->pregnant); ?>" readonly>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label>Lactating</label>
                                                                                                    <input type="text" class="form-control input-full" id="iom_lactating" value="<?php echo htmlentities($result->lactating); ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <label><span id="small_emphasy">*</span>Physical ACtivity Level(P.A.L)</label>
                                                                                                    <select class="form-control input-full" id="iom_pal" required>
                                                                                                        <option value="">Choose Physical Activity Level...</option>
                                                                                                        <option value="Sedentary">Sedentary</option>
                                                                                                        <option value="Light">Light</option>
                                                                                                        <option value="Moderate">Moderate</option>
                                                                                                        <option value="Heavy">Heavy</option>
                                                                                                    </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <span id="success_emphasy">Custom Macro-Nutrients Distribution</span>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <span id="ratio_alert"></span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>CHO %</label>
                                                                                                <input type="text" class="form-control input-full" id="carbohydrate_ratio_iom" oninput="calculate_ratio_iom();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>Fats %</label>
                                                                                                <input type="text" class="form-control input-full" id="fat_ratio_iom" oninput="calculate_ratio_iom();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label>Protein %</label>
                                                                                                <input type="text" class="form-control input-full" id="protein_ratio_iom" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="button"  id="calculate_eer" class="btn btn-success btn-xs" onclick="claculate_eer();calculate_nutrients();check_data_iom();"> calculate EER</button>
                                                                                                <button type="submit" id="save_eer" class="btn btn-success btn-xs">Save EER</button>
                                                                                                <input type="reset" id="reset_iom" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                        <div id="iom_nutrients" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-12">
                                                                                                        <table class="table table-striped mt-3" id="nutrients_table">
                                                                                                            <span id="success_emphasy">Nutrient Estimates</span>
                                                                                                            <thead>
                                                                                                                <tr> 
                                                                                                                    <td>Energy <small id="success_emphasy">(Kcals)</small></td>
                                                                                                                    <td><span id="iom_energy"></span></td>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td>Protein <small id="success_emphasy">(g)</small></td>
                                                                                                                    <td><span id ="iom_protein"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Fat <small id="success_emphasy">(g)</small></td>
                                                                                                                    <td><span id ="iom_fat"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Carbohydrate <small id="success_emphasy">(g)</small></td>
                                                                                                                    <td><span id ="iom_carbohydrate"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Water <small id="success_emphasy">(ml)</small></td>
                                                                                                                    <td><span id ="iom_water"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Fiber <small id="success_emphasy">(g)</small></td>
                                                                                                                    <td><span id ="iom_fibre"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Calcium <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_calcium"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Iron <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_iron"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Magnesium <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_magnesium"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Phosphorous <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_phosphorous"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Potassium <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_potassium"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Sodium <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_sodium"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Zinc <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_zinc"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Selenium <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_sellenium"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Vit_A_RAE <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_vitarae"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Vit_A_RE <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_vitare"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Retinol <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_retinol"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>B_Carotene <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_bcarotene"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Thiamin <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_thiamin"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Riboflavin <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_riboflavin"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Niacin <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_niacin"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Dietary Folate <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_dietaryfolate"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Food Folate <small id="success_emphasy">(mcg)</small></td>
                                                                                                                    <td><span id ="iom_foodfolate"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Vit_B12 <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_vitb12"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Vit_C <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_vitc"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Cholesterol <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_cholesterol"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Oxalic Acid <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_oxalicacid"></span></td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>Phytate <small id="success_emphasy">(mg)</small></td>
                                                                                                                    <td><span id ="iom_phytate"></span></td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                </div>

                                                                <script type="text/javascript">
                                                                    function special_conditions_iom() {
                                                                    //code
                                                                    
                                                                    var gender = document.getElementById("iom_gender").value;
                                                                    if(gender == 'Female'){
                                                                        document.getElementById("gender_combo_iom").style.display = "block";
                                                                    }
                                                                    else{
                                                                        document.getElementById("gender_combo_iom").style.display = "none";
                                                                    }
                                                                    return true;
                                                                    }
                                                                </script>
                                                                 <script type="text/javascript">

                                                                    function calculate_ratio_iom(){
                                                                        var cho = document.getElementById("carbohydrate_ratio_iom").value;
                                                                        var fat = document.getElementById("fat_ratio_iom").value;

                                                                        var protein_value = 100 - (Number(cho) + Number(fat));

                                                                        document.getElementById("protein_ratio_iom").value = protein_value;
                                                                        
                                                                    }
                                                                </script>

                                                                <script type="text/javascript">

                                                                function check_data_iom(){

                                                                    var energy = document.getElementById("iom_energy").innerHTML;

                                                                        if(energy == ''){
                                                                            document.getElementById("iom_nutrients").style.display = "none";
                                                                            document.getElementById("save_eer").disabled = true;
                                                                            document.getElementById("save_eer").style.cursor = "not-allowed";
                                                                            
                                                                        }
                                                                        else{
                                                                            document.getElementById("iom_nutrients").style.display = "block";
                                                                            document.getElementById("calculate_eer").disabled = true;
                                                                            document.getElementById("save_eer").disabled = false;
                                                                            document.getElementById("calculate_eer").style.cursor = "not-allowed";
                                                                            document.getElementById("save_eer").style.cursor = "pointer";

                                                                        }
                                                                }
                                                                </script>
                                                                

                                                                <div id="harris" class="tab-pane fade">
                                                                    <br>
                                                                    <span id="success_emphasy">Harris & Benedict Equation</span>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form method="post" action="" id="harris-form">
                                                                                                <input type="hidden" class="form-control input-full" id="harris_formula" value="harris" readonly>
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="harris_weight" value="<?php echo htmlentities($result->weight); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Height <small id="success_emphasy">(cms)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="harris_height" value="<?php echo htmlentities($result->height); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Age <small id="success_emphasy">(yrs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="harris_age" value="<?php echo htmlentities($result->age_sum); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Gender</label>
                                                                                                <input type="text" class="form-control input-full" id="harris_gender" value="<?php echo htmlentities($result->gender); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="gender_combo_harris" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label>Pregnant </label>
                                                                                                    <input type="text" class="form-control input-full" id="harris_pregnant" value="<?php echo htmlentities($result->pregnant); ?>" readonly>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label>Lactating</label>
                                                                                                    <input type="text" class="form-control input-full" id="harris_lactating" value="<?php echo htmlentities($result->lactating); ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <label><span id="small_emphasy">*</span>ACtivity Factor &nbsp; <span><i class="la la-info-circle" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></span></label>
                                                                                                <input type="text" class="form-control input-full" id="harris_activity_factor"  required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <span id="success_emphasy">Custom Macro-Nutrients Distribution</span>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <span id="ratio_alert"></span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>CHO %</label>
                                                                                                <input type="text" class="form-control input-full" id="carbohydrate_ratio_harris" oninput="calculate_ratio_harris();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>Fats %</label>
                                                                                                <input type="text" class="form-control input-full" id="fat_ratio_harris" oninput="calculate_ratio_harris();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label>Protein %</label>
                                                                                                <input type="text" class="form-control input-full" id="protein_ratio_harris" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_bee" class="btn btn-success btn-xs" >Calculate BEE</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <script type="text/javascript">
                                                                    function special_conditions_harris() {
                                                                    //code
                                                                    
                                                                    var gender = document.getElementById("harris_gender").value;
                                                                    if(gender == 'Female'){
                                                                        document.getElementById("gender_combo_harris").style.display = "block";
                                                                    }
                                                                    else{
                                                                        document.getElementById("gender_combo_harris").style.display = "none";
                                                                    }
                                                                    return true;
                                                                    }
                                                                </script>
                                                                 <script type="text/javascript">

                                                                    function calculate_ratio_harris(){
                                                                        var cho = document.getElementById("carbohydrate_ratio_harris").value;
                                                                        var fat = document.getElementById("fat_ratio_harris").value;

                                                                        var protein_value = 100 - (Number(cho) + Number(fat));

                                                                        document.getElementById("protein_ratio_harris").value = protein_value;
                                                                        
                                                                    }
                                                                </script>

                                                                <div id="mifflin" class="tab-pane fade">
                                                                    <br>
                                                                    <span id="success_emphasy">Mifflin St.Jeor Equation</span>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form method="post" action="" id="mifflin-form">
                                                                                                <input type="hidden" class="form-control input-full" id="mifflin_formula" value="mifflin" readonly>
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="mifflin_weight" value="<?php echo htmlentities($result->weight); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Height <small id="success_emphasy">(cms)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="mifflin_height" value="<?php echo htmlentities($result->height); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Age <small id="success_emphasy">(yrs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="mifflin_age" value="<?php echo htmlentities($result->age_sum); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Gender</label>
                                                                                                <input type="text" class="form-control input-full" id="mifflin_gender" value="<?php echo htmlentities($result->gender); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="gender_combo_mifflin" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label>Pregnant </label>
                                                                                                    <input type="text" class="form-control input-full" id="mifflin_pregnant" value="<?php echo htmlentities($result->pregnant); ?>" readonly>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label>Lactating</label>
                                                                                                    <input type="text" class="form-control input-full" id="mifflin_lactating" value="<?php echo htmlentities($result->lactating); ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <label><span id="small_emphasy">*</span>ACtivity Factor &nbsp; <span><i class="la la-info-circle" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></span></label>
                                                                                                <input type="text" class="form-control input-full" id="mifflin_activity_factor"  required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <span id="success_emphasy">Custom Macro-Nutrients Distribution</span>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <span id="ratio_alert"></span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>CHO %</label>
                                                                                                <input type="text" class="form-control input-full" id="carbohydrate_ratio_mifflin" oninput="calculate_ratio_mifflin();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>Fats %</label>
                                                                                                <input type="text" class="form-control input-full" id="fat_ratio_mifflin" oninput="calculate_ratio_mifflin();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label>Protein %</label>
                                                                                                <input type="text" class="form-control input-full" id="protein_ratio_mifflin" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_ree" class="btn btn-success btn-xs" >Calculate REE</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <script type="text/javascript">
                                                                    function special_conditions_mifflin() {
                                                                    //code
                                                                    
                                                                    var gender = document.getElementById("mifflin_gender").value;
                                                                    if(gender == 'Female'){
                                                                        document.getElementById("gender_combo_mifflin").style.display = "block";
                                                                    }
                                                                    else{
                                                                        document.getElementById("gender_combo_mifflin").style.display = "none";
                                                                    }
                                                                    return true;
                                                                    }
                                                                </script>
                                                                 <script type="text/javascript">

                                                                    function calculate_ratio_mifflin(){
                                                                        var cho = document.getElementById("carbohydrate_ratio_mifflin").value;
                                                                        var fat = document.getElementById("fat_ratio_mifflin").value;

                                                                        var protein_value = 100 - (Number(cho) + Number(fat));

                                                                        document.getElementById("protein_ratio_mifflin").value = protein_value;
                                                                        
                                                                    }
                                                                </script>

                                                                <div id="kcalsbwt" class="tab-pane fade">
                                                                    <br>
                                                                    <span id="success_emphasy">Kcals Per BodyWeight Equation</span>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form method="post" action="" id="kcalsbwt-form">
                                                                                                <input type="hidden" class="form-control input-full" id="kcalsbwt_formula" value="kcalsbwt" readonly>
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="kcalsbwt_weight" value="<?php echo htmlentities($result->weight); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Height <small id="success_emphasy">(cms)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="kcalsbwt_height" value="<?php echo htmlentities($result->height); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Age <small id="success_emphasy">(yrs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="kcalsbwt_age" value="<?php echo htmlentities($result->age_sum); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Gender</label>
                                                                                                <input type="text" class="form-control input-full" id="kcalsbwt_gender" value="<?php echo htmlentities($result->gender); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="gender_combo_kcalsbwt" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label>Pregnant </label>
                                                                                                    <input type="text" class="form-control input-full" id="kcalsbwt_pregnant" value="<?php echo htmlentities($result->pregnant); ?>" readonly>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label>Lactating</label>
                                                                                                    <input type="text" class="form-control input-full" id="kcalsbwt_lactating" value="<?php echo htmlentities($result->lactating); ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <label><span id="small_emphasy">*</span>ACtivity Factor &nbsp; <span><i class="la la-info-circle" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></span></label>
                                                                                                <input type="text" class="form-control input-full" id="kcalsbwt_activity_factor"  required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <span id="success_emphasy">Custom Macro-Nutrients Distribution</span>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <span id="ratio_alert"></span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>CHO %</label>
                                                                                                <input type="text" class="form-control input-full" id="carbohydrate_ratio_kcalsbwt" oninput="calculate_ratio_kcalsbwt();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>Fats %</label>
                                                                                                <input type="text" class="form-control input-full" id="fat_ratio_kcalsbwt" oninput="calculate_ratio_kcalsbwt();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label>Protein %</label>
                                                                                                <input type="text" class="form-control input-full" id="protein_ratio_kcalsbwt" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_kcals" class="btn btn-success btn-xs" >Calculate Kcals</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <script type="text/javascript">
                                                                    function special_conditions_kcalsbwt() {
                                                                    //code
                                                                    
                                                                    var gender = document.getElementById("kcalsbwt_gender").value;
                                                                    if(gender == 'Female'){
                                                                        document.getElementById("gender_combo_kcalsbwt").style.display = "block";
                                                                    }
                                                                    else{
                                                                        document.getElementById("gender_combo_kcalsbwt").style.display = "none";
                                                                    }
                                                                    return true;
                                                                    }
                                                                </script>
                                                                <script type="text/javascript">

                                                                    function calculate_ratio_kcalsbwt(){
                                                                        var cho = document.getElementById("carbohydrate_ratio_kcalsbwt").value;
                                                                        var fat = document.getElementById("fat_ratio_kcalsbwt").value;

                                                                        var protein_value = 100 - (Number(cho) + Number(fat));

                                                                        document.getElementById("protein_ratio_kcalsbwt").value = protein_value;
                                                                        
                                                                    }
                                                                </script>

                                                                <div id="who" class="tab-pane fade">
                                                                    <br>
                                                                    <span id="success_emphasy">W.H.O Equation</span>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form method="post" action="" id="who-form">
                                                                                                <input type="hidden" class="form-control input-full" id="who_formula" value="who" readonly>
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="who_weight" value="<?php echo htmlentities($result->weight); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Height <small id="success_emphasy">(cms)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="who_height" value="<?php echo htmlentities($result->height); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Age <small id="success_emphasy">(yrs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="who_age" value="<?php echo htmlentities($result->age_sum); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Gender</label>
                                                                                                <input type="text" class="form-control input-full" id="who_gender" value="<?php echo htmlentities($result->gender); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="gender_combo_who" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label>Pregnant </label>
                                                                                                    <input type="text" class="form-control input-full" id="who_pregnant" value="<?php echo htmlentities($result->pregnant); ?>" readonly>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label>Lactating</label>
                                                                                                    <input type="text" class="form-control input-full" id="who_lactating" value="<?php echo htmlentities($result->lactating); ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <label><span id="small_emphasy">*</span>ACtivity Factor &nbsp; <span><i class="la la-info-circle" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></span></label>
                                                                                                <input type="text" class="form-control input-full" id="who_activity_factor"  required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <span id="success_emphasy">Custom Macro-Nutrients Distribution</span>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <span id="ratio_alert"></span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>CHO %</label>
                                                                                                <input type="text" class="form-control input-full" id="carbohydrate_ratio_who" oninput="calculate_ratio_who();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>Fats %</label>
                                                                                                <input type="text" class="form-control input-full" id="fat_ratio_who" oninput="calculate_ratio_who();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label>Protein %</label>
                                                                                                <input type="text" class="form-control input-full" id="protein_ratio_who" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_bmr_who" class="btn btn-success btn-xs" >Calculate BMR</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <script type="text/javascript">
                                                                    function special_conditions_who() {
                                                                    //code
                                                                    
                                                                    var gender = document.getElementById("who_gender").value;
                                                                    if(gender == 'Female'){
                                                                        document.getElementById("gender_combo_who").style.display = "block";
                                                                    }
                                                                    else{
                                                                        document.getElementById("gender_combo_who").style.display = "none";
                                                                    }
                                                                    return true;
                                                                    }
                                                                </script>
                                                                 <script type="text/javascript">

                                                                    function calculate_ratio_who(){
                                                                        var cho = document.getElementById("carbohydrate_ratio_who").value;
                                                                        var fat = document.getElementById("fat_ratio_who").value;

                                                                        var protein_value = 100 - (Number(cho) + Number(fat));

                                                                        document.getElementById("protein_ratio_who").value = protein_value;
                                                                        
                                                                    }
                                                                </script>

                                                                <div id="schofield" class="tab-pane fade">
                                                                    <br>
                                                                    <span id="success_emphasy">Schofield Equation</span>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                        <div class="card">
                                                                                <div class="card-body">
                                                                                    <form method="post" action="" id="schofield-form">
                                                                                                <input type="hidden" class="form-control input-full" id="schofield_formula" value="schofield" readonly>
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Weight <small id="success_emphasy">(Kgs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="schofield_weight" value="<?php echo htmlentities($result->weight); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Height <small id="success_emphasy">(cms)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="schofield_height" value="<?php echo htmlentities($result->height); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <label>Age <small id="success_emphasy">(yrs)</small></label>
                                                                                                <input type="text" class="form-control input-full" id="schofield_age" value="<?php echo htmlentities($result->age_sum); ?>" readonly>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label>Gender</label>
                                                                                                <input type="text" class="form-control input-full" id="schofield_gender" value="<?php echo htmlentities($result->gender); ?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="gender_combo_schofield" style="display:none;">
                                                                                            <div class="row mt-3">
                                                                                                <div class="col-md-6">
                                                                                                    <label>Pregnant </label>
                                                                                                    <input type="text" class="form-control input-full" id="schofield_pregnant" value="<?php echo htmlentities($result->pregnant); ?>" readonly>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <label>Lactating</label>
                                                                                                    <input type="text" class="form-control input-full" id="schofield_lactating" value="<?php echo htmlentities($result->lactating); ?>" readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <label><span id="small_emphasy">*</span>ACtivity Factor &nbsp; <span><i class="la la-info-circle" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i></span></label>
                                                                                                <input type="text" class="form-control input-full" id="schofield_activity_factor"  required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-12">
                                                                                                <span id="success_emphasy">Custom Macro-Nutrients Distribution</span>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <span id="ratio_alert"></span>
                                                                                            </div>
                                                                                            
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>CHO %</label>
                                                                                                <input type="text" class="form-control input-full" id="carbohydrate_ratio_schofield" oninput="calculate_ratio_schofield();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label><span id="small_emphasy">*</span>Fats %</label>
                                                                                                <input type="text" class="form-control input-full" id="fat_ratio_schofield" oninput="calculate_ratio_schofield();" required>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <label>Protein %</label>
                                                                                                <input type="text" class="form-control input-full" id="protein_ratio_schofield" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_bmr_schofield" class="btn btn-success btn-xs" >Calculate BMR</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <script type="text/javascript">
                                                                    function special_conditions_schofield() {
                                                                    //code
                                                                    
                                                                    var gender = document.getElementById("schofield_gender").value;
                                                                    if(gender == 'Female'){
                                                                        document.getElementById("gender_combo_schofield").style.display = "block";
                                                                    }
                                                                    else{
                                                                        document.getElementById("gender_combo_schofield").style.display = "none";
                                                                    }
                                                                    return true;
                                                                    }
                                                                </script>
                                                                 <script type="text/javascript">

                                                                    function calculate_ratio_schofield(){
                                                                        var cho = document.getElementById("carbohydrate_ratio_schofield").value;
                                                                        var fat = document.getElementById("fat_ratio_schofield").value;

                                                                        var protein_value = 100 - (Number(cho) + Number(fat));

                                                                        document.getElementById("protein_ratio_schofield").value = protein_value;
                                                                        
                                                                    }
                                                                </script>

                                                                <div id="makediagnosis" class="tab-pane fade">
                                                                    <br>
                                                                    <h5 id="success_emphasy">Nutrition Diagnosis</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                        <form method="post" action="" id="diagnosis-form">
                                                                                <input type="hidden" id="client_id" value="<?php echo htmlentities($result->user_id); ?>">
                                                                                <input type="hidden" id="client_name" value="<?php echo htmlentities($result->client_name); ?>">
                                                                                <input type="hidden" id="client_phone" value="<?php echo htmlentities($result->client_phone); ?>">
                                                                            <div class="row">
                                                                                <div class="col">
                                                                                    <table class="table table-striped mt-3">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td colspan='3'>
                                                                                                    <label><small id="success_emphasy">1. Problem Statement </small></label>
                                                                                                    <small><textarea class="form-control input-pill" style="resize:none;margin-right:auto;margin-left:auto;font-size:12px;" name="problem_statement" id="problem_statement" oninput="validateinputs();" rows="3" placeholder="Enter Problem Statement Here.."></textarea></small>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='3' style="text-align:center;">
                                                                                                    <small><b><span id="span_alert">Related To</span></b></small>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='3'>
                                                                                                    <label><small id="success_emphasy">2. Etiology</small></label>
                                                                                                    <small><textarea class="form-control input-pill" style="resize:none;margin-right:auto;margin-left:auto;font-size:12px;" name="etiology" id="etiology" oninput="validateinputs();" rows="3" placeholder="Enter Etiology Here.."></textarea></small>
                                                                                                </td>
                                                                                            </tr> 
                                                                                            <tr>
                                                                                                <td colspan='3' style="text-align:center;">
                                                                                                    <small><b><span id="span_alert">as evidenced by</span></b></small>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='1'>
                                                                                                    <label><small id="success_emphasy">3.Signs & Symptoms</small></label>
                                                                                                    <small><textarea class="form-control input-pill" style="resize:none;margin-right:auto;margin-left:auto;font-size:12px;" name="symptoms" id="symptoms" oninput="validateinputs();" rows="3" placeholder="Enter Symptoms Here.."></textarea></small>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-md-12">
                                                                                    <span class="input_error" id="diagnosis_error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-action">
                                                                                    <input type="submit" name="save_diagnosis" id="save_diagnosis" class="btn btn-success btn-xs" value="Submit Diagnosis" style="display:none;" >
                                                                                    <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                            </div>
                                                                        </form>

                                                                </div>

                                                                <script>
                                                                    function validateinputs(){
                                                                        var problem_statement = document.getElementById("problem_statement").value;
                                                                        var etiology = document.getElementById("etiology").value;
                                                                        var symptoms = document.getElementById("symptoms").value;

                                                                        let text;

                                                                        if(problem_statement != '' && etiology != '' && symptoms != ''){
                                                                            document.getElementById("save_diagnosis").style.display = "block";
                                                                            document.getElementById("diagnosis_error").style.display = "none";
                                                                        }
                                                                        else{
                                                                            text = "Please Fill all the Fields to Proceed!";
                                                                            document.getElementById("save_diagnosis").style.display = "none";
                                                                            document.getElementById("diagnosis_error").style.display = "block";
                                                                            document.getElementById("diagnosis_error").innerHTML = text;

                                                                        }
                                                                    }
                                                                </script>

                                                                            
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <div id="diagnosticdata" class="tab-pane fade">
                                                                    <br>
                                                                        <div class="row">

                                                                        <?php 
                                                                                error_reporting(E_ALL & E_NOTICE);
                                                                                include 'includes/db_conn.php';
                                                                                $id=$_GET['view'];
                                                                                $sql = "SELECT * from walkin_clienthistory WHERE client_code='$id'";
                                                                                $query = $conn->prepare($sql);
                                                                                $query->execute();
                                                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                                $cnt=1;
                                                                                if($query->rowCount() > 0)
                                                                                {
                                                                                foreach($results as $result1)
                                                                                {				
                                                                        ?>


                                                                            <div class="col-sm-6">
                                                                                <h4 id="success_emphasy"><b>1. Client History</b></h4>
                                                                                <table class="table table-striped mt-3">
                                                                                    <tbody>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small id="success_emphasy">Client Complaints</small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small><?php echo htmlentities($result1->pc);?></small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td  colspan='2'> <small id="success_emphasy">History of Presenting Complaints</small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small><?php echo htmlentities($result1->hpc);?></small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td  colspan='2'><small id="success_emphasy">Client Medical History </small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small><?php echo htmlentities($result1->mhx);?></small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small id="success_emphasy">Family History</small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small><?php echo htmlentities($result1->fmhx);?></small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small id="success_emphasy">Social Economic History</small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small><?php echo htmlentities($result1->shx);?></small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'><small id="success_emphasy">Drug & Supplement History </small></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan='2'> <small><?php echo htmlentities($result1->dhx);?></small></td>
                                                                                            </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                            <?php }} 
                                                                                else{
                                                                                    echo '<p id="table_alert">Client Data Not Found !!</p>';
                                                                                    } 
                                                                            ?>

                                                                        <?php 
                                                                                error_reporting(E_ALL & E_NOTICE);
                                                                                include 'includes/db_conn.php';
                                                                                $id=$_GET['view'];
                                                                                $sql = "SELECT * from walkin_assessmentdata WHERE user_id='$id'";
                                                                                $query = $conn->prepare($sql);
                                                                                $query->execute();
                                                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                                $cnt=1;
                                                                                if($query->rowCount() > 0)
                                                                                {
                                                                                foreach($results as $result4)
                                                                                {				
                                                                        ?>

                                                                                <h4 id="success_emphasy"><b>2. Client Anthropometry</b></h4>

                                                                                <table class="table table-striped mt-3">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Weight (kgs)</small></td>
                                                                                            <td><small id="success_emphasy">Height (cms)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->weight);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->height);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">BMI</small></td>
                                                                                            <td><small id="success_emphasy">W.C (cms)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->bmi);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->waistcircumference);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Age (Yrs)</small></td>
                                                                                            <td><small id="success_emphasy">Age (Months)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->age_years);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->age_months);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Age</small></td>
                                                                                            <td><small id="success_emphasy">Gender</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->age_sum);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->gender);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Pregnancy Status</small></td>
                                                                                            <td><small id="success_emphasy">Lactating Status</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->pregnant);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->lactating);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Fat-Percentage (%)</small></td>
                                                                                            <td><small id="success_emphasy">Bone-Mass (kgs)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->fat_percentage);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->bone_mass);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Visceral-Fat</small></td>
                                                                                            <td><small id="success_emphasy">Muscle-Mass (%)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->visceral_fat);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->muscle_mass);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Physique-Rating</small></td>
                                                                                            <td><small id="success_emphasy">Basal Metabolic Rate(BMR)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->physique_rating);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->bmr);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td><small id="success_emphasy">Metabolic Age (yrs)</small></td>
                                                                                            <td><small id="success_emphasy">Body Water(%)</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->metabolic_age);?></small></td>
                                                                                            <td colspan='1'> <small><?php echo htmlentities($result4->body_water);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='2'><small id="success_emphasy">Biochemical Assessment</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='2'> <small><?php echo htmlentities($result4->biochemical_assessment);?></small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='2'><small id="success_emphasy">Clinical Assessment</small></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan='2'> <small><?php echo htmlentities($result4->clinical_assessment);?></small></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>


                                                                            <?php }} 
                                                                                else{
                                                                                    echo '<p id="table_alert">Client Data Not Found !!</p>';
                                                                                    } 
                                                                            ?>

                                                                      

                                                                        <?php 
                                                                                error_reporting(E_ALL & E_NOTICE);
                                                                                include 'includes/db_conn.php';
                                                                                $id=$_GET['view'];
                                                                                $sql = "SELECT * from walkin_referencedata WHERE client_ref='$id'";
                                                                                $query = $conn->prepare($sql);
                                                                                $query->execute();
                                                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                                $cnt=1;
                                                                                if($query->rowCount() > 0)
                                                                                {
                                                                                foreach($results as $result1)
                                                                                {				
                                                                        ?>

                                                                        <?php 
                                                                            error_reporting(E_ALL & E_NOTICE);
                                                                            include 'includes/db_conn.php'; 
                                                                            $id=$_GET['view'];
                                                                            $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                                            sum(round(servings.energy*walkin_mealhistory.amount, 2)) as totalenergy,
                                                                            sum(round(servings.water*walkin_mealhistory.amount, 2)) as totalwater,
                                                                            sum(round(servings.protein*walkin_mealhistory.amount, 2)) as totalprotein,
                                                                            sum(round(servings.fat*walkin_mealhistory.amount, 2)) as totalfat,
                                                                            sum(round(servings.cho*walkin_mealhistory.amount, 2)) as totalcarbohydrate,
                                                                            sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as totalfiber,
                                                                            sum(round(servings.ca*walkin_mealhistory.amount, 2)) as totalca,
                                                                            sum(round(servings.fe*walkin_mealhistory.amount, 2)) as totalfe,
                                                                            sum(round(servings.mg*walkin_mealhistory.amount, 2)) as totalmg,
                                                                            sum(round(servings.p*walkin_mealhistory.amount, 2)) as totalp,
                                                                            sum(round(servings.k*walkin_mealhistory.amount, 2)) as totalk,
                                                                            sum(round(servings.na*walkin_mealhistory.amount, 2)) as totalna,
                                                                            sum(round(servings.zn*walkin_mealhistory.amount, 2)) as totalzn,
                                                                            sum(round(servings.se*walkin_mealhistory.amount, 2)) as totalse,
                                                                            sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as totalVit_A_RAE,
                                                                            sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as totalVit_A_RE,
                                                                            sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as totalretinol,
                                                                            sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as totalb_carotene_equivalent,
                                                                            sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as totalthiamin,
                                                                            sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as totalriboflavin,
                                                                            sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as totalniacin,
                                                                            sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as totaldietary_folate_eq,
                                                                            sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as totalfood_folate,
                                                                            sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as totalvit_B_12,
                                                                            sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as totalvit_c,
                                                                            sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as totalcholesterol,
                                                                            sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as totalOxalic_acid_OXALAC,
                                                                            sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as totalphytate

                                                                            FROM walkin_mealhistory
                                                                            INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                                            INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                                            
                                                                            WHERE client_no='$id'";
                                                                            $query= $conn->prepare($sql);
                                                                            $query-> execute();
                                                                            $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                                            if($query -> rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result2)
                                                                            {
                                                                        ?> 

                                                                        
                                                                        
                                                                        
                                                                            <div class="col-sm-6">
                                                                            <h4 id="success_emphasy"><b>3. Meal History VS RDI</b></h4>
                                                                                <small>
                                                                                    <table class="table table-striped mt-3">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td><h5 id="success_emphasy">NUTRIENTS</h5></td>
                                                                                                <td><h5 id="success_emphasy">Meal History</h5></td>
                                                                                                <td><h5 id="success_emphasy">RDI</h5></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                                <tr>
                                                                                                    <td>Energy <small id="success_emphasy">(Kcals)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalenergy);?></td>
                                                                                                    <td><?php echo htmlentities($result1->energy);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Protein <small id="success_emphasy">(g)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalprotein);?></td>
                                                                                                    <td><?php echo htmlentities($result1->protein);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Fat <small id="success_emphasy">(g)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalfat);?></td>
                                                                                                    <td><?php echo htmlentities($result1->fat);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Carbohydrate <small id="success_emphasy">(g)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalcarbohydrate);?></td>
                                                                                                    <td><?php echo htmlentities($result1->carbohydrate);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Water <small id="success_emphasy">(ml)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalwater);?></td>
                                                                                                    <td><?php echo htmlentities($result1->water);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Fiber <small id="success_emphasy">(g)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalfiber);?></td>
                                                                                                    <td><?php echo htmlentities($result1->fibre);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Calcium <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalca);?></td>
                                                                                                    <td><?php echo htmlentities($result1->calcium);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Iron <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalfe);?></td>
                                                                                                    <td><?php echo htmlentities($result1->iron);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Magnesium <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalmg);?></td>
                                                                                                    <td><?php echo htmlentities($result1->magnesium);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Phosphorous <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalp);?></td>
                                                                                                    <td><?php echo htmlentities($result1->phosphorous);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Potassium <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalk);?></td>
                                                                                                    <td><?php echo htmlentities($result1->potassium);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Sodium <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalna);?></td>
                                                                                                    <td><?php echo htmlentities($result1->sodium);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Zinc <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalzn);?></td>
                                                                                                    <td><?php echo htmlentities($result1->zinc);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Selenium <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalse);?></td>
                                                                                                    <td><?php echo htmlentities($result1->selenium);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Vit_A_RAE <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalVit_A_RAE);?></td>
                                                                                                    <td><?php echo htmlentities($result1->vitarae);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Vit_A_RE <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalVit_A_RE);?></td>
                                                                                                    <td><?php echo htmlentities($result1->vitare);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Retinol <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalretinol);?></td>
                                                                                                    <td><?php echo htmlentities($result1->retinol);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>B_Carotene <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalb_carotene_equivalent);?></td>
                                                                                                    <td><?php echo htmlentities($result1->bcarotene);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Thiamin <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalthiamin);?></td>
                                                                                                    <td><?php echo htmlentities($result1->thiamin);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Riboflavin <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalriboflavin);?></td>
                                                                                                    <td><?php echo htmlentities($result1->riboflavin);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Niacin <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalniacin);?></td>
                                                                                                    <td><?php echo htmlentities($result1->niacin);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Dietary Folate <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totaldietary_folate_eq);?></td>
                                                                                                    <td><?php echo htmlentities($result1->dietaryfolate);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Food Folate <small id="success_emphasy">(mcg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalfood_folate);?></td>
                                                                                                    <td><?php echo htmlentities($result1->foodfolate);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Vit_B12 <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalvit_B_12);?></td>
                                                                                                    <td><?php echo htmlentities($result1->vitb12);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Vit_C <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalvit_c);?></td>
                                                                                                    <td><?php echo htmlentities($result1->vitc);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Cholesterol <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalcholesterol);?></td>
                                                                                                    <td><?php echo htmlentities($result1->cholestrol);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Oxalic Acid <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalOxalic_acid_OXALAC);?></td>
                                                                                                    <td><?php echo htmlentities($result1->oxalicacid);?></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Phytate <small id="success_emphasy">(mg)</small></td>
                                                                                                    <td><?php echo htmlentities($result2->totalphytate);?></td>
                                                                                                    <td><?php echo htmlentities($result1->phytate);?></td>
                                                                                                </tr>
                                                                                        </tbody>   
                                                                                    </table>
                                                                                </small>
                                                                            </div>
	
                                                                         <?php }} 
                                                                            else{
                                                                                echo '<p id="table_alert">Client Data Not Found !!</p>';
                                                                                } 
                                                                        ?>

                                                                        <?php }} 
                                                                            else{
                                                                                echo '<p id="table_alert">Client Data Not Found !!</p>';
                                                                                } 
                                                                        ?>


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                    <?php }} 
                                            else{
                                                echo '<p id="table_alert">Client Assessment Data Not Found !!</p>';
                                                } 
                                    ?>



                                


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