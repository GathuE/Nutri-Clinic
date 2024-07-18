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
                                               
                                                    <table class="table table-striped table-responsive mt-3">
                                                        <span id="success_emphasy">Breakfast Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food</th>
                                                                <th scope="col">Serving(s)</th>
                                                                <th scope="col">Energy <small id="success_emphasy">(Kcals)</small></th>
                                                                <th scope="col">Water <small id="success_emphasy">(mls)</small></th>
                                                                <th scope="col">Protein <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fat <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Carbohydrate <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fiber <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Calcium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Iron <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Magnesium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phosphorous <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Potassium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Sodium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Zinc <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Selenium <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RAE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Retinol <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">B-Carotene <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Thiamin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Riboflavin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Niacin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Dietary Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Food Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-B12 <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-C <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Cholesterol <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Oxalic_Acid <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phytate <small id="success_emphasy">(mg)</small></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    round(servings.energy*walkin_mealhistory.amount, 2) as energy,
                                                    round(servings.water*walkin_mealhistory.amount, 2) as water,
                                                    round(servings.protein*walkin_mealhistory.amount, 2) as protein,
                                                    round(servings.fat*walkin_mealhistory.amount, 2) as fat,
                                                    round(servings.cho*walkin_mealhistory.amount, 2) as carbohydrate,
                                                    round(servings.fiber*walkin_mealhistory.amount, 2) as fiber,
                                                    round(servings.ca*walkin_mealhistory.amount, 2) as ca,
                                                    round(servings.fe*walkin_mealhistory.amount, 2) as fe,
                                                    round(servings.mg*walkin_mealhistory.amount, 2) as mg,
                                                    round(servings.p*walkin_mealhistory.amount, 2) as p,
                                                    round(servings.k*walkin_mealhistory.amount, 2) as k,
                                                    round(servings.na*walkin_mealhistory.amount, 2) as na,
                                                    round(servings.zn*walkin_mealhistory.amount, 2) as zn,
                                                    round(servings.se*walkin_mealhistory.amount, 2) as se,
                                                    round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2) as Vit_A_RAE,
                                                    round(servings.Vit_A_RE*walkin_mealhistory.amount, 2) as Vit_A_RE,
                                                    round(servings.retinol*walkin_mealhistory.amount, 2) as retinol,
                                                    round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2) as b_carotene_equivalent,
                                                    round(servings.thiamin*walkin_mealhistory.amount, 2) as thiamin,
                                                    round(servings.riboflavin*walkin_mealhistory.amount, 2) as riboflavin,
                                                    round(servings.niacin*walkin_mealhistory.amount, 2) as niacin,
                                                    round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2) as dietary_folate_eq,
                                                    round(servings.food_folate*walkin_mealhistory.amount, 2) as food_folate,
                                                    round(servings.vit_B_12*walkin_mealhistory.amount, 2) as vit_B_12,
                                                    round(servings.vit_c*walkin_mealhistory.amount, 2) as vit_c,
                                                    round(servings.cholesterol*walkin_mealhistory.amount, 2) as cholesterol,
                                                    round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2) as Oxalic_acid_OXALAC,
                                                    round(servings.phytate*walkin_mealhistory.amount, 2) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td><?php echo htmlentities($result->food);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>

                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    sum(round(servings.energy*walkin_mealhistory.amount, 2)) as energy,
                                                    sum(round(servings.water*walkin_mealhistory.amount, 2)) as water,
                                                    sum(round(servings.protein*walkin_mealhistory.amount, 2)) as protein,
                                                    sum(round(servings.fat*walkin_mealhistory.amount, 2)) as fat,
                                                    sum(round(servings.cho*walkin_mealhistory.amount, 2)) as carbohydrate,
                                                    sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as fiber,
                                                    sum(round(servings.ca*walkin_mealhistory.amount, 2)) as ca,
                                                    sum(round(servings.fe*walkin_mealhistory.amount, 2)) as fe,
                                                    sum(round(servings.mg*walkin_mealhistory.amount, 2)) as mg,
                                                    sum(round(servings.p*walkin_mealhistory.amount, 2)) as p,
                                                    sum(round(servings.k*walkin_mealhistory.amount, 2)) as k,
                                                    sum(round(servings.na*walkin_mealhistory.amount, 2)) as na,
                                                    sum(round(servings.zn*walkin_mealhistory.amount, 2)) as zn,
                                                    sum(round(servings.se*walkin_mealhistory.amount, 2)) as se,
                                                    sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as Vit_A_RAE,
                                                    sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as Vit_A_RE,
                                                    sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as retinol,
                                                    sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as b_carotene_equivalent,
                                                    sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as thiamin,
                                                    sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as riboflavin,
                                                    sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as niacin,
                                                    sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as dietary_folate_eq,
                                                    sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as food_folate,
                                                    sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as vit_B_12,
                                                    sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as vit_c,
                                                    sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as cholesterol,
                                                    sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as Oxalic_acid_OXALAC,
                                                    sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td id="success_emphasy" colspan='2'> Total Nutrients</td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>
                                                        
                                                        </tbody>
                                                    </table>

                                                

                                            <!-- Breakfast Mealhistory -->

                                            <!-- Mid Morning Mealhistory -->
                                            
                                                    <table class="table table-striped table-responsive mt-3">
                                                        <span id="success_emphasy">Mid Morning Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food</th>
                                                                <th scope="col">Serving(s)</th>
                                                                <th scope="col">Energy <small id="success_emphasy">(Kcals)</small></th>
                                                                <th scope="col">Water <small id="success_emphasy">(mls)</small></th>
                                                                <th scope="col">Protein <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fat <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Carbohydrate <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fiber <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Calcium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Iron <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Magnesium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phosphorous <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Potassium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Sodium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Zinc <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Selenium <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RAE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Retinol <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">B-Carotene <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Thiamin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Riboflavin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Niacin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Dietary Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Food Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-B12 <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-C <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Cholesterol <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Oxalic_Acid <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phytate <small id="success_emphasy">(mg)</small></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    round(servings.energy*walkin_mealhistory.amount, 2) as energy,
                                                    round(servings.water*walkin_mealhistory.amount, 2) as water,
                                                    round(servings.protein*walkin_mealhistory.amount, 2) as protein,
                                                    round(servings.fat*walkin_mealhistory.amount, 2) as fat,
                                                    round(servings.cho*walkin_mealhistory.amount, 2) as carbohydrate,
                                                    round(servings.fiber*walkin_mealhistory.amount, 2) as fiber,
                                                    round(servings.ca*walkin_mealhistory.amount, 2) as ca,
                                                    round(servings.fe*walkin_mealhistory.amount, 2) as fe,
                                                    round(servings.mg*walkin_mealhistory.amount, 2) as mg,
                                                    round(servings.p*walkin_mealhistory.amount, 2) as p,
                                                    round(servings.k*walkin_mealhistory.amount, 2) as k,
                                                    round(servings.na*walkin_mealhistory.amount, 2) as na,
                                                    round(servings.zn*walkin_mealhistory.amount, 2) as zn,
                                                    round(servings.se*walkin_mealhistory.amount, 2) as se,
                                                    round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2) as Vit_A_RAE,
                                                    round(servings.Vit_A_RE*walkin_mealhistory.amount, 2) as Vit_A_RE,
                                                    round(servings.retinol*walkin_mealhistory.amount, 2) as retinol,
                                                    round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2) as b_carotene_equivalent,
                                                    round(servings.thiamin*walkin_mealhistory.amount, 2) as thiamin,
                                                    round(servings.riboflavin*walkin_mealhistory.amount, 2) as riboflavin,
                                                    round(servings.niacin*walkin_mealhistory.amount, 2) as niacin,
                                                    round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2) as dietary_folate_eq,
                                                    round(servings.food_folate*walkin_mealhistory.amount, 2) as food_folate,
                                                    round(servings.vit_B_12*walkin_mealhistory.amount, 2) as vit_B_12,
                                                    round(servings.vit_c*walkin_mealhistory.amount, 2) as vit_c,
                                                    round(servings.cholesterol*walkin_mealhistory.amount, 2) as cholesterol,
                                                    round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2) as Oxalic_acid_OXALAC,
                                                    round(servings.phytate*walkin_mealhistory.amount, 2) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td><?php echo htmlentities($result->food);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>
                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    sum(round(servings.energy*walkin_mealhistory.amount, 2)) as energy,
                                                    sum(round(servings.water*walkin_mealhistory.amount, 2)) as water,
                                                    sum(round(servings.protein*walkin_mealhistory.amount, 2)) as protein,
                                                    sum(round(servings.fat*walkin_mealhistory.amount, 2)) as fat,
                                                    sum(round(servings.cho*walkin_mealhistory.amount, 2)) as carbohydrate,
                                                    sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as fiber,
                                                    sum(round(servings.ca*walkin_mealhistory.amount, 2)) as ca,
                                                    sum(round(servings.fe*walkin_mealhistory.amount, 2)) as fe,
                                                    sum(round(servings.mg*walkin_mealhistory.amount, 2)) as mg,
                                                    sum(round(servings.p*walkin_mealhistory.amount, 2)) as p,
                                                    sum(round(servings.k*walkin_mealhistory.amount, 2)) as k,
                                                    sum(round(servings.na*walkin_mealhistory.amount, 2)) as na,
                                                    sum(round(servings.zn*walkin_mealhistory.amount, 2)) as zn,
                                                    sum(round(servings.se*walkin_mealhistory.amount, 2)) as se,
                                                    sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as Vit_A_RAE,
                                                    sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as Vit_A_RE,
                                                    sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as retinol,
                                                    sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as b_carotene_equivalent,
                                                    sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as thiamin,
                                                    sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as riboflavin,
                                                    sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as niacin,
                                                    sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as dietary_folate_eq,
                                                    sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as food_folate,
                                                    sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as vit_B_12,
                                                    sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as vit_c,
                                                    sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as cholesterol,
                                                    sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as Oxalic_acid_OXALAC,
                                                    sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td id="success_emphasy" colspan='2'> Total Nutrients</td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                
                                            
                                             <!-- Mid Morning Mealhistory -->


                                            <!-- Lunch Mealhistory -->
                                                    <table class="table table-striped table-responsive mt-3">
                                                        <span id="success_emphasy">Lunch Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food</th>
                                                                <th scope="col">Serving(s)</th>
                                                                <th scope="col">Energy <small id="success_emphasy">(Kcals)</small></th>
                                                                <th scope="col">Water <small id="success_emphasy">(mls)</small></th>
                                                                <th scope="col">Protein <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fat <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Carbohydrate <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fiber <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Calcium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Iron <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Magnesium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phosphorous <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Potassium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Sodium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Zinc <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Selenium <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RAE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Retinol <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">B-Carotene <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Thiamin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Riboflavin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Niacin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Dietary Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Food Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-B12 <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-C <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Cholesterol <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Oxalic_Acid <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phytate <small id="success_emphasy">(mg)</small></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    round(servings.energy*walkin_mealhistory.amount, 2) as energy,
                                                    round(servings.water*walkin_mealhistory.amount, 2) as water,
                                                    round(servings.protein*walkin_mealhistory.amount, 2) as protein,
                                                    round(servings.fat*walkin_mealhistory.amount, 2) as fat,
                                                    round(servings.cho*walkin_mealhistory.amount, 2) as carbohydrate,
                                                    round(servings.fiber*walkin_mealhistory.amount, 2) as fiber,
                                                    round(servings.ca*walkin_mealhistory.amount, 2) as ca,
                                                    round(servings.fe*walkin_mealhistory.amount, 2) as fe,
                                                    round(servings.mg*walkin_mealhistory.amount, 2) as mg,
                                                    round(servings.p*walkin_mealhistory.amount, 2) as p,
                                                    round(servings.k*walkin_mealhistory.amount, 2) as k,
                                                    round(servings.na*walkin_mealhistory.amount, 2) as na,
                                                    round(servings.zn*walkin_mealhistory.amount, 2) as zn,
                                                    round(servings.se*walkin_mealhistory.amount, 2) as se,
                                                    round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2) as Vit_A_RAE,
                                                    round(servings.Vit_A_RE*walkin_mealhistory.amount, 2) as Vit_A_RE,
                                                    round(servings.retinol*walkin_mealhistory.amount, 2) as retinol,
                                                    round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2) as b_carotene_equivalent,
                                                    round(servings.thiamin*walkin_mealhistory.amount, 2) as thiamin,
                                                    round(servings.riboflavin*walkin_mealhistory.amount, 2) as riboflavin,
                                                    round(servings.niacin*walkin_mealhistory.amount, 2) as niacin,
                                                    round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2) as dietary_folate_eq,
                                                    round(servings.food_folate*walkin_mealhistory.amount, 2) as food_folate,
                                                    round(servings.vit_B_12*walkin_mealhistory.amount, 2) as vit_B_12,
                                                    round(servings.vit_c*walkin_mealhistory.amount, 2) as vit_c,
                                                    round(servings.cholesterol*walkin_mealhistory.amount, 2) as cholesterol,
                                                    round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2) as Oxalic_acid_OXALAC,
                                                    round(servings.phytate*walkin_mealhistory.amount, 2) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td><?php echo htmlentities($result->food);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>

                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    sum(round(servings.energy*walkin_mealhistory.amount, 2)) as energy,
                                                    sum(round(servings.water*walkin_mealhistory.amount, 2)) as water,
                                                    sum(round(servings.protein*walkin_mealhistory.amount, 2)) as protein,
                                                    sum(round(servings.fat*walkin_mealhistory.amount, 2)) as fat,
                                                    sum(round(servings.cho*walkin_mealhistory.amount, 2)) as carbohydrate,
                                                    sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as fiber,
                                                    sum(round(servings.ca*walkin_mealhistory.amount, 2)) as ca,
                                                    sum(round(servings.fe*walkin_mealhistory.amount, 2)) as fe,
                                                    sum(round(servings.mg*walkin_mealhistory.amount, 2)) as mg,
                                                    sum(round(servings.p*walkin_mealhistory.amount, 2)) as p,
                                                    sum(round(servings.k*walkin_mealhistory.amount, 2)) as k,
                                                    sum(round(servings.na*walkin_mealhistory.amount, 2)) as na,
                                                    sum(round(servings.zn*walkin_mealhistory.amount, 2)) as zn,
                                                    sum(round(servings.se*walkin_mealhistory.amount, 2)) as se,
                                                    sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as Vit_A_RAE,
                                                    sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as Vit_A_RE,
                                                    sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as retinol,
                                                    sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as b_carotene_equivalent,
                                                    sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as thiamin,
                                                    sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as riboflavin,
                                                    sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as niacin,
                                                    sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as dietary_folate_eq,
                                                    sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as food_folate,
                                                    sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as vit_B_12,
                                                    sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as vit_c,
                                                    sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as cholesterol,
                                                    sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as Oxalic_acid_OXALAC,
                                                    sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td id="success_emphasy" colspan='2'> Total Nutrients</td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                
                                             <!-- Lunch Mealhistory -->


                                            <!-- Mid Afternoon Mealhistory -->
                                            
                                                    <table class="table table-striped table-responsive mt-3">
                                                        <span id="success_emphasy">Mid-Afternoon Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food</th>
                                                                <th scope="col">Serving(s)</th>
                                                                <th scope="col">Energy <small id="success_emphasy">(Kcals)</small></th>
                                                                <th scope="col">Water <small id="success_emphasy">(mls)</small></th>
                                                                <th scope="col">Protein <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fat <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Carbohydrate <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fiber <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Calcium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Iron <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Magnesium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phosphorous <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Potassium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Sodium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Zinc <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Selenium <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RAE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Retinol <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">B-Carotene <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Thiamin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Riboflavin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Niacin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Dietary Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Food Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-B12 <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-C <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Cholesterol <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Oxalic_Acid <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phytate <small id="success_emphasy">(mg)</small></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    round(servings.energy*walkin_mealhistory.amount, 2) as energy,
                                                    round(servings.water*walkin_mealhistory.amount, 2) as water,
                                                    round(servings.protein*walkin_mealhistory.amount, 2) as protein,
                                                    round(servings.fat*walkin_mealhistory.amount, 2) as fat,
                                                    round(servings.cho*walkin_mealhistory.amount, 2) as carbohydrate,
                                                    round(servings.fiber*walkin_mealhistory.amount, 2) as fiber,
                                                    round(servings.ca*walkin_mealhistory.amount, 2) as ca,
                                                    round(servings.fe*walkin_mealhistory.amount, 2) as fe,
                                                    round(servings.mg*walkin_mealhistory.amount, 2) as mg,
                                                    round(servings.p*walkin_mealhistory.amount, 2) as p,
                                                    round(servings.k*walkin_mealhistory.amount, 2) as k,
                                                    round(servings.na*walkin_mealhistory.amount, 2) as na,
                                                    round(servings.zn*walkin_mealhistory.amount, 2) as zn,
                                                    round(servings.se*walkin_mealhistory.amount, 2) as se,
                                                    round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2) as Vit_A_RAE,
                                                    round(servings.Vit_A_RE*walkin_mealhistory.amount, 2) as Vit_A_RE,
                                                    round(servings.retinol*walkin_mealhistory.amount, 2) as retinol,
                                                    round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2) as b_carotene_equivalent,
                                                    round(servings.thiamin*walkin_mealhistory.amount, 2) as thiamin,
                                                    round(servings.riboflavin*walkin_mealhistory.amount, 2) as riboflavin,
                                                    round(servings.niacin*walkin_mealhistory.amount, 2) as niacin,
                                                    round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2) as dietary_folate_eq,
                                                    round(servings.food_folate*walkin_mealhistory.amount, 2) as food_folate,
                                                    round(servings.vit_B_12*walkin_mealhistory.amount, 2) as vit_B_12,
                                                    round(servings.vit_c*walkin_mealhistory.amount, 2) as vit_c,
                                                    round(servings.cholesterol*walkin_mealhistory.amount, 2) as cholesterol,
                                                    round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2) as Oxalic_acid_OXALAC,
                                                    round(servings.phytate*walkin_mealhistory.amount, 2) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td><?php echo htmlentities($result->food);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>

                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    sum(round(servings.energy*walkin_mealhistory.amount, 2)) as energy,
                                                    sum(round(servings.water*walkin_mealhistory.amount, 2)) as water,
                                                    sum(round(servings.protein*walkin_mealhistory.amount, 2)) as protein,
                                                    sum(round(servings.fat*walkin_mealhistory.amount, 2)) as fat,
                                                    sum(round(servings.cho*walkin_mealhistory.amount, 2)) as carbohydrate,
                                                    sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as fiber,
                                                    sum(round(servings.ca*walkin_mealhistory.amount, 2)) as ca,
                                                    sum(round(servings.fe*walkin_mealhistory.amount, 2)) as fe,
                                                    sum(round(servings.mg*walkin_mealhistory.amount, 2)) as mg,
                                                    sum(round(servings.p*walkin_mealhistory.amount, 2)) as p,
                                                    sum(round(servings.k*walkin_mealhistory.amount, 2)) as k,
                                                    sum(round(servings.na*walkin_mealhistory.amount, 2)) as na,
                                                    sum(round(servings.zn*walkin_mealhistory.amount, 2)) as zn,
                                                    sum(round(servings.se*walkin_mealhistory.amount, 2)) as se,
                                                    sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as Vit_A_RAE,
                                                    sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as Vit_A_RE,
                                                    sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as retinol,
                                                    sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as b_carotene_equivalent,
                                                    sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as thiamin,
                                                    sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as riboflavin,
                                                    sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as niacin,
                                                    sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as dietary_folate_eq,
                                                    sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as food_folate,
                                                    sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as vit_B_12,
                                                    sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as vit_c,
                                                    sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as cholesterol,
                                                    sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as Oxalic_acid_OXALAC,
                                                    sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td id="success_emphasy" colspan='2'> Total Nutrients</td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                                

                                             <!-- Mid Afternoon Mealhistory -->



                                            <!-- Supper Mealhistory -->

                                            
                                                    <table class="table table-striped table-responsive mt-3">
                                                        <span id="success_emphasy">Supper Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food</th>
                                                                <th scope="col">Serving(s)</th>
                                                                <th scope="col">Energy <small id="success_emphasy">(Kcals)</small></th>
                                                                <th scope="col">Water <small id="success_emphasy">(mls)</small></th>
                                                                <th scope="col">Protein <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fat <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Carbohydrate <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fiber <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Calcium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Iron <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Magnesium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phosphorous <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Potassium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Sodium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Zinc <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Selenium <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RAE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Retinol <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">B-Carotene <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Thiamin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Riboflavin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Niacin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Dietary Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Food Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-B12 <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-C <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Cholesterol <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Oxalic_Acid <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phytate <small id="success_emphasy">(mg)</small></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    round(servings.energy*walkin_mealhistory.amount, 2) as energy,
                                                    round(servings.water*walkin_mealhistory.amount, 2) as water,
                                                    round(servings.protein*walkin_mealhistory.amount, 2) as protein,
                                                    round(servings.fat*walkin_mealhistory.amount, 2) as fat,
                                                    round(servings.cho*walkin_mealhistory.amount, 2) as carbohydrate,
                                                    round(servings.fiber*walkin_mealhistory.amount, 2) as fiber,
                                                    round(servings.ca*walkin_mealhistory.amount, 2) as ca,
                                                    round(servings.fe*walkin_mealhistory.amount, 2) as fe,
                                                    round(servings.mg*walkin_mealhistory.amount, 2) as mg,
                                                    round(servings.p*walkin_mealhistory.amount, 2) as p,
                                                    round(servings.k*walkin_mealhistory.amount, 2) as k,
                                                    round(servings.na*walkin_mealhistory.amount, 2) as na,
                                                    round(servings.zn*walkin_mealhistory.amount, 2) as zn,
                                                    round(servings.se*walkin_mealhistory.amount, 2) as se,
                                                    round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2) as Vit_A_RAE,
                                                    round(servings.Vit_A_RE*walkin_mealhistory.amount, 2) as Vit_A_RE,
                                                    round(servings.retinol*walkin_mealhistory.amount, 2) as retinol,
                                                    round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2) as b_carotene_equivalent,
                                                    round(servings.thiamin*walkin_mealhistory.amount, 2) as thiamin,
                                                    round(servings.riboflavin*walkin_mealhistory.amount, 2) as riboflavin,
                                                    round(servings.niacin*walkin_mealhistory.amount, 2) as niacin,
                                                    round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2) as dietary_folate_eq,
                                                    round(servings.food_folate*walkin_mealhistory.amount, 2) as food_folate,
                                                    round(servings.vit_B_12*walkin_mealhistory.amount, 2) as vit_B_12,
                                                    round(servings.vit_c*walkin_mealhistory.amount, 2) as vit_c,
                                                    round(servings.cholesterol*walkin_mealhistory.amount, 2) as cholesterol,
                                                    round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2) as Oxalic_acid_OXALAC,
                                                    round(servings.phytate*walkin_mealhistory.amount, 2) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td><?php echo htmlentities($result->food);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>

                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    sum(round(servings.energy*walkin_mealhistory.amount, 2)) as energy,
                                                    sum(round(servings.water*walkin_mealhistory.amount, 2)) as water,
                                                    sum(round(servings.protein*walkin_mealhistory.amount, 2)) as protein,
                                                    sum(round(servings.fat*walkin_mealhistory.amount, 2)) as fat,
                                                    sum(round(servings.cho*walkin_mealhistory.amount, 2)) as carbohydrate,
                                                    sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as fiber,
                                                    sum(round(servings.ca*walkin_mealhistory.amount, 2)) as ca,
                                                    sum(round(servings.fe*walkin_mealhistory.amount, 2)) as fe,
                                                    sum(round(servings.mg*walkin_mealhistory.amount, 2)) as mg,
                                                    sum(round(servings.p*walkin_mealhistory.amount, 2)) as p,
                                                    sum(round(servings.k*walkin_mealhistory.amount, 2)) as k,
                                                    sum(round(servings.na*walkin_mealhistory.amount, 2)) as na,
                                                    sum(round(servings.zn*walkin_mealhistory.amount, 2)) as zn,
                                                    sum(round(servings.se*walkin_mealhistory.amount, 2)) as se,
                                                    sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as Vit_A_RAE,
                                                    sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as Vit_A_RE,
                                                    sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as retinol,
                                                    sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as b_carotene_equivalent,
                                                    sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as thiamin,
                                                    sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as riboflavin,
                                                    sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as niacin,
                                                    sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as dietary_folate_eq,
                                                    sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as food_folate,
                                                    sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as vit_B_12,
                                                    sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as vit_c,
                                                    sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as cholesterol,
                                                    sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as Oxalic_acid_OXALAC,
                                                    sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td id="success_emphasy" colspan='2'> Total Nutrients</td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>
                                                        </tbody>
                                                    </table>

                                            <!-- Supper Mealhistory -->


                                            <!-- Late Supper Mealhistory -->
                                           
                                                    <table class="table table-striped table-responsive mt-3">
                                                        <span id="success_emphasy">Late Supper Meals</span>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Food</th>
                                                                <th scope="col">Serving(s)</th>
                                                                <th scope="col">Energy <small id="success_emphasy">(Kcals)</small></th>
                                                                <th scope="col">Water <small id="success_emphasy">(mls)</small></th>
                                                                <th scope="col">Protein <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fat <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Carbohydrate <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Fiber <small id="success_emphasy">(g)</small></th>
                                                                <th scope="col">Calcium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Iron <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Magnesium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phosphorous <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Potassium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Sodium <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Zinc <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Selenium <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RAE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-A-RE <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Retinol <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">B-Carotene <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Thiamin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Riboflavin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Niacin <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Dietary Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Food Folate <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-B12 <small id="success_emphasy">(mcg)</small></th>
                                                                <th scope="col">Vit-C <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Cholesterol <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Oxalic_Acid <small id="success_emphasy">(mg)</small></th>
                                                                <th scope="col">Phytate <small id="success_emphasy">(mg)</small></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    round(servings.energy*walkin_mealhistory.amount, 2) as energy,
                                                    round(servings.water*walkin_mealhistory.amount, 2) as water,
                                                    round(servings.protein*walkin_mealhistory.amount, 2) as protein,
                                                    round(servings.fat*walkin_mealhistory.amount, 2) as fat,
                                                    round(servings.cho*walkin_mealhistory.amount, 2) as carbohydrate,
                                                    round(servings.fiber*walkin_mealhistory.amount, 2) as fiber,
                                                    round(servings.ca*walkin_mealhistory.amount, 2) as ca,
                                                    round(servings.fe*walkin_mealhistory.amount, 2) as fe,
                                                    round(servings.mg*walkin_mealhistory.amount, 2) as mg,
                                                    round(servings.p*walkin_mealhistory.amount, 2) as p,
                                                    round(servings.k*walkin_mealhistory.amount, 2) as k,
                                                    round(servings.na*walkin_mealhistory.amount, 2) as na,
                                                    round(servings.zn*walkin_mealhistory.amount, 2) as zn,
                                                    round(servings.se*walkin_mealhistory.amount, 2) as se,
                                                    round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2) as Vit_A_RAE,
                                                    round(servings.Vit_A_RE*walkin_mealhistory.amount, 2) as Vit_A_RE,
                                                    round(servings.retinol*walkin_mealhistory.amount, 2) as retinol,
                                                    round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2) as b_carotene_equivalent,
                                                    round(servings.thiamin*walkin_mealhistory.amount, 2) as thiamin,
                                                    round(servings.riboflavin*walkin_mealhistory.amount, 2) as riboflavin,
                                                    round(servings.niacin*walkin_mealhistory.amount, 2) as niacin,
                                                    round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2) as dietary_folate_eq,
                                                    round(servings.food_folate*walkin_mealhistory.amount, 2) as food_folate,
                                                    round(servings.vit_B_12*walkin_mealhistory.amount, 2) as vit_B_12,
                                                    round(servings.vit_c*walkin_mealhistory.amount, 2) as vit_c,
                                                    round(servings.cholesterol*walkin_mealhistory.amount, 2) as cholesterol,
                                                    round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2) as Oxalic_acid_OXALAC,
                                                    round(servings.phytate*walkin_mealhistory.amount, 2) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td><?php echo htmlentities($result->food);?></td>
                                                                <td><?php echo htmlentities($result->amount);?>&nbsp;<?php echo htmlentities($result->serving);?></td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                                
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
                                                        } 
                                                ?>

                                                <?php 
                                                    error_reporting(E_ALL & E_NOTICE);
                                                    include 'includes/db_conn.php'; 
                                                    $id=$_GET['view'];
                                                    
                                                    $sql = "SELECT walkin_mealhistory.id, walkin_mealhistory.foods_id, walkin_mealhistory.client_no, foods.name as food, walkin_mealhistory.amount, servings.name as serving,  
                                                    sum(round(servings.energy*walkin_mealhistory.amount, 2)) as energy,
                                                    sum(round(servings.water*walkin_mealhistory.amount, 2)) as water,
                                                    sum(round(servings.protein*walkin_mealhistory.amount, 2)) as protein,
                                                    sum(round(servings.fat*walkin_mealhistory.amount, 2)) as fat,
                                                    sum(round(servings.cho*walkin_mealhistory.amount, 2)) as carbohydrate,
                                                    sum(round(servings.fiber*walkin_mealhistory.amount, 2)) as fiber,
                                                    sum(round(servings.ca*walkin_mealhistory.amount, 2)) as ca,
                                                    sum(round(servings.fe*walkin_mealhistory.amount, 2)) as fe,
                                                    sum(round(servings.mg*walkin_mealhistory.amount, 2)) as mg,
                                                    sum(round(servings.p*walkin_mealhistory.amount, 2)) as p,
                                                    sum(round(servings.k*walkin_mealhistory.amount, 2)) as k,
                                                    sum(round(servings.na*walkin_mealhistory.amount, 2)) as na,
                                                    sum(round(servings.zn*walkin_mealhistory.amount, 2)) as zn,
                                                    sum(round(servings.se*walkin_mealhistory.amount, 2)) as se,
                                                    sum(round(servings.Vit_A_RAE*walkin_mealhistory.amount, 2)) as Vit_A_RAE,
                                                    sum(round(servings.Vit_A_RE*walkin_mealhistory.amount, 2)) as Vit_A_RE,
                                                    sum(round(servings.retinol*walkin_mealhistory.amount, 2)) as retinol,
                                                    sum(round(servings.b_carotene_equivalent*walkin_mealhistory.amount, 2)) as b_carotene_equivalent,
                                                    sum(round(servings.thiamin*walkin_mealhistory.amount, 2)) as thiamin,
                                                    sum(round(servings.riboflavin*walkin_mealhistory.amount, 2)) as riboflavin,
                                                    sum(round(servings.niacin*walkin_mealhistory.amount, 2)) as niacin,
                                                    sum(round(servings.dietary_folate_eq*walkin_mealhistory.amount, 2)) as dietary_folate_eq,
                                                    sum(round(servings.food_folate*walkin_mealhistory.amount, 2)) as food_folate,
                                                    sum(round(servings.vit_B_12*walkin_mealhistory.amount, 2)) as vit_B_12,
                                                    sum(round(servings.vit_c*walkin_mealhistory.amount, 2)) as vit_c,
                                                    sum(round(servings.cholesterol*walkin_mealhistory.amount, 2)) as cholesterol,
                                                    sum(round(servings.Oxalic_Acid_OXALAC*walkin_mealhistory.amount, 2)) as Oxalic_acid_OXALAC,
                                                    sum(round(servings.phytate*walkin_mealhistory.amount, 2)) as phytate

                                                    FROM walkin_mealhistory
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
                                                                <td id="success_emphasy" colspan='2'> Total Nutrients</td>
                                                                <td><?php echo htmlentities($result->energy);?></td>
                                                                <td><?php echo htmlentities($result->water);?></td>
                                                                <td><?php echo htmlentities($result->protein);?></td>
                                                                <td><?php echo htmlentities($result->fat);?></td>
                                                                <td><?php echo htmlentities($result->carbohydrate);?></td>
                                                                <td><?php echo htmlentities($result->fiber);?></td>
                                                                <td><?php echo htmlentities($result->ca);?></td>
                                                                <td><?php echo htmlentities($result->fe);?></td>
                                                                <td><?php echo htmlentities($result->mg);?></td>
                                                                <td><?php echo htmlentities($result->p);?></td>
                                                                <td><?php echo htmlentities($result->k);?></td>
                                                                <td><?php echo htmlentities($result->na);?></td>
                                                                <td><?php echo htmlentities($result->zn);?></td>
                                                                <td><?php echo htmlentities($result->se);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RAE);?></td>
                                                                <td><?php echo htmlentities($result->Vit_A_RE);?></td>
                                                                <td><?php echo htmlentities($result->retinol);?></td>
                                                                <td><?php echo htmlentities($result->b_carotene_equivalent);?></td>
                                                                <td><?php echo htmlentities($result->thiamin);?></td>
                                                                <td><?php echo htmlentities($result->riboflavin);?></td>
                                                                <td><?php echo htmlentities($result->niacin);?></td>
                                                                <td><?php echo htmlentities($result->dietary_folate_eq);?></td>
                                                                <td><?php echo htmlentities($result->food_folate);?></td>
                                                                <td><?php echo htmlentities($result->vit_B_12);?></td>
                                                                <td><?php echo htmlentities($result->vit_c);?></td>
                                                                <td><?php echo htmlentities($result->cholesterol);?></td>
                                                                <td><?php echo htmlentities($result->Oxalic_acid_OXALAC);?></td>
                                                                <td><?php echo htmlentities($result->phytate);?></td>
                                                            </tr>
                                                <?php }} 
                                                    else{
                                                        echo '<p id="table_alert">Client has No Meals !!</p>';
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