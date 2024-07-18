</body>
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/ready.min.js"></script>
    <script src="assets/js/demo.js"></script>

    
    <!-- Additional Javascript -->
    
    <script>
         setTimeout (function(){
           //closing the alert
           $('.alert').alert('close');
       }, 3000);
    </script>

    <script>
        // Select elements
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const passwordMessage = document.getElementById('passwordMessage');
        const confirmMessage = document.getElementById('confirmMessage');
        const submitButton = document.getElementById('newpassword');

        // Function to validate password
        function validatePassword() {
            const password = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Password rules
            const lengthValid = password.length >= 6;
            const hasNumber = /\d/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasUpperCase = /[A-Z]/.test(password);
            const hasSpecialChar = /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password);

            // Display password rules
            if (password.length > 0) {
                passwordMessage.innerHTML = '';
                if (lengthValid) passwordMessage.innerHTML += '<small style="color: green;">Minimum 6 characters</small><br>';
                else passwordMessage.innerHTML += '<small>Minimum 6 characters</small><br>';

                if (hasNumber) passwordMessage.innerHTML += '<small style="color: green;">Contains a number</small><br>';
                else passwordMessage.innerHTML += '<small>Contains a number</small><br>';

                if (hasLowerCase && hasUpperCase) passwordMessage.innerHTML += '<small style="color: green;">Contains lowercase and uppercase letters</small><br>';
                else passwordMessage.innerHTML += '<small>Contains lowercase and uppercase letters</small><br>';

                if (hasSpecialChar) passwordMessage.innerHTML += '<small style="color: green;">Contains a special character</small><br>';
                else passwordMessage.innerHTML += '<small>Contains a special character</small><br>';
            } else {
                passwordMessage.innerHTML = '';
            }

            // Validate password match
            if (confirmPassword.length > 0) {
                if (password === confirmPassword) {
                    confirmMessage.innerHTML = '<small style="color: green;">Passwords match</small>';
                } else {
                    confirmMessage.innerHTML = '<small>Passwords do not match</small>';
                }
            } else {
                confirmMessage.innerHTML = '';
            }

            // Enable/disable submit button
            if (password === confirmPassword && password.length > 0) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

    </script>

</html>