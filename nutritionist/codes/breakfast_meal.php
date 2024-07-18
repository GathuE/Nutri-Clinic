<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Picolina Wellness">
        <meta name="description" content="Healthy Nutrition and Fitness">
        <meta name="keywords" content="weightmanagement, healthydiets, bodybuilding, fitness, healthymeals, picolina, wellness">
    
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      
        <!-- SweetAlert CSS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    
    
        <!--Custom CSS-->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="sweetalert2.min.css">
    
        <link rel="icon" href="#" type="image/icon type">
        <title>Nutri App</title>
        
    </head>
<body>
     <!-- Navigation Section -->
     <?php 
        include 'navbarmain.php';
    ?>
<div class="container" id="container">
          <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card" id="breakfast" class="divs" style="position:relative;top:20px;border-radius:5px; cursor:pointer;">
                        <div class="card-header" style="font-size: 20px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:green;">Breakfast : <br>    
                    </div>
                    <div class="card-body">
                      <div class="container-fluid">
                          <form id="breakfastform" name="mealone" class="text-center p-3" style="font-family: monospace;font-size:12px;font-weight:500;color:darkgreen;" action="insert_breakfast.php" method="post">
                                  <div class="row">
                                      <!-- Breakfast -->
                                      <div class="col">
                                          <!-- Food Choice -->
                                          <label> Did You Have Breakfast? </label><br>
                                              <input type="radio" onclick="yesnoCheck();" name="yesno" id="yesCheck">
                                              <label>Yes</label>
                                              <input type="radio" onclick="yesnoCheck();" name="yesno" id="noCheck" checked>
                                              <label>No</label>
                                      </div>
                                  </div>
                                <div id="ifYes" style="display:none">
                                          <div class="form-group">
                                          <label>Select Food taken</label>
                                            <select name="foods_id" id="category_item" class="form-control input-lg" data-live-search="true" title="Select Category" required>
                                            </select>
                                          </div>
                                          <div class="form-group">
                                          <label>Select Serving Type</label>
                                            <select name="servings_id" id="sub_category_item" class="form-control input-lg" data-live-search="true" title="Select Sub Category" required>
                                            </select>
                                          </div>
                                        <div class="form-group">
                                                  <label for="amount">No of Serving Item(s):</label>
                                                  <input type="number" min="0"  class="form-control mb-4"style="font-family: monospace;font-size:12px;font-weight:500;color:darkgreen;" name="amount" id="amount"  placeholder="Enter Amount e.g 0.5" required >
                                        </div>
                                        <div class="form-group">
                                              <input type="submit"  class="btn btn-success" id="breko" style="font-size:12px;width:150px;margin-right:auto;" value="Add to Breakfast">
                                        </div>
                                        
                                </div> 
                                        <div class="card-footer">
                                              <a class="btn btn-info" style="font-size:12px;width:150px;" href="mid-morning.php">Next Meal</a>
                                        </div>
                              </div>
                          </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

<script src="foods.js" defer></script>
<script>
$(document).ready(function(){

  $('#category_item').selectpicker();

  $('#sub_category_item').selectpicker();

  load_data('category_data');

  function load_data(type, category_id = '')
  {
    $.ajax({
      url:"load_data.php",
      method:"POST",
      data:{type:type, category_id:category_id},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
        }
        if(type == 'category_data')
        {
          $('#category_item').html(html);
          $('#category_item').selectpicker('refresh');
        }
        else
        {
          $('#sub_category_item').html(html);
          $('#sub_category_item').selectpicker('refresh');
        }
      }
    })
  }

  $(document).on('change', '#category_item', function(){
    var category_id = $('#category_item').val();
    load_data('sub_category_data', category_id);
  });
  
});

// Choice Of Foods 
$(document).ready(function() {
    $("#breko").click(function() {
        var bfood = document.getElementById("category_item").value;
        var bitem = document.getElementById("sub_category_item").value;
        var bserving = document.getElementById("amount").value;

        var bfood = document.mealone.bfood.value;
        if (bfood === "" || bitem === "" || bserving === "") {
            Swal.fire({
                size: '200px',
                position: 'top-center',
                icon: 'error',
                text: 'Please fill in all Fields correctly.',
                showConfirmButton: true,
                timer: 2500
            })
            return false;
        }

    });

});

</script>


</body>
</html>




