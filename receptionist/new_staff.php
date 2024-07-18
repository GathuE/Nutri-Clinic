<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || New Staff";
		$page_title = "New Staff";

		
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form enctype="multipart/form-data" method="post" action="../classes/enroll_staff">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Full Name :</label>
                                                                <div class="col-md-9 p-0">
                                                                    <input type="text" class="form-control input-full" name="staffname" id="staffname" oninput="validate();" required>
                                                                    <span class="input_error" id="name_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Role:</label>
                                                                <div class="col-md-12 p-0">
                                                                    <select class="form-control input-square" id="staffrole" name="staffrole" required>
                                                                        <option value="">Choose User Role..</option>
                                                                        <option value="Administrator">Administrator</option>
                                                                        <option value="Receptionist">Receptionist</option>
                                                                        <option value="Nutritionist">Nutritionist</option>
                                                                    </select>
                                                                </div>
                                                                <span class="input_error" id="role_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Profile Picture:</label>
                                                                    <input type="file" class="form-control-file" id="profilepicture" name="profilepicture" onchange="change();" required>
                                                                    <span class="input_error" id="picture_error"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Phone Number :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="phonenumber" id="phonenumber" oninput="validate();" required>
                                                                    <span class="input_error" id="phone_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Email Address : <small id="small_emphasy">(Used as Login Credential)</small></label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="email" id="email" oninput="validate();" required>
                                                                    <span class="input_error" id="email_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Password : <small id="small_emphasy">(Used as Login Credential)</small></label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="password" id="password" value="@homedietetics2021" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Security Question :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <select class="form-control input-square" id="security_question" name="security_question">
                                                                        <option value="3">What is your Favourite Fruit?</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Answer : <small id="small_emphasy">(Answer to Security Question)</small></label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="security_answer" id="security_answer" value="apple" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-action">
                                                        <button  class="btn btn-success" type="submit" name="enrollstaff" id="enrollstaff">Submit</button>
                                                        <button  class="btn btn-danger"  type="reset" >Cancel</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Place Other Contents Here -->


                            <script>
                                function validate(){
                                    var name = document.getElementById("staffname").value;
                                    var phone = document.getElementById("phonenumber").value;
                                    var email = document.getElementById("email").value;

                                    var char =/^[a-zA-Z\s]*$/;
                                    var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                    var tel = /^\d{10}$/;
                                   
                                    
                                    let text;

                                    //Name
                                    if(!char.test(name)){
                                        text = "Numbers Or Special Characters Not Allowed!";
                                        document.getElementById("name_error").style.display = "block";
                                        document.getElementById("name_error").innerHTML = text;
                                        document.getElementById("enrollstaff").disabled = true;
                                    }else{
                                        document.getElementById("name_error").style.display = "none";
                                        document.getElementById("enrollstaff").disabled = false;
                                    }
                                    //Email
                                    if(!mail.test(email)){
                                        text = "Email Address not Valid!";
                                        document.getElementById("email_error").style.display = "block";
                                        document.getElementById("email_error").innerHTML = text;
                                        document.getElementById("enrollstaff").disabled = true;
                                    }else{
                                        document.getElementById("email_error").style.display = "none";
                                        document.getElementById("enrollstaff").disabled = false;
                                    }
                                    //Name
                                    if(!tel.test(phone)){
                                        text = "Phone Number Should Contain 10 Digits (0-9)!";
                                        document.getElementById("phone_error").style.display = "block";
                                        document.getElementById("phone_error").innerHTML = text;
                                        document.getElementById("enrollstaff").disabled = true;
                                    }else{
                                        document.getElementById("phone_error").style.display = "none";
                                        document.getElementById("enrollstaff").disabled = false;
                                    }

                                }

                                function change(){
                                    var picture = document.getElementById("profilepicture").value;
                                    var extension = /(\.jpg|\.jpeg|\.png)$/i;

                                    if(!extension.exec(picture)){
                                        text = "Picture Format Not Supported!";
                                        document.getElementById("picture_error").style.display = "block";
                                        document.getElementById("picture_error").innerHTML = text;
                                        document.getElementById("enrollstaff").disabled = true;
                                    }else{
                                        document.getElementById("picture_error").style.display = "none";
                                        document.getElementById("enrollstaff").disabled = false;
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