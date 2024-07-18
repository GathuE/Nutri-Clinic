<?php 
 include_once 'includes/database.php';

if (isset($_POST['food_id'])) {
	$query = "SELECT * FROM servings where foods_id=".$_POST['food_id'];
	$result = $con->query($query);
	if ($result->num_rows > 0 ) {
			echo '<option value="">Select Serving Item</option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
		 }
	}else{

		echo '<option>No Serving Item Found!</option>';
	}
}
?>