<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Client Meal History";
		$page_title = "Meal History";

		
		$id = $_SESSION['ID'];
		$username = $_SESSION['username'];
		$role = $_SESSION['role'];
		$profile_pic = $_SESSION['profile_pic'];
		$phonenumber = $_SESSION['phonenumber'];
		$email = $_SESSION['email'];
		
?>

<?php 

error_reporting(E_ALL & E_NOTICE);
include 'includes/db_conn.php'; 
$ccode=$_GET['view'];
if(isset($_GET['del']))
{
    $id = $_GET['del'];
    $ccode=$_GET['view'];
    $sql = "DELETE FROM walkin_mealhistory WHERE id=:id";
    $query = $conn->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();
    header("Location: walkin_mealhistory?view=$ccode&s=Meal Deleted !!");
}


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
                                                                   
                                <div class="card">
                                    <div class="card-header">
                                            <div class="card-title">Stage Three : Client Diet Analysis <br>
                                                <a href="final_assessment?view=<?php echo htmlentities($result->ID);?>" class="btn btn-warning btn-xs">Back</a>
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

                                            <!-- Breakfast Mealhistory -->
                                               
                                                    <table class="table table-striped mt-3">
                                                        <span id="success_emphasy">Breakfast Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food Name</th>
                                                                <th scope="col">Amount Of Serving</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.client_no, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                    WHERE client_no='$id' AND meal='Breakfast'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                ?>          
                                                            <tr>
                                                                <td><?php echo htmlentities($result->name);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td id="action_selector">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="edit_meal?edit=<?php echo htmlentities($result->id);?>"><i class="la la-pencil m-r-5">Edit</i></a>
                                                                            <a class="dropdown-item" href="walkin_mealhistory?del=<?php echo htmlentities($result->id);?>&view=<?php echo htmlentities($result->client_no);?>" onclick="return confirm('Delete Meal?');"><i class="la la-trash m-r-5">Delete</i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Breakfast Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                

                                            <!-- Breakfast Mealhistory -->

                                            <!-- Mid Morning Mealhistory -->
                                            
                                                    <table class="table table-striped mt-3">
                                                        <span id="success_emphasy">Mid Morning Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food Name</th>
                                                                <th scope="col">Amount Of Serving</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.client_no, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                    WHERE client_no='$id' AND meal='mid-morning'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($result->name);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td id="action_selector">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="edit_meal?edit=<?php echo htmlentities($result->id);?>"><i class="la la-pencil m-r-5">Edit</i></a>
                                                                            <a class="dropdown-item" href="walkin_mealhistory?del=<?php echo htmlentities($result->id);?>&view=<?php echo htmlentities($result->client_no);?>" onclick="return confirm('Delete Meal?');"><i class="la la-trash m-r-5">Delete</i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Mid-Morning Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                
                                            
                                             <!-- Mid Morning Mealhistory -->


                                            <!-- Lunch Mealhistory -->
                                                    <table class="table table-striped mt-3">
                                                        <span id="success_emphasy">Lunch Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food Name</th>
                                                                <th scope="col">Amount Of Serving</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.client_no, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                    WHERE client_no='$id' AND meal='Lunch'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($result->name);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td id="action_selector">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="edit_meal?edit=<?php echo htmlentities($result->id);?>"><i class="la la-pencil m-r-5">Edit</i></a>
                                                                            <a class="dropdown-item" href="walkin_mealhistory?del=<?php echo htmlentities($result->id);?>&view=<?php echo htmlentities($result->client_no);?>" onclick="return confirm('Delete Meal?');"><i class="la la-trash m-r-5">Delete</i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Lunch Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                
                                             <!-- Lunch Mealhistory -->


                                            <!-- Mid Afternoon Mealhistory -->
                                            
                                                    <table class="table table-striped mt-3">
                                                        <span id="success_emphasy">Mid-Afternoon Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food Name</th>
                                                                <th scope="col">Amount Of Serving</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.client_no, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                    WHERE client_no='$id' AND meal='midafternoon'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($result->name);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td id="action_selector">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="edit_meal?edit=<?php echo htmlentities($result->id);?>"><i class="la la-pencil m-r-5">Edit</i></a>
                                                                            <a class="dropdown-item" href="walkin_mealhistory?del=<?php echo htmlentities($result->id);?>&view=<?php echo htmlentities($result->client_no);?>" onclick="return confirm('Delete Meal?');"><i class="la la-trash m-r-5">Delete</i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Mid Afternoon Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                

                                             <!-- Mid Afternoon Mealhistory -->



                                            <!-- Supper Mealhistory -->

                                            
                                                    <table class="table table-striped mt-3">
                                                        <span id="success_emphasy">Supper Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food Name</th>
                                                                <th scope="col">Amount Of Serving</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.client_no, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                    WHERE client_no='$id' AND meal='supper'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($result->name);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td id="action_selector">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="edit_meal?edit=<?php echo htmlentities($result->id);?>"><i class="la la-pencil m-r-5">Edit</i></a>
                                                                            <a class="dropdown-item" href="walkin_mealhistory?del=<?php echo htmlentities($result->id);?>&view=<?php echo htmlentities($result->client_no);?>" onclick="return confirm('Delete Meal?');"><i class="la la-trash m-r-5">Delete</i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Supper Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                            <!-- Supper Mealhistory -->


                                            <!-- Late Supper Mealhistory -->
                                           
                                                    <table class="table table-striped mt-3">
                                                        <span id="success_emphasy">Late Supper Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food Name</th>
                                                                <th scope="col">Amount Of Serving</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.client_no, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                                    WHERE client_no='$id' AND meal='latesupper'";
                                                    $query= $conn->prepare($sql);
                                                    $query-> execute();
                                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                    if($query -> rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {
                                                ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($result->name);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td id="action_selector">
                                                                    <div class="dropdown dropdown-action">
                                                                        <a href="#" class="action-icon" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="edit_meal?edit=<?php echo htmlentities($result->id);?>"><i class="la la-pencil m-r-5">Edit</i></a>
                                                                            <a class="dropdown-item" href="walkin_mealhistory?del=<?php echo htmlentities($result->id);?>&view=<?php echo htmlentities($result->client_no);?>" onclick="return confirm('Delete Meal?');"><i class="la la-trash m-r-5">Delete</i></a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Late Supper Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                            <!-- Late Supper Mealhistory -->
                                            
                                        </div>
                                </div>
                            <?php }} 
                                    else{
                                        echo '<p id="table_alert">Client Data Not Found !!</p>';
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