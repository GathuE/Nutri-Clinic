<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['logged_in'])) {
  header("Location:../index");
  exit();
}
else 
	{
		$title = "Firm Name || Edit Meal";
		$page_title = "Edit Meal";

		
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
                                    $id=$_GET['edit'];
                                    $sql = "SELECT walkin_mealhistory.id,walkin_mealhistory.client_no,walkin_mealhistory.meal, foods.name, walkin_mealhistory.amount, servings.name as serving  FROM walkin_mealhistory 
                                    INNER JOIN foods ON foods.id=walkin_mealhistory.foods_id
                                    INNER JOIN servings ON servings.id=walkin_mealhistory.servings_id
                                    WHERE walkin_mealhistory.id='$id'";
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
                                            <div class="card-title"><span>Meal Details</span> <br>
                                                <div class="card-title-right">
                                                    <a href="walkin_mealhistory?view=<?php echo htmlentities($result->client_no);?>" class="btn btn-warning btn-xs">Meal History</a>
                                                </div>
                                                <div class="card-title-left">
                                                    <span>
                                                        <p id="client_details"> 
                                                            Food Name : <?php echo htmlentities($result->name);?><br>
                                                            Amount Of Serving(s) : <?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?><br>
                                                        </p> 
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-body">
                                                <form method="post" action="classes/edit_meal">
                                                <input type="hidden" name="client_id" value="<?php echo htmlentities($result->client_no);?>">
                                                <input type="hidden" name="meal_id" value="<?php echo htmlentities($result->id);?>">
                                                <input type="hidden" name="meal" value="<?php echo htmlentities($result->meal);?>">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Select Food Taken</label>
                                                                    <select name="foods_id" id="foods_id" class="form-control selectpicker" data-live-search="true" onchange="FetchServingItem(this.value)" required>
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
                                                                    <select name="servings_id" id="servings_id" class="form-control" required>
                                                                        
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label for="amount">No of Serving Item(s):</label>
                                                                    <input type="number" min="0"  class="form-control" name="amount" id="amount"  placeholder="Enter Amount" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-action">
                                                            <input type="submit" name="editmeal" class="btn btn-success btn-xs" value="Save Meal">
                                                            <input type="reset" class="btn btn-warning btn-xs" value="Clear Data" >
                                                    </div>
                                                </form>
                                        </div>
                                    </div>

                                <?php }} 
                                        else{
                                            echo '<p>Client has No Breakfast Meals !!</p>';
                                            } 
                                ?>
							
							
						</div>
				</div>


                <script type="text/javascript">
                    function FetchServingItem(id){
                        $('#servings_id').html('');
                        $.ajax({
                            type:'post',
                            url: 'ajaxdata.php',
                            data : { food_id : id},
                            success : function(data){
                                $('#servings_id').html(data);
                            }

                        })
                    }

                </script>

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