<!-- Header Included Here -->
<?php include 'includes/header.php' ?>

<div class="row" id="login_row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card" id="login_card">
            <div class="card-body" id="login_card_body">
                    <!-- Error Reporting Included Here -->
                    <?php include 'includes/errors.php' ?>

                    <img id="login_img" src="assets/img/logo.png">
                    <h4 class="card-title">Login</h4>
                    <form method="post" action="classes/login">
                        <div class="form-group" id="login_form_group">
                            <input type="email" class="form-control input-pill" name="email" id="email" placeholder="Enter Username...">
                        </div>
                        <div class="form-group" id="login_form_group">
                            <input type="password" class="form-control input-pill" name="password" id="password" placeholder="Enter Password...">
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit" name="login">Log In</button>
                        </div>
                    </form>
                    <div><a href ="reset_password">Forgot Password? Reset Here..</a></div>
                    

            </div>
        </div>
    </div>
</div>

<!-- Footer Included Here -->
<?php include 'includes/footer.php' ?>	