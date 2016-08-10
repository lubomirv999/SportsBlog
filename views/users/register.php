<?php $this->title = 'Register New User'; ?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<form method="post" name="regForm">
    <div><label for="username">Username:</label></div>
    <input type = "text" id = "username" name = "username" />
    <div><label for="password">Password:</label></div>
    <input type = "password" name = "password" id = "password" >
    <div><label for="password">Confirm password: </label></div>
    <input type="password" name="confirmPassword" id="confirmPassword">
    <div><label for="username">Full name:</label></div>
    <input type="text" name="fullName" id="fullName">
    <div><input type="submit" value="Register"/>
        <a href = "<?=APP_ROOT?>/users/login">[Go To Login]</a>
    </div>
</form>
<script>
        $("form[name='regForm']").submit(function(event) {
            if (!passwordValidation()) {
                event.preventDefault();
            }
        });
        function passwordValidation(){
            var password = document.getElementById('password').value;
            var confirmPass = document.getElementById('confirmPassword').value;
            if (password!=confirmPass){
                alert("Passwords do not match!")
                return false;
            }
            else {
                return true;
    }
}
</script>
<!-- -->