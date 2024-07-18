<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Walk In Clients";
		$page_title = "Walk In Clients";

		
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

                            <!-- USERS SECTION -->

                            <?php include('clients_pagination.php'); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Consultations
                                                <div class="card-title-right">
                                                    <a class="btn btn-warning btn-sm" href="clients">View All</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="search_row">
                                                <div class="col-md-7">
                                                    <form method="post">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control input-pill" name="phonenumber" id="phonenumber" oninput="searchvalidation();" placeholder="Enter Client's Phone..." required>
                                                            <span class="input_error" id="phone_error"></span>
                                                        </div>
                                                        <div class="card-action">
                                                            <input type="submit" id="searchclient" class="btn btn-primary btn-sm" value="Search" name="submit">
                                                        </div>
                                                    </form>
                                                        <script>
                                                            function searchvalidation(){
                                                                var phonenumber = document.getElementById("phonenumber").value;

                                                                var teltest = /^\d{10}$/;

                                                                let text;

                                                                //Phone
                                                                if(!teltest.test(phonenumber)){
                                                                    text = "Phone Number Should Contain 10 Digits (0-9)!";
                                                                    document.getElementById("phone_error").style.display = "block";
                                                                    document.getElementById("phone_error").innerHTML = text;
                                                                    document.getElementById("searchclient").disabled = true;
                                                                }else{
                                                                    document.getElementById("phone_error").style.display = "none";
                                                                    document.getElementById("searchclient").disabled = false;
                                                                }


                                                            }

                                                        </script>
                                                </div>
                                            </div>
                                            
                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php 
                                                        error_reporting(E_ALL & E_NOTICE);
                                                        include 'includes/database.php';
                                                        if(!isset($_POST['submit'])){
                                                            $query = "SELECT * FROM walkin_clients WHERE service='Consultation' ORDER BY date DESC $limit";
                                                                $data = mysqli_query($con, $query) or die('error');
                                                                $cnt=1;
                                                                if(mysqli_num_rows($data) > 0){
                                                                    while($row = mysqli_fetch_assoc($data)){
                                                                        
                                                                        $clientid = $row['ID'];
                                                                        $name = $row['clientname'];
                                                                        $phone = $row['phonenumber'];
                                                                        $service = $row['service'];
                                                                        $date = $row['date'];
                                                    ?>
                                                    
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt);?></td> 
                                                            <td><?php echo htmlentities($name);?></td>
                                                            <td><?php echo htmlentities($phone);?></td>
                                                            <td><?php echo htmlentities($date);?></td>
                                                            <td id="action_selector">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="start_assessment?view=<?php echo $clientid;?>"><i class="la la-plus m-r-5">NCP</i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    <?php $cnt=$cnt+1;
                                                                    }
                                                                }
                                                                else{
                                                    ?>
                                                        <tr>
                                                                            
                                                            <td colspan="6" style="color:#FF0000;text-align:center;">You have no Clients Yet !!</td>
                                                                            
                                                        </tr>

                                                    <?php
                                                                    }
                                                                
                                                            }
                                                            
                                                        else{
                                                            $phonenumber = $_POST['phonenumber'];

                                                                if($phonenumber != ""){
                                                                $query = "SELECT * FROM walkin_clients WHERE phonenumber ='$phonenumber' AND service='Consultation'";
                                                                    $data = mysqli_query($con, $query) or die('error');
                                                                    $cnt=1;
                                                                    if(mysqli_num_rows($data) > 0){
                                                                        while($row = mysqli_fetch_assoc($data)){
                                                                            
                                                                            $clientid = $row['ID'];
                                                                            $name = $row['clientname'];
                                                                            $phone = $row['phonenumber'];
                                                                            $service = $row['service'];
                                                                            $date = $row['date'];
                                                    ?>
                                                        
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt);?></td> 
                                                            <td><?php echo htmlentities($name);?></td>
                                                            <td><?php echo htmlentities($phone);?></td>
                                                            <td><?php echo htmlentities($date);?></td>
                                                            <td id="action_selector">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="start_assessment?view=<?php echo $clientid;?>"><i class="la la-plus m-r-5"></i>NCP</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    <?php $cnt=$cnt+1;
                                                                    }
                                                                }
                                                                else{
                                                    ?>
                                                        <tr>
                                                                            
                                                            <td colspan="6" style="color:#FF0000;text-align:center;"> Client not Found !!</td>
                                                                            
                                                        </tr>

                                                    <?php
                                                                    }
                                                            }

                                                    }
                                                    ?>


                                                </tbody>
                                            </table>
                                                    <!-- PAGINATION -->
                                                        <p>
                                                            <div style="padding:10px;text-align:center;" id="pagination_controls"><?php echo $paginationCtrls; ?></div>
                                                        </p>
                                                    <!-- PAGINATION -->
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<!-- USERS SECTION -->

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