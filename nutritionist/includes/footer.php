</body>
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="../assets/js/plugin/chartist/chartist.min.js"></script>
    <script src="../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/ready.min.js"></script>
    <script src="../assets/js/demo.js"></script>


    <!-- Additional Javascript -->

    <script>
         setTimeout (function(){
           //closing the alert
           $('.alert').alert('close');
       }, 3000);
    </script>

    <!-- Save Breakfast -->
    <script>
            $(document).ready(function () {
            $('#save_breakfast').click(function (e) {
            e.preventDefault();

            var name = $('#c_name').val();
            var phone = $('#c_phone').val();
            var code = $('#c_code').val();
            var meal = $('#breakfast_meal').val();
            var food = $('#foods_id_breakfast').val();
            var servingitem = $('#servings_id_breakfast').val();
            var amount = $('#breakfast_amount').val();

            if(food.length == 0 || servingitem.length == 0 || amount.length == 0){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "form_submit.php",
                data: { "name": name, "phone": phone, "code": code, "meal": meal, "food": food, "servingitem": servingitem, "amount": amount },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#breakfast-form')[0].reset();
                        //$("#success").show();
                        //$('#success').html('Meal Saved !'); 		
                        swal({
                        text: "Meal Saved",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#breakfast-form')[0].reset();
                       // $("#error").show();
					   // $('#error').html('Meal Already Exists !');
                        swal({
                        text: "Meal Already Exists",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>

    <!-- Save Breakfast -->
    <!-- Save MidMorning -->
    <script>
            $(document).ready(function () {
            $('#save_midmorning').click(function (e) {
            e.preventDefault();

            var name = $('#p_name').val();
            var phone = $('#p_phone').val();
            var code = $('#p_code').val();
            var meal = $('#midmorning_meal').val();
            var food = $('#foods_id_midmorning').val();
            var servingitem = $('#servings_id_midmorning').val();
            var amount = $('#midmorning_amount').val();

            if(food.length == 0 || servingitem.length == 0 || amount.length == 0){

                swal({
                        
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "form_submit.php",
                data: { "name": name, "phone": phone, "code": code, "meal": meal, "food": food, "servingitem": servingitem, "amount": amount },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#midmorning-form')[0].reset();

                        swal({
                        text: "Meal Saved",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#midmorning-form')[0].reset();

                        swal({
                        text: "Meal Already Exists",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>
    <!-- Save MidMorning -->
    <!-- Save Lunch -->
    <script>
            $(document).ready(function () {
            $('#save_lunch').click(function (e) {
            e.preventDefault();

            var name = $('#name').val();
            var phone = $('#phone').val();
            var code = $('#code').val();
            var meal = $('#lunch_meal').val();
            var food = $('#foods_id_lunch').val();
            var servingitem = $('#servings_id_lunch').val();
            var amount = $('#lunch_amount').val();
            
            if(food.length == 0 || servingitem.length == 0 || amount.length == 0){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "form_submit.php",
                data: { "name": name, "phone": phone, "code": code, "meal": meal, "food": food, "servingitem": servingitem, "amount": amount },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#lunch-form')[0].reset();

                        swal({
                        text: "Meal Saved",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#lunch-form')[0].reset();

                        swal({
                        text: "Meal Already Exists",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>
    <!-- Save Lunch -->
    <!-- Save Mid Afternoon -->

    <script>
            $(document).ready(function () {
            $('#save_midafternoon').click(function (e) {
            e.preventDefault();

            var name = $('#cname').val();
            var phone = $('#cphone').val();
            var code = $('#ccode').val();
            var meal = $('#midafternoon_meal').val();
            var food = $('#foods_id_midafternoon').val();
            var servingitem = $('#servings_id_midafternoon').val();
            var amount = $('#midafternoon_amount').val();
            
            if(food.length == 0 || servingitem.length == 0 || amount.length == 0){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "form_submit.php",
                data: { "name": name, "phone": phone, "code": code, "meal": meal, "food": food, "servingitem": servingitem, "amount": amount },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#midafternoon-form')[0].reset();

                        swal({
                        text: "Meal Saved",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#midafternoon-form')[0].reset();

                        swal({
                        text: "Meal Already Exists",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>
    <!-- Save Mid Afternoon -->
    <!-- Save Supper -->

<script>
            $(document).ready(function () {
            $('#save_supper').click(function (e) {
            e.preventDefault();

            var name = $('#pname').val();
            var phone = $('#pphone').val();
            var code = $('#pcode').val();
            var meal = $('#supper_meal').val();
            var food = $('#foods_id_supper').val();
            var servingitem = $('#servings_id_supper').val();
            var amount = $('#supper_amount').val();
            
            if(food.length == 0 || servingitem.length == 0 || amount.length == 0){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "form_submit.php",
                data: { "name": name, "phone": phone, "code": code, "meal": meal, "food": food, "servingitem": servingitem, "amount": amount },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#supper-form')[0].reset();

                        swal({
                        text: "Meal Saved",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#supper-form')[0].reset();

                        swal({
                        text: "Meal Already Exists",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>

    <!-- Save Supper -->
    <!-- Save Late Supper -->

    <script>
            $(document).ready(function () {
            $('#save_latesupper').click(function (e) {
            e.preventDefault();

            var name = $('#clientname').val();
            var phone = $('#clientphone').val();
            var code = $('#clientcode').val();
            var meal = $('#latesupper_meal').val();
            var food = $('#foods_id_latesupper').val();
            var servingitem = $('#servings_id_latesupper').val();
            var amount = $('#latesupper_amount').val();
            
            if(food.length == 0 || servingitem.length == 0 || amount.length == 0){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "form_submit.php",
                data: { "name": name, "phone": phone, "code": code, "meal": meal, "food": food, "servingitem": servingitem, "amount": amount },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#latesupper-form')[0].reset();

                        swal({
                        text: "Meal Saved",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#latesupper-form')[0].reset();

                        swal({
                        text: "Meal Already Exists",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>
    <!-- Save Late Supper -->

    <script type="text/javascript">
        
    function sum_age() {
        let num1 = document.getElementsByName("years")[0].value;
        let num2 = document.getElementsByName("months")[0].value;
        let sum = (Number(num1) + Number(num2/12)).toFixed(1);
        document.getElementsByName("age")[0].value = sum;
    }  

    </script>

    

<script>
//show Pregnant and Lactating Sections
  document.getElementById("gender").onchange = setListener;
  
  function setListener(){
  var value = this.value
  var age =  document.getElementsByName("age")[0].value;
      console.log(value);
      if (value == "Male"){
          document.getElementById("combo").style.display = "none";
      }else if (value == "Female" && age >=14 && age <=50){
          document.getElementById("combo").style.display = "block"; 
      }
      else if (value == ""){
          document.getElementById("combo").style.display = "none"; 
      }
      
  }
</script>

<script type="text/javascript">

    function claculate_eer(){


        document.getElementById("calculate_eer").disabled = false;
        document.getElementById("calculate_eer").style.cursor = "pointer";

        var a = document.getElementById("iom_age").value;
        var h = document.getElementById("iom_height").value;
        var w = document.getElementById("iom_weight").value;
        var j = document.getElementById("iom_pal").value;
        var p = document.getElementById("iom_pregnant").value;
        var l = document.getElementById("iom_lactating").value;
        var g = document.getElementById("iom_gender").value;


        if(j.length == 0 ){
            swal({
                //title: "Title",
                text: "Please Specify Client's PAL!!",
                icon: "warning",
                width: '200px',
                timer: 1500
                });
                return false;
        }


        //male EER Calculations
        
        // PAL (0.5 - 1 years) checked
        if (a >= 0.5 && a <= 1 && g == "Male") {
            var eer = (99 * w - 100) + 22;
            // PAL (2 - 3 years) checked
        } else if (a >= 2 && a <= 3 && g == "Male") {
            var eer = (99 * w - 100) + 20;
        }

         // PAL (4 - 8 years) checked
        else if (a >= 4 && a <= 8 && j == "Sedentary" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.00 * (26.7 * w + 903 * (h / 100)) + 20;
        } else if (a >= 4 && a <= 8 && j == "Light" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.13 * (26.7 * w + 903 * (h / 100)) + 20;
        } else if (a >= 4 && a <= 8 && j == "Moderate" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.26 * (26.7 * w + 903 * (h / 100)) + 20;
        } else if (a >= 4 && a <= 8 && j == "Heavy" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.42 * (26.7 * w + 903 * (h / 100)) + 20;
        }

            // PAL (9 - 13 years) checked
        else if (a >= 9 && a <= 13 && j == "Sedentary" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.00 * (26.7 * w + 903 * (h / 100)) + 25;
        } else if (a >= 9 && a <= 13 && j == "Light" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.13 * (26.7 * w + 903 * (h / 100)) + 25;
        } else if (a >= 9 && a <= 13 && j == "Moderate" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.26 * (26.7 * w + 903 * (h / 100)) + 25;
        } else if (a >= 9 && a <= 13 && j == "Heavy" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.42 * (26.7 * w + 903 * (h / 100)) + 25;
        }


            // PAL (14 - 18 years) checked
        else if (a >= 14 && a <= 18 && j == "Sedentary" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.00 * (26.7 * w + 903 * (h / 100)) + 25;
        } else if (a >= 14 && a <= 18 && j == "Light" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.13 * (26.7 * w + 903 * (h / 100)) + 25;
        } else if (a >= 14 && a <= 18 && j == "Moderate" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.26 * (26.7 * w + 903 * (h / 100)) + 25;
        } else if (a >= 14 && a <= 18 && j == "Heavy" && g == "Male") {
            var eer = 88.5 - 61.9 * a + 1.42 * (26.7 * w + 903 * (h / 100)) + 25;
        }

            // PAL (19 - 30 years) checked
        else if (a >= 19 && a <= 30 && j == "Sedentary" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 19 && a <= 30 && j == "Light" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 19 && a <= 30 && j == "Moderate" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 19 && a <= 30 && j == "Heavy" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
        }

            // PAL (31 - 50 years) checked
        else if (a >= 31 && a <= 50 && j == "Sedentary" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 31 && a <= 50 && j == "Light" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 31 && a <= 50 && j == "Moderate" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 31 && a <= 50 && j == "Heavy" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
        }

            // PAL (51 - 70 years) checked
        else if (a >= 51 && a <= 70 && j == "Sedentary" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 51 && a <= 70 && j == "Light" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 51 && a <= 70 && j == "Moderate" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 51 && a <= 70 && j == "Heavy" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
        }

            // PAL (71 and Above years) checked
        else if (a >= 71 && a <= 100 && j == "Sedentary" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.00 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 71 && a <= 100 && j == "Light" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.11 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 71 && a <= 100 && j == "Moderate" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.25 * (15.91 * w + 539.6 * (h / 100));
        } else if (a >= 71 && a <= 100 && j == "Heavy" && g == "Male") {
            var eer = 662 - 9.53 * a + 1.48 * (15.91 * w + 539.6 * (h / 100));
        }

            // female PAL Calculations
        // PAL (0.5 - 1 years)
        else if (a >= 0.5 && a <= 1 && g == "Female") {
            var eer = (99 * w - 100) + 22;
            // PAL (2 - 3 years)
        } else if (a >= 2 && a <= 3 && g == "Female") {
            var eer = (99 * w - 100) + 20;
        }
            
            // PAL (4 - 8 years)
        else if (a >= 4 && a <= 8 && j == "Sedentary" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 20;
        } else if (a >= 4 && a <= 8 && j == "Light" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.16)) + (934 * h / 100) + 20;
        } else if (a >= 4 && a <= 8 && j == "Moderate" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.31)) + (934 * h / 100) + 20;
        } else if (a >= 4 && a <= 8 && j == "Heavy" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.56)) + (934 * h / 100) + 20;
        }

            // PAL (9 - 13 years)
        else if (a >= 9 && a <= 13 && j == "Sedentary" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25;
        } else if (a >= 9 && a <= 13 && j == "Light" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.16)) + (934 * h / 100) + 25;
        } else if (a >= 9 && a <= 13 && j == "Moderate" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.31)) + (934 * h / 100) + 25;
        } else if (a >= 9 && a <= 13 && j == "Heavy" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.56)) + (934 * h / 100) + 25;
        }

            // PAL (14 - 18 years) Non pregnant Non Lactating checked
        else if (a >= 14 && a <= 18 && j == "Sedentary" && p == "No" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25;
        } else if (a >= 14 && a <= 18 && j == "Light" && p == "No" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.16)) + (934 * h / 100) + 25;
        } else if (a >= 14 && a <= 18 && j == "Moderate" && p == "No" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.31)) + (934 * h / 100) + 25;
        } else if (a >= 14 && a <= 18 && j == "Heavy" && p == "No" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.56)) + (934 * h / 100) + 25;
        }


         // PAL (14 - 18 years) Pregnant Non Lactating checked
        else if (a >= 14 && a <= 18 && j == "Sedentary" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25 + 272 + 180;
        } else if (a >= 14 && a <= 18 && j == "Light" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.12)) + (934 * h / 100) + 25 + 272 + 180;
        } else if (a >= 14 && a <= 18 && j == "Moderate" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.27)) + (934 * h / 100) + 25 + 272 + 180;
        } else if (a >= 14 && a <= 18 && j == "Heavy" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.45)) + (934 * h / 100) + 25 + 272 + 180;
        }

            // PAL (14 - 18 years) Lactating Non Pregnant checked
        else if (a >= 14 && a <= 18 && j == "Sedentary" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.00)) + (934 * h / 100) + 25 + 500 - 170;
        } else if (a >= 14 && a <= 18 && j == "Light" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.12)) + (934 * h / 100) + 25 + 272 - 170;
        } else if (a >= 14 && a <= 18 && j == "Moderate" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.27)) + (934 * h / 100) + 25 + 272 - 170;
        } else if (a >= 14 && a <= 18 && j == "Heavy" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (135.3 - (30.8 * a) + (10 * w * 1.45)) + (934 * h / 100) + 25 + 272 - 170;
        }

            // PAL (19 - 30 years) Non pregnant non Lactating checked
        else if (a >= 19 && a <= 30 && j == "Sedentary" && p == "No" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
        } else if (a >= 19 && a <= 30 && j == "Light" && p == "No" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
        } else if (a >= 19 && a <= 30 && j == "Moderate" && p == "No" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
        } else if (a >= 19 && a <= 30 && j == "Heavy" && p == "No" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
        }

           // PAL (19 - 30 years) Lactating Non Pregnant checked
        else if (a >= 19 && a <= 30 && j == "Sedentary" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 500 - 170;
        } else if (a >= 19 && a <= 30 && j == "Light" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 500 - 170;
        } else if (a >= 19 && a <= 30 && j == "Moderate" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 500 - 170;
        } else if (a >= 19 && a <= 30 && j == "Heavy" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 500 - 170;
        }

            // PAL (31 - 50 years) Pregnant Non Lactating checked
        else if (a >= 31 && a <= 50 && j == "Sedentary" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 272 + 180;
        } else if (a >= 31 && a <= 50 && j == "Light" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 272 + 180;
        } else if (a >= 31 && a <= 50 && j == "Moderate" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 272 + 180;
        } else if (a >= 31 && a <= 50 && j == "Heavy" && p == "Yes" && l == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 272 + 180;
        }

            // PAL (31 - 50 years) Lactating Non Pregnant checked
        else if (a >= 31 && a <= 50 && j == "Sedentary" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100) + 500 - 170;
        } else if (a >= 31 && a <= 50 && j == "Light" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100) + 500 - 170;
        } else if (a >= 31 && a <= 50 && j == "Moderate" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100) + 500 - 170;
        } else if (a >= 31 && a <= 50 && j == "Heavy" && l == "Yes" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100) + 500 - 170;
        }

            // PAL (31 - 50 years) Non pregnant checked
        else if (a >= 31 && a <= 50 && j == "Sedentary" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
        } else if (a >= 31 && a <= 50 && j == "Light" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
        } else if (a >= 31 && a <= 50 && j == "Moderate" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
        } else if (a >= 31 && a <= 50 && j == "Heavy" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
        }

            // PAL (51 - 70 years) Non pregnant checked
        else if (a >= 51 && a <= 70 && j == "Sedentary" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
        } else if (a >= 51 && a <= 70 && j == "Light" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
        } else if (a >= 51 && a <= 70 && j == "Moderate" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
        } else if (a >= 51 && a <= 70 && j == "Heavy" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
        }

            // PAL (71 years and Above) Non pregnant checked
        else if (a >= 71 && a <= 100 && j == "Sedentary" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.00)) + (726 * h / 100);
        } else if (a >= 71 && a <= 100 && j == "Light" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.12)) + (726 * h / 100);
        } else if (a >= 71 && a <= 100 && j == "Moderate" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.27)) + (726 * h / 100);
        } else if (a >= 71 && a <= 100 && j == "Heavy" && p == "No" && g == "Female") {
            var eer = (354.6 - (6.91 * a) + (9.36 * w * 1.45)) + (726 * h / 100);
        }

        var eer = (eer.toFixed(1));
        
        window.eer = eer;
        window.a = a;
        window.g = g;
        window.w = w;
        window.p = p;
        window.l = l;

        document.getElementById("iom_energy").innerHTML = eer;
        document.getElementById("iom_nutrients").style.display = "block";
        document.getElementById("calculate_eer").disabled = true;
        document.getElementById("calculate_eer").style.cursor = "not-allowed";

    };


    function calculate_nutrients(){

        var c_ratio_iom  = document.getElementById("carbohydrate_ratio_iom").value;
        var f_ratio_iom = document.getElementById("fat_ratio_iom").value;
        var p_ratio_iom = document.getElementById("protein_ratio_iom").value;

        if(c_ratio_iom.length == 0 || f_ratio_iom.length == 0 || p_ratio_iom.length == 0){
            swal({
                //title: "Title",
                text: "Please Specify Your Macro Nutrients Distribution!!",
                icon: "warning",
                width: '200px',
                timer: 1500
                });
                return false;
        }

        var carbohydrate_const = (c_ratio_iom * 0.0025);
        var protein_const = (p_ratio_iom * 0.0025);
        var fat_const = (f_ratio_iom * 0.0011);





        // Nutrients Data (Male)
    // 0.5 - 1 yrs checked
    if (a >= 0.5 && a <= 1 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 12;
        var calcium = 260;
        var iron = 11;
        var magnesium = 75;
        var phosphorous = 275;
        var potassium = 700;
        var sodium = 370;
        var zinc = 5;
        var sellenium = 20;
        var vitarae = 500;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.3;
        var riboflavin = 0.4;
        var niacin = 4;
        var dietaryfolate = 80;
        var foodfolate = 0;
        var vitb12 = 0.5;
        var vitc = 50;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 2 - 3 yrs checked
    else if (a >= 2 && a <= 3 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 19;
        var calcium = 700;
        var iron = 7;
        var magnesium = 65;
        var phosphorous = 460;
        var potassium = 3000;
        var sodium = 1000;
        var zinc = 7;
        var sellenium = 20;
        var vitarae = 300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.5;
        var riboflavin = 0.5;
        var niacin = 6;
        var dietaryfolate = 150;
        var foodfolate = 0;
        var vitb12 = 0.9;
        var vitc = 15;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }

    // 4 - 8 yrs checked
    else if (a >= 4 && a <= 8 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1000;
        var iron = 10;
        var magnesium = 130;
        var phosphorous = 500;
        var potassium = 3800;
        var sodium = 1200;
        var zinc = 12;
        var sellenium = 30;
        var vitarae = 400;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.6;
        var riboflavin = 0.6;
        var niacin = 8;
        var dietaryfolate = 200;
        var foodfolate = 0;
        var vitb12 = 1.2;
        var vitc = 25;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
     // 9 - 13 yrs checked
     else if (a >= 9 && a <= 13 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 31;
        var calcium = 1300;
        var iron = 8;
        var magnesium = 240;
        var phosphorous = 1250;
        var potassium = 4500;
        var sodium = 1500;
        var zinc = 12;
        var sellenium = 40;
        var vitarae = 600;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.9;
        var riboflavin = 0.9;
        var niacin = 12;
        var dietaryfolate = 300;
        var foodfolate = 0;
        var vitb12 = 1.8;
        var vitc = 45;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
     // 14 - 18 yrs checked
     else if (a >= 14 && a <= 18 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 38;
        var calcium = 1300;
        var iron = 11;
        var magnesium = 410;
        var phosphorous = 1250;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs checked
    else if (a >= 19 && a <= 30 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 38;
        var calcium = 1000;
        var iron = 8;
        var magnesium = 400;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;
    }

    // 31 - 50 yrs checked
    else if (a >= 31 && a <= 50 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 38;
        var calcium = 1000;
        var iron = 8;
        var magnesium = 420;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 51 - 70 yrs checked
    else if (a >= 51 && a <= 70 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 30;
        var calcium = 1000;
        var iron = 8;
        var magnesium = 420;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
     // 71 - 100 yrs checked
     else if (a >= 71 && a <= 100 && g == "Male") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 30;
        var calcium = 1200;
        var iron = 8;
        var magnesium = 420;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 1200;
        var zinc = 11;
        var sellenium = 55;
        var vitarae = 900;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.2;
        var riboflavin = 1.3;
        var niacin = 16;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 90;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
     // Nutrients Data (Female)
    // 0.5 - 1 yrs checked
    if (a >= 0.5 && a <= 1 && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 12;
        var calcium = 260;
        var iron = 11;
        var magnesium = 75;
        var phosphorous = 275;
        var potassium = 700;
        var sodium = 370;
        var zinc = 3;
        var sellenium = 20;
        var vitarae = 500;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.3;
        var riboflavin = 0.4;
        var niacin = 4;
        var dietaryfolate = 80;
        var foodfolate = 0;
        var vitb12 = 0.5;
        var vitc = 30;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 2 - 3 yrs checked
    else if (a >= 2 && a <= 3 && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 19;
        var calcium = 700;
        var iron = 9;
        var magnesium = 80;
        var phosphorous = 460;
        var potassium = 3000;
        var sodium = 1000;
        var zinc = 3;
        var sellenium = 20;
        var vitarae = 300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.5;
        var riboflavin = 0.5;
        var niacin = 6;
        var dietaryfolate = 150;
        var foodfolate = 0;
        var vitb12 = 0.9;
        var vitc = 35;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 4 - 8 yrs checked
    else if (a >= 4 && a <= 8 && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1000;
        var iron = 10;
        var magnesium = 130;
        var phosphorous = 500;
        var potassium = 3800;
        var sodium = 1200;
        var zinc = 5;
        var sellenium = 30;
        var vitarae = 400;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.6;
        var riboflavin = 0.6;
        var niacin = 8;
        var dietaryfolate = 200;
        var foodfolate = 0;
        var vitb12 = 1.2;
        var vitc = 35;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;
    }

    // 9 - 13 yrs checked
    else if (a >= 9 && a <= 13 && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 26;
        var calcium = 1300;
        var iron = 8;
        var magnesium = 240;
        var phosphorous = 1250;
        var potassium = 4500;
        var sodium = 1500;
        var zinc = 8;
        var sellenium = 40;
        var vitarae = 600;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 0.9;
        var riboflavin = 0.9;
        var niacin = 12;
        var dietaryfolate = 300;
        var foodfolate = 0;
        var vitb12 = 1.8;
        var vitc = 45;
        var cholestrol = 0;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs Non pegnant checked
    else if (a >= 14 && a <= 18 && p == "No" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 26;
        var calcium = 1400;
        var iron = 15;
        var magnesium = 360;
        var phosphorous = 1250;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 9;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1;
        var riboflavin = 1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 65;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs Pregnant checked
    else if (a >= 14 && a <= 18 && p == "Yes" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 28;
        var calcium = 1300;
        var iron = 27;
        var magnesium = 400;
        var phosphorous = 1250;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 12;
        var sellenium = 60;
        var vitarae = 750;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.4;
        var niacin = 18;
        var dietaryfolate = 600;
        var foodfolate = 0;
        var vitb12 = 2.6;
        var vitc = 80;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 14 - 18 yrs Lactating checked
    else if (a >= 14 && a <= 18 && l == "Yes" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 29;
        var calcium = 1300;
        var iron = 10;
        var magnesium = 360;
        var phosphorous = 1250;
        var potassium = 5100;
        var sodium = 2300;
        var zinc = 13;
        var sellenium = 70;
        var vitarae = 1200;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.6;
        var niacin = 17;
        var dietaryfolate = 500;
        var foodfolate = 0;
        var vitb12 = 2.8;
        var vitc = 115;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs Non Pregnant checked
    else if (a >= 19 && a <= 30 && p == "No" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1300;
        var iron = 18;
        var magnesium = 360;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs  Preganant checked
    else if (a >= 19 && a <= 30 && p == "yes" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 28;
        var calcium = 1000;
        var iron = 27;
        var magnesium = 350;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 60;
        var vitarae = 770;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.4;
        var niacin = 18;
        var dietaryfolate = 600;
        var foodfolate = 0;
        var vitb12 = 2.6;
        var vitc = 85;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 19 - 30 yrs  Lactating checked
    else if (a >= 19 && a <= 30 && l == "Yes" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 29;
        var calcium = 1000;
        var iron = 9;
        var magnesium = 310;
        var phosphorous = 700;
        var potassium = 5100;
        var sodium = 2300;
        var zinc = 12;
        var sellenium = 70;
        var vitarae = 1300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.6;
        var niacin = 17;
        var dietaryfolate = 500;
        var foodfolate = 0;
        var vitb12 = 2.8;
        var vitc = 120;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }

    // 31 - 50 yrs Non Pregnant checked
    else if (a >= 31 && a <= 50 && p == "No" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 25;
        var calcium = 1000;
        var iron = 18;
        var magnesium = 320;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 31 - 50 yrs  Pregnant checked
    else if (a >= 31 && a <= 50 && p == "Yes" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 28;
        var calcium = 1000;
        var iron = 7;
        var magnesium = 360;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 2300;
        var zinc = 11;
        var sellenium = 0;
        var vitarae = 770;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.4;
        var niacin = 18;
        var dietaryfolate = 600;
        var foodfolate = 0;
        var vitb12 = 2.6;
        var vitc = 85;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }

    // 31 - 50 yrs  Lactating checked
    else if (a >= 31 && a <= 50 && l == "Yes" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 29;
        var calcium = 1000;
        var iron = 9;
        var magnesium = 310;
        var phosphorous = 700;
        var potassium = 5100;
        var sodium = 2300;
        var zinc = 12;
        var sellenium = 70;
        var vitarae = 1300;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.4;
        var riboflavin = 1.6;
        var niacin = 17;
        var dietaryfolate = 500;
        var foodfolate = 0;
        var vitb12 = 2.8;
        var vitc = 120;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 51 - 70 yrs Non Pregnant checked
    else if (a >= 51 && a <= 70 && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 21;
        var calcium = 1200;
        var iron = 8;
        var magnesium = 320;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 1300;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }
    // 71 - 100 yrs Non pregnant checked
    else if (a >= 71 && a <= 100 && p == "No" && g == "Female") {
        var protein = (eer * protein_const).toFixed(1);
        var fat = (eer * fat_const).toFixed(1);
        var carbohydrate = (eer * carbohydrate_const).toFixed(1);
        var water = (eer * 1).toFixed(1);
        var fibre = 21;
        var calcium = 1200;
        var iron = 8;
        var magnesium = 320;
        var phosphorous = 700;
        var potassium = 4700;
        var sodium = 1200;
        var zinc = 8;
        var sellenium = 55;
        var vitarae = 700;
        var vitare = 0;
        var retinol = 0;
        var bcarotene = 0;
        var thiamin = 1.1;
        var riboflavin = 1.1;
        var niacin = 14;
        var dietaryfolate = 400;
        var foodfolate = 0;
        var vitb12 = 2.4;
        var vitc = 75;
        var cholestrol = 300;
        var oxalicacid = 0;
        var phytate = 0;

    }

    document.getElementById("iom_protein").innerHTML = protein;
    document.getElementById("iom_fat").innerHTML = fat;
    document.getElementById("iom_carbohydrate").innerHTML = carbohydrate;
    document.getElementById("iom_water").innerHTML = water;
    document.getElementById("iom_fibre").innerHTML = fibre;
    document.getElementById("iom_calcium").innerHTML = calcium;
    document.getElementById("iom_iron").innerHTML = iron;
    document.getElementById("iom_magnesium").innerHTML = magnesium;
    document.getElementById("iom_phosphorous").innerHTML = phosphorous;
    document.getElementById("iom_potassium").innerHTML = potassium;
    document.getElementById("iom_sodium").innerHTML = sodium;
    document.getElementById("iom_zinc").innerHTML = zinc;
    document.getElementById("iom_sellenium").innerHTML = sellenium;
    document.getElementById("iom_vitarae").innerHTML = vitarae;
    document.getElementById("iom_vitare").innerHTML = vitare;
    document.getElementById("iom_retinol").innerHTML = retinol;
    document.getElementById("iom_bcarotene").innerHTML = bcarotene;
    document.getElementById("iom_thiamin").innerHTML = thiamin;
    document.getElementById("iom_riboflavin").innerHTML = riboflavin;
    document.getElementById("iom_niacin").innerHTML = niacin;
    document.getElementById("iom_dietaryfolate").innerHTML = dietaryfolate;
    document.getElementById("iom_foodfolate").innerHTML = foodfolate;
    document.getElementById("iom_vitb12").innerHTML = vitb12;
    document.getElementById("iom_vitc").innerHTML = vitc;
    document.getElementById("iom_cholesterol").innerHTML = cholestrol;
    document.getElementById("iom_oxalicacid").innerHTML = oxalicacid;
    document.getElementById("iom_phytate").innerHTML = phytate;

    };

    
</script>

<!-- Save Reference Data -->

<script type="text/javascript">

            $(document).ready(function () {
            $('#save_eer').click(function (e) {
            e.preventDefault();

            var client_ref  = $('#iom_client_id').val();
            var client_tel = $('#iom_clientphone').val();
            var client_name = $('#iom_clientname').val();
            var formula = $('#iom_formula').val();
            var activity_factor = $('#iom_pal').val();
            var energy = $('#iom_energy').text();
            var protein = $('#iom_protein').text();
            var fat = $('#iom_fat').text();
            var carbohydrate = $('#iom_carbohydrate').text();
            var water = $('#iom_water').text();
            var fibre = $('#iom_fibre').text();
            var calcium = $('#iom_calcium').text();
            var iron = $('#iom_iron').text();
            var magnesium = $('#iom_magnesium').text();
            var phosphorous = $('#iom_phosphorous').text();
            var potassium = $('#iom_potassium').text();
            var sodium = $('#iom_sodium').text();
            var zinc = $('#iom_zinc').text();
            var selenium = $('#iom_sellenium').text();
            var vitarae = $('#iom_vitarae').text();
            var vitare = $('#iom_vitare').text();
            var retinol = $('#iom_retinol').text();
            var bcarotene = $('#iom_bcarotene').text();
            var thiamin = $('#iom_thiamin').text();
            var riboflavin = $('#iom_riboflavin').text();
            var niacin = $('#iom_niacin').text();
            var dietaryfolate = $('#iom_dietaryfolate').text();
            var foodfolate = $('#iom_foodfolate').text();
            var vitb12 = $('#iom_vitb12').text();
            var vitc = $('#iom_vitc').text();
            var cholestrol = $('#iom_cholesterol').text();
            var oxalicacid = $('#iom_oxalicacid').text();
            var phytate = $('#iom_phytate').text();
            
            if(activity_factor == '' || energy == ''){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields!!",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "reference_submit.php",
                data: { "client_ref": client_ref, "client_tel": client_tel, "client_name": client_name, "formula": formula, "activity_factor": activity_factor, "energy": energy, "protein": protein, "fat": fat, "carbohydrate": carbohydrate, "water": water, "fibre": fibre, "calcium": calcium, "iron": iron, "magnesium": magnesium, "phosphorous": phosphorous, "potassium": potassium, "sodium": sodium, "zinc": zinc, "selenium": selenium, "vitarae": vitarae, "vitare": vitare, "retinol": retinol, "bcarotene": bcarotene, "thiamin": thiamin, "riboflavin": riboflavin, "niacin": niacin, "dietaryfolate": dietaryfolate, "foodfolate": foodfolate, "vitb12": vitb12, "vitc": vitc, "cholestrol": cholestrol, "oxalicacid": oxalicacid, "phytate": phytate },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#iom-form')[0].reset();

                        swal({
                        text: "Reference Data Saved!!",
                        icon: "success",
                       width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#iom-form')[0].reset();

                        swal({
                        text: "Reference Data Already Exists!!",
                        icon: "warning",
                       width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
</script>

<!-- Save Reference Data -->
<!-- Save Diagnosis -->

<script type="text/javascript">
            $(document).ready(function () {
            $('#save_diagnosis').click(function (e) {
            e.preventDefault();

            var name = $('#client_name').val();
            var phone = $('#client_phone').val();
            var code = $('#client_id').val();
            var problem = $('#problem_statement').val();
            var etiology = $('#etiology').val();
            var symptoms = $('#symptoms').val();
           
            
            if(problem.length == 0 || etiology.length == 0 || symptoms.length == 0){
                swal({
                        //title: "Title",
                        text: "Please Fill All Fields",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "diagnosis_submit.php",
                data: { "name": name, "phone": phone, "code": code, "problem": problem, "etiology": etiology, "symptoms": symptoms },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#problem_statement').val('');
                        $('#etiology').val('');
                        $('#symptoms').val('');

                        swal({
                        text: "Diagnosis Saved!!",
                        icon: "success",
                        width: '200px',
                        timer: 1500
                        });
                    }
                    else if(dataResult.statusCode==201){
                        $('#problem_statement').val('');
                        $('#etiology').val('');
                        $('#symptoms').val('');

                        swal({
                        text: "Similar Diagnosis Already Exists!!",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>
<!-- Save Diagnosis -->


<!-- Save Prescription -->
<script type="text/javascript">
            $(document).ready(function () {
            $('#save_prescription').click(function (e) {
            e.preventDefault();

            var client_refno = $('#client_refno').val();
            var prescription_one = $('#prescription_one').val();
            var prescription_two = $('#prescription_two').val();
            var prescription_three = $('#prescription_three').val();
            var prescription_four = $('#prescription_four').val();
            var prescription_five = $('#prescription_five').val();
            var prescription_six = $('#prescription_six').val();
           
            
            if(prescription_one.length == 0){
                swal({
                        //title: "Title",
                        text: "Provide Atleast One Prescription!",
                        icon: "warning",
                        width: '200px',
                        timer: 1500
                        });
                return false;

            }
            else{
                $.ajax
                ({
                type: "POST",
                url: "prescription_submit.php",
                data: { "client_refno": client_refno,"prescription_one": prescription_one, "prescription_two": prescription_two, "prescription_three": prescription_three, "prescription_four": prescription_four, "prescription_five": prescription_five, "prescription_six": prescription_six },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);

                    if(dataResult.statusCode==200){
                        $('#prescription_one').val('');
                        $('#prescription_two').val('');
                        $('#prescription_three').val('');
                        $('#prescription_four').val('');
                        $('#prescription_five').val('');
                        $('#prescription_six').val('');

                        swal({
                        text: "Prescription Saved!!",
                        icon: "success",
                        width: '200px',
                        timer: 2000
                        });
                    }
                    else if(dataResult.statusCode==201){
                        
                        swal({
                        text: "Client's Prescription Already Exists!!",
                        icon: "warning",
                        width: '200px',
                        timer: 2000
                        });

                    }
                    else if(dataResult.statusCode==202){
                        
                        swal({
                        text: "Client's Prescription Updated!!",
                        icon: "success",
                        width: '200px',
                        timer: 2000
                        });

                    }
                    
                }
                });
            }
            
            });
        });
    </script>

<!-- Save Prescription -->


</html>