<!-- --><!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Login and Registration Form with HTML5 and CSS3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <meta name="author" content="Codrops" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
</head>
<body>
<div class="container">
    <!-- Codrops top bar -->
    <div class="codrops-top">
        <div class="clr"></div>
    </div><!--/ Codrops top bar -->
    <header>
        <h1><span>Welcome! Please register to gain full access to all of our features</span></h1>
    </header>
    <section>
        <div id="container_demo" >
            <div id="wrapper">
                <div id="register" class="animate form">
                    <form method="post" name="regForm">
                        <h1> Sign up </h1>
                        <p>
                            <label for="username"></label>
                            <input type = "text" id = "username" name = "username" required="required" placeholder="Username" />
                        </p>
                        <p>
                            <label for="password"></label>
                            <input type = "password" name = "password" id = "password" placeholder="Password" />
                        </p>
                        <p>
                            <label for="password"></label>
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" />
                        </p>
                        <p>
                            <label for="username"></label>
                            <input type="text" name="fullName" id="fullName" placeholder="Full Name" />
                        </p>
                        <p class="signin button">
                            <input type="submit" value="Register"/>
                        </p>
                        <p class="change_link">
                            Already a member ?
                            <a href = "<?=APP_ROOT?>/users/login">Login</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
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
            alert("Passwords do not match!");
            return false;
        }
        else {
            return true;
        }
    }
</script>