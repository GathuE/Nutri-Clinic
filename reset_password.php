<!-- Header Included Here -->
<?php include 'includes/header.php' ?>

<div class="row" id="login_row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card" id="login_card">
            <div class="card-body" id="login_card_body">
                    <!-- Error Reporting Included Here -->
                    <?php include 'includes/errors.php' ?>

                    <img id="login_img" src="assets/img/logo.png">
                    <h4 class="card-title">Reset Your Password</h4>
                    <br>
                    <form method="post" action="classes/reset_password">
                        <div class="form-group">
                            <label for=""><b>Role:</b></label>
                            <div class="col-md-12 p-0">
                                <select class="form-control input-pill" id="staffrole" name="staffrole" required>
                                    <option value="">Choose User Role..</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Receptionist">Receptionist</option>
                                    <option value="Nutritionist">Nutritionist</option>
                                </select>
                            </div>
                            <span class="input_error" id="role_error"></span>
                        </div>
                        <div>
                            <label for=""><b>Choose your Security Question:</b></label>
                            <div class="form-group" id="login_form_group">
                                <select class="form-control input-pill" id="security_question" name="security_question">
                                    <option value="">Please select your security question..</option>
                                    <option value="1">What is your Favourite Food?</option>
                                    <option value="2">What is your Favourite Drink?</option>
                                    <option value="3">What is your Favourite Fruit?</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="login_form_group">
                                <input type="text" class="form-control input-pill" name="security_answer" id="security_answer" placeholder="Answer to the Security Question...">
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit" name="resetpassword">Reset Password</button>
                        </div>
                    </form>
                    <div><a href ="index">Login Here</a></div>
                    

            </div>
        </div>
    </div>
</div>

<!-- Footer Included Here -->
<?php include 'includes/footer.php' ?>	