<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Update Staff Details";
		$page_title = "Update Details";

		
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

                            <?php 

                                error_reporting(E_ALL & E_NOTICE);
                                include 'includes/db_conn.php'; 
                                $id=$_GET['edit'];
                                $sql = "SELECT * FROM backend_users WHERE ID='$id'";
                                $query= $conn->prepare($sql);
                                $query-> execute();
                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                $cnt=1;
                                if($query -> rowCount() > 0)
                                {
                                foreach($results as $result)
                                {
                                
                             ?>



							<!-- Place Other Contents Here -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form enctype="multipart/form-data" method="post" action="classes/edit_staff">
                                            <input type="hidden" name="staffid" id="staffid" value="<?php echo htmlentities($id)?> ">
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
                                                                    <input type="text" class="form-control input-full" name="staffrole" id="staffrole" value="<?php echo htmlentities($result->role);?>" readonly>
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
                                                                    <input type="text" class="form-control input-full" name="email" id="email" value="<?php echo htmlentities($result->email);?>" readonly>
                                                                    <span class="input_error" id="email_error"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Password : <small id="small_emphasy">(Used as Login Credential)</small></label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="password" id="password" value="home@dieteticsnutrition" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Security Question :</label>
                                                                <div class="col-md-12 p-0">
                                                                    <select class="form-control input-square" id="security_question" name="security_question" readonly>
                                                                        <option value="2">What is your Favourite Drink?</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Answer : <small id="small_emphasy">(Answer to Security Question)</small></label>
                                                                <div class="col-md-12 p-0">
                                                                    <input type="text" class="form-control input-full" name="security_answer" id="security_answer" value="yoghurt" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-action">
                                                        <button  class="btn btn-success" type="submit" name="editstaff" id="editstaff">Submit</button>
                                                        <button  class="btn btn-danger"  type="reset" >Cancel</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Place Other Contents Here -->


                            <?php }} else{
                                        echo 'No Data Found !!';
                                        } 
                            ?>


                            <script>
                                function validate(){
                                    var name = document.getElementById("staffname").value;
                                    var phone = document.getElementById("phonenumber").value;
                                   
                                    var char =/^[a-zA-Z\s]*$/;
                                    var tel = /^\d{10}$/;
                                   
                                    
                                    let text;

                                    //Name
                                    if(!char.test(name)){
                                        text = "Numbers Or Special Characters Not Allowed!";
                                        document.getElementById("name_error").style.display = "block";
                                        document.getElementById("name_error").innerHTML = text;
                                        document.getElementById("editstaff").disabled = true;
                                    }else{
                                        document.getElementById("name_error").style.display = "none";
                                        document.getElementById("editstaff").disabled = false;
                                    }
                                    
                                    //Phone
                                    if(!tel.test(phone)){
                                        text = "Phone Number Should Contain 10 Digits (0-9)!";
                                        document.getElementById("phone_error").style.display = "block";
                                        document.getElementById("phone_error").innerHTML = text;
                                        document.getElementById("editstaff").disabled = true;
                                    }else{
                                        document.getElementById("phone_error").style.display = "none";
                                        document.getElementById("editstaff").disabled = false;
                                    }

                                }

                                function change(){
                                    var picture = document.getElementById("profilepicture").value;
                                    var extension = /(\.jpg|\.jpeg|\.png)$/i;

                                    if(!extension.exec(picture)){
                                        text = "Picture Format Not Supported!";
                                        document.getElementById("picture_error").style.display = "block";
                                        document.getElementById("picture_error").innerHTML = text;
                                        document.getElementById("editstaff").disabled = true;
                                    }else{
                                        document.getElementById("picture_error").style.display = "none";
                                        document.getElementById("editstaff").disabled = false;
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