<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || New Client";
		$page_title = "New Client";


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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                                <form method="post" action="classes/register_newclient">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for=""> Client Names :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" oninput="userinputvalidation();" name="clientname" id="clientname" placeholder="Client's Full Name.." required>
                                                                    <span class="input_error" id="name_error"></span>

                                                                    <input type="hidden" class="form-control input-full" name="status" value="New Visit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for=""> Phone Number :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" oninput="userinputvalidation();" name="clientphonenumber" id="clientphonenumber" placeholder="Client's Phone Number" required>
                                                                    <span class="input_error" id="phone_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Service Offered :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <select class="form-control input-square" id="service" name="service" onchange="definecost();" required>
                                                                        <option value="">Select Service..</option>
                                                                        <option value="Consultation">Consultation &nbsp;<span>(New-Visit)</span></option>
                                                                        <option value="Weight Management DietPlan">Weight Management DietPlan</option>
                                                                        <option value="Diabetes Management DietPlan">Diabetes Management DietPlan</option>
                                                                        <option value="Diabetes and Weight Management DietPlan">Diabetes and Weight Management DietPlan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for=""> Service Cost :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="servicecost" id="servicecost" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <h6>Payment Mode:</h6>
                                                                <label class="form-radio-label">
                                                                    <input class="form-radio-input" type="radio" onchange="ResumeChange(this);" name="optionsRadios" value="Cash" checked>
                                                                    <span class="form-radio-sign">Cash</span>
                                                                </label>
                                                                <label class="form-radio-label">
                                                                    <input class="form-radio-input" type="radio" onchange="handleChange(this);" name="optionsRadios" value="M-Pesa">
                                                                    <span class="form-radio-sign">Mpesa</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6" id="mpesa_code" style="display:none;">
                                                            <div class="form-group">
                                                                <label for=""> Transaction Code :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" oninput="userinputvalidation();" name="mpesacode" id="mpesacode" placeholder="Enter Transaction Code" value="NULL" required>
                                                                    <span class="input_error" id="code_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-action">
                                                        <button  class="btn btn-success" type="submit" name="registerclient" id="registerclient">Submit</button>
                                                        <button  class="btn btn-danger"  type="reset" >Cancel</button>
                                                    </div>
                                                </form> 

                                                <script>

                                                    function userinputvalidation(){
                                                        var clientname = document.getElementById("clientname").value;
                                                        var clientphone = document.getElementById("clientphonenumber").value;
                                                        var mpesacode = document.getElementById("mpesacode").value;
                                                        
                                                        var chartest =/^[a-zA-Z\s]*$/;
                                                        var teltest = /^\d{10}$/;

                                                        var codecount = /^[0-9a-zA-Z]{10}$/;

                                                        let text;

                                                        //Name
                                                        if(!chartest.test(clientname)){
                                                            text = "Numbers Or Special Characters Not Allowed!";
                                                            document.getElementById("name_error").style.display = "block";
                                                            document.getElementById("name_error").innerHTML = text;
                                                            document.getElementById("registerclient").disabled = true;
                                                        }else{
                                                            document.getElementById("name_error").style.display = "none";
                                                            document.getElementById("registerclient").disabled = false;
                                                        }

                                                        //Phone
                                                        if(!teltest.test(clientphone)){
                                                            text = "Phone Number Should Contain 10 Digits (0-9)!";
                                                            document.getElementById("phone_error").style.display = "block";
                                                            document.getElementById("phone_error").innerHTML = text;
                                                            document.getElementById("registerclient").disabled = true;
                                                        }else{
                                                            document.getElementById("phone_error").style.display = "none";
                                                            document.getElementById("registerclient").disabled = false;
                                                        }

                                                        //Transcation Code
                                                        if(!codecount.test(mpesacode)){
                                                            text = "Please Enter a Valid Mpesa Transaction Code";
                                                            document.getElementById("code_error").style.display = "block";
                                                            document.getElementById("code_error").innerHTML = text;
                                                        }
                                                        else{
                                                            document.getElementById("code_error").style.display = "none";
                                                            document.getElementById("registerclient").disabled = false;
                                                        }


                                                    }

                                                    function definecost(){
                                                        var service = document.getElementById("service").value;

                                                        if(service == ''){
                                                            document.getElementById("servicecost").value = "";
                                                        }
                                                        if(service == 'Consultation'){
                                                            document.getElementById("servicecost").value = "300";
                                                        }
                                                        if(service == 'Weight Management DietPlan'){
                                                            document.getElementById("servicecost").value = "1200";
                                                        }
                                                        if(service == 'Diabetes Management DietPlan'){
                                                            document.getElementById("servicecost").value = "1400";
                                                        }
                                                        if(service == 'Diabetes and Weight Management DietPlan'){
                                                            document.getElementById("servicecost").value = "1600";
                                                        }
                                                    }


                                                    function handleChange(){
                                                            document.getElementById("mpesacode").value = "";
                                                            document.getElementById("mpesa_code").style.display = "block";
                                                    }
                                                    function ResumeChange(){
                                                            document.getElementById("mpesacode").value = "NULL";
                                                            document.getElementById("mpesa_code").style.display = "none";
                                                    }

                                                </script>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
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