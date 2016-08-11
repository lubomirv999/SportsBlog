<?php $this->title = 'Login'; ?>

<h1><?= htmlspecialchars($this->title) ?></h1>

<form method="post">
    <div><label for="username">Username:</label></div>
    <input type = "text" id = "username" name = "username" />
    <div><label for="password">Password:</label></div>
    <input type = "password" name = "password" id = "password" >
    <div><input type="submit" value="Login"></div>
    <div>New here? <a href="<?=APP_ROOT ?>/users/register">Sign up!</a></div>
</form>