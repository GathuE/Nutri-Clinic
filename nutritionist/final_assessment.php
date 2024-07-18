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
                                                <div class="card-title">Stage Three : Client Diet Analysis <br>
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
                                                    <div class="col-md-12">
                                                       <!-- Display Message (Meal History) --->
                                                       <div class="row mt-0">
                                                                <div class="col-md-8">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="card">
                                                                                <div class="alert alert-success" id="success" style="display:none;">
                                                                                </div>
                                                                                <div class="alert alert-danger" id="error" style="display:none;">
                                                                                </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                       <!-- Display Message (Meal History) --->

                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <ul class="nav nav-tabs" id="meal_forms">
                                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#breakfast">Breakfast</a></li>&nbsp;
                                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#midmorning">Mid-Morning</a></li>&nbsp;
                                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#lunch">Lunch</a></li>&nbsp;
                                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#midafternoon">Mid-Afternoon</a></li>&nbsp;
                                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#supper">Supper</a></li>&nbsp;
                                                                                <li><a class="btn btn-xs" data-toggle="tab" href="#latesupper">Late Supper</a></li>
                                                                                <li><a class="btn btn-success btn-xs" href="walkin_mealhistory?view=<?php echo htmlentities($result->ID);?>">Meal History</a></li>
                                                                                <li><a class="btn btn-warning btn-xs" href="walkin_mealhistory_nutrientanalysis?view=<?php echo htmlentities($result->ID);?>">Nutrient Analysis</a></li>
                                                                    </div>
                                                                </div>
                            <?php }} 
									else{
										echo '<p>No Data Found !!</p>';
										} 
							?>
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


                                                                <div class="tab-content">
                                                                    <div id="breakfast" class="tab-pane fade">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span id="success_emphasy">Breakfast Meals</span>
                                                                                    <form method="post" action="" id="breakfast-form">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="client_name" id="c_name" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                                                            <input type="hidden" name="client_phone" id="c_phone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                                                            <input type="hidden" name="client_code" id="c_code" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                                                            <input type="hidden" name="meal" id="breakfast_meal" value="Breakfast">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Food Taken</label>
                                                                                                        <select name="foods_id" id="foods_id_breakfast" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
                                                                                                        <option value="">Select Food</option>
                                                                                                            <?php
                                                                                                                include 'includes/database.php';
                                                                                                                $query = "SELECT * FROM foods ORDER BY name";
                                                                                                                $result = $con->query($query);

                                                                                                                if ($result->num_rows > 0 ) {
                                                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?> 
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Serving Item</label>
                                                                                                        <select name="servings_id" id="servings_id_breakfast" class="form-control" required>
                                                                                                            
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for="amount">No of Serving Item(s):</label>
                                                                                                        <input type="number" min="0"  class="form-control" name="breakfast_amount" id="breakfast_amount"  placeholder="Enter Amount" required >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_breakfast" class="btn btn-success btn-xs" >Save Meal</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                <?php }} 
									else{
										echo '<p>No Data Found !!</p>';
										} 
								?>
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

                                                                    <div id="midmorning" class="tab-pane fade">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span id="success_emphasy">Mid Morning Meals</span>
                                                                                    <form method="post" action="" id="midmorning-form">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="client_name" id="p_name" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                                                            <input type="hidden" name="client_phone" id="p_phone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                                                            <input type="hidden" name="client_code" id="p_code" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                                                            <input type="hidden" name="meal" id="midmorning_meal" value="mid-morning">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Food Taken</label>
                                                                                                        <select name="foods_id" id="foods_id_midmorning" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
                                                                                                        <option value="">Select Food</option>
                                                                                                            <?php
                                                                                                                include 'includes/database.php';
                                                                                                                $query = "SELECT * FROM foods ORDER BY name";
                                                                                                                $result = $con->query($query);

                                                                                                                if ($result->num_rows > 0 ) {
                                                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?> 
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Serving Item</label>
                                                                                                        <select name="servings_id" id="servings_id_midmorning" class="form-control" required>
                                                                                                            
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for="amount">No of Serving Item(s):</label>
                                                                                                        <input type="number" min="0"  class="form-control" name="midmorning_amount" id="midmorning_amount"  placeholder="Enter Amount" required >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_midmorning" class="btn btn-success btn-xs" >Save Meal</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                <?php }} 
									else{
										echo '<p>No Data Found !!</p>';
										} 
								?>
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

                                                                    <div id="lunch" class="tab-pane fade">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span id="success_emphasy">Lunch Meals</span>
                                                                                    <form method="post" action="" id="lunch-form">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="client_name" id="name" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                                                            <input type="hidden" name="client_phone" id="phone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                                                            <input type="hidden" name="client_code" id="code" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                                                            <input type="hidden" name="meal" id="lunch_meal" value="Lunch">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Food Taken</label>
                                                                                                        <select name="foods_id" id="foods_id_lunch" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
                                                                                                        <option value="">Select Food</option>
                                                                                                            <?php
                                                                                                                include 'includes/database.php';
                                                                                                                $query = "SELECT * FROM foods ORDER BY name";
                                                                                                                $result = $con->query($query);

                                                                                                                if ($result->num_rows > 0 ) {
                                                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?> 
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Serving Item</label>
                                                                                                        <select name="servings_id" id="servings_id_lunch" class="form-control"  required>
                                                                                                            
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for="amount">No of Serving Item(s):</label>
                                                                                                        <input type="number" min="0"  class="form-control" name="lunch_amount" id="lunch_amount"  placeholder="Enter Amount" required >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_lunch" class="btn btn-success btn-xs" >Save Meal</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                <?php }} 
									else{
										echo '<p>No Data Found !!</p>';
										} 
								?>
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

                                                                    <div id="midafternoon" class="tab-pane fade">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span id="success_emphasy">Mid Afternoon Meals</span>
                                                                                    <form method="post" action="" id="midafternoon-form">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="client_name" id="cname" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                                                            <input type="hidden" name="client_phone" id="cphone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                                                            <input type="hidden" name="client_code" id="ccode" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                                                            <input type="hidden" name="meal" id="midafternoon_meal" value="midafternoon">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Food Taken</label>
                                                                                                        <select name="foods_id" id="foods_id_midafternoon" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
                                                                                                            <option value="">Select Food</option>
                                                                                                            <?php
                                                                                                                 include 'includes/database.php';
                                                                                                                 $query = "SELECT * FROM foods ORDER BY name";
                                                                                                                 $result = $con->query($query);

                                                                                                                if ($result->num_rows > 0 ) {
                                                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?> 
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Serving Item</label>
                                                                                                        <select name="servings_id" id="servings_id_midafternoon" class="form-control" required>
                                                                                                            
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for="amount">No of Serving Item(s):</label>
                                                                                                        <input type="number" min="0"  class="form-control" name="midafternoon_amount" id="midafternoon_amount"  placeholder="Enter Amount" required >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_midafternoon" class="btn btn-success btn-xs" >Save Meal</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                <?php }} 
									else{
										echo '<p>No Data Found !!</p>';
										} 
								?>
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
                                                                    <div id="supper" class="tab-pane fade">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span id="success_emphasy">Supper Meals</span>
                                                                                    <form method="post" action="" id="supper-form">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="client_name" id="pname" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                                                            <input type="hidden" name="client_phone" id="pphone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                                                            <input type="hidden" name="client_code" id="pcode" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                                                            <input type="hidden" name="meal" id="supper_meal" value="supper">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Food Taken</label>
                                                                                                        <select name="foods_id" id="foods_id_supper" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
                                                                                                            <option value="">Select Food</option>
                                                                                                            <?php
                                                                                                                 include 'includes/database.php';
                                                                                                                 $query = "SELECT * FROM foods ORDER BY name";
                                                                                                                 $result = $con->query($query);

                                                                                                                if ($result->num_rows > 0 ) {
                                                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?> 
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-sm-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Serving Item</label>
                                                                                                        <select name="servings_id" id="servings_id_supper" class="form-control" required>
                                                                                                            
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for="amount">No of Serving Item(s):</label>
                                                                                                        <input type="number" min="0"  class="form-control" name="supper_amount" id="supper_amount"  placeholder="Enter Amount" required >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_supper" class="btn btn-success btn-xs" >Save Meal</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                <?php }} 
									else{
										echo '<p>No Data Found !!</p>';
										} 
								?>
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
                                                                    <div id="latesupper" class="tab-pane fade">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span id="success_emphasy">Late Supper Meals</span>
                                                                                    <form method="post" action="" id="latesupper-form">
                                                                                        <div class="row">
                                                                                            <input type="hidden" name="client_name" id="clientname" value="<?php echo htmlentities($result->clientname);?>" readonly>
                                                                                            <input type="hidden" name="client_phone" id="clientphone" value="<?php echo htmlentities($result->phonenumber);?>" readonly>
                                                                                            <input type="hidden" name="client_code" id="clientcode" value="<?php echo htmlentities($result->ID);?>" readonly>
                                                                                            <input type="hidden" name="meal" id="latesupper_meal" value="latesupper">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Food Taken</label>
                                                                                                        <select name="foods_id" id="foods_id_latesupper" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
                                                                                                            <option value="">Select Food</option>
                                                                                                            <?php
                                                                                                                 include 'includes/database.php';
                                                                                                                 $query = "SELECT * FROM foods ORDER BY name";
                                                                                                                 $result = $con->query($query);

                                                                                                                if ($result->num_rows > 0 ) {
                                                                                                                    while ($row = $result->fetch_assoc()) {
                                                                                                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            ?> 
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label>Serving Item</label>
                                                                                                        <select name="servings_id" id="servings_id_latesupper" class="form-control" required>
                                                                                                            
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for="amount">No of Serving Item(s):</label>
                                                                                                        <input type="number" min="0"  class="form-control" name="latesupper_amount" id="latesupper_amount"  placeholder="Enter Amount" required >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-action">
                                                                                                <button type="submit" id="save_latesupper" class="btn btn-success btn-xs" >Save Meal</button>
                                                                                                <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                                                        </div>
                                                                                    </form>
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
                                                    </div>
                                                </div>
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
                                                
                                                <div id="next_button">
                                                    <a class="btn btn-warning btn-xs" href="proceed_assessment?view=<?php echo htmlentities($result->ID);?>">Back</a>
                                                    <a class="btn btn-success btn-xs" href="client_dri?view=<?php echo htmlentities($result->ID);?>">Proceed</a>
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

                                    <script type="text/javascript">
                                        function FetchServingItem(id){
                                            $('#servings_id_breakfast').html('');
                                            $('#servings_id_midmorning').html('');
                                            $('#servings_id_lunch').html('');
                                            $('#servings_id_midafternoon').html('');
                                            $('#servings_id_supper').html('');
                                            $('#servings_id_latesupper').html('');
                                            $.ajax({
                                                type:'post',
                                                url: 'ajaxdata.php',
                                                data : { food_id : id},
                                                success : function(data){
                                                    $('#servings_id_breakfast').html(data);
                                                    $('#servings_id_midmorning').html(data);
                                                    $('#servings_id_lunch').html(data);
                                                    $('#servings_id_midafternoon').html(data);
                                                    $('#servings_id_supper').html(data);
                                                    $('#servings_id_latesupper').html(data);
                                                }

                                            })
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