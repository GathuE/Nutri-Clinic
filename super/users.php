<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || System Users";
		$page_title = "System Users";

		
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

							

							<!-- INHOUSE STAFF SECTION -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title"> Inhouse Staff
                                                <div class="card-title-right">
                                                   <a class="btn btn-primary btn-xs" href="new_staff">Add new</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                            <table class="table table-striped  table-responsive mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No:</th>
                                                        <th scope="col">Staff Name</th>
                                                        <th scope="col">Staff Role</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone Number</th>
                                                        <th scope="col">Account Status</th>
                                                        <th scope="col">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <!-- Users Selection -->

                                                    <?php 

                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 

                                                    $sql = "SELECT * FROM backend_users WHERE role='Administrator' OR role='Nutritionist' OR role='Receptionist'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                    
                                                    ?>

                                                   
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt);?></td>  
                                                            <td><?php echo htmlentities($result->username);?></td>
                                                            <td> <?php echo htmlentities($result->role);?></td>
                                                            <td><?php echo htmlentities($result->email);?></td>
                                                            <td><?php echo htmlentities($result->phonenumber);?></td>
                                                            <td><?php echo htmlentities($result->status);?></td>
                                                            <td id="action_selector">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="staff_details?view=<?php echo $result->ID;?>"><i class="la la-eye m-r-5"></i>View</a>
                                                                        <a class="dropdown-item" href="edit_details?edit=<?php echo $result->ID;?>"><i class="la la-pencil m-r-5"></i>Edit Details</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                   
                                                    <?php $cnt=$cnt+1; }} else{
                                                        echo '<tr>
                                                                <td colspan="5" style="color:#FF0000;text-align:center;">You have not enrolled any Inhouse Staff Yet !!</td>
                                                            </tr>';
                                                        } 
                                                    ?>

                                                    <!-- Users Selection -->
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
							
							    <!-- INHOUSE STAFF SECTION -->

                            <!-- NUTRITIONISTS SECTION 

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Nutritionists
                                                <div class="card-title-right">
                                                    <a class="btn btn-primary btn-xs" href="#">Add new</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No:</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td colspan="2">Larry the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="demo">
                                                <ul class="pagination pg-primary">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							 NUTRITIONISTS SECTION -->

                            <!-- HEALTHPRACTITIONERS SECTION 

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Health Practitioners
                                                <div class="card-title-right">
                                                    <a class="btn btn-primary btn-xs" href="#">Add new</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td colspan="2">Larry the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="demo">
                                                <ul class="pagination pg-primary">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							 HEALTHPRACTITIONERS SECTION 


                             USERS SECTION 

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Clients
                                                <div class="card-title-right">
                                                    <a class="btn btn-primary btn-xs" href="#">Add new</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">First</th>
                                                        <th scope="col">Last</th>
                                                        <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td colspan="2">Larry the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="demo">
                                                <ul class="pagination pg-primary">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							 USERS SECTION -->

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