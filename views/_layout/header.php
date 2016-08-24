<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="<?=APP_ROOT?>/content/scripts/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="<?=APP_ROOT?>/content/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="<?=APP_ROOT?>/content/ie8.css" /><![endif]-->
    <link rel="icon" href="<?=APP_ROOT?>/content/images/favicon.ico" />
    <script src="<?=APP_ROOT?>/content/scripts/jquery-3.0.0.min.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/blog-scripts.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/jquery.min.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/jquery.dropotron.min.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/skel.min.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/util.js"></script>
    <!--[if lte IE 8]><script src="<?=APP_ROOT?>/content/scripts/respond.min.js"></script><![endif]-->
    <script src="<?=APP_ROOT?>/content/scripts/main.js"></script>
    <title><?php if (isset($this->title)) echo htmlspecialchars($this->title) ?></title>
</head>

<body class="homepage">
    <div id="page-wrapper">
        <div id="header-wrapper">
        <header id="header" class="container">

            <!-- Logo -->
            <div id="logo">
                <a href="<?=APP_ROOT?>"><img src="<?=APP_ROOT?>/content/images/site-logo.png"></a>

                <!-- TODO: FIX THE GREETING POSITION -->
                <?php if ($this->isLoggedIn) : ?>
                    <span>Hello, <b><a href="<?=APP_ROOT?>/team"><?=htmlspecialchars($_SESSION['username'])?></a></b></span>
                <?php endif; ?>

            </div>

            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <!-- TODO: <li class="current"> -->
                    <li><a href="<?=APP_ROOT?>/">Home</a></li>
                    <?php if ($this->isLoggedIn) : ?>
                        <li><a href="<?=APP_ROOT?>/posts">Posts</a></li>
                        <li><a href="<?=APP_ROOT?>/posts/create">Create Post</a></li>
                        <li><a href="<?=APP_ROOT?>/users">Users</a></li>
                        <li><a href="<?=APP_ROOT?>/contact/send">Contact</a></li>
                        <li><a href="<?=APP_ROOT?>/users/logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?=APP_ROOT?>/users/login">Login</a></li>
                        <li><a href="<?=APP_ROOT?>/users/register">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>


        </header>
    </div>


<?php require_once('show-notify-messages.php'); ?>
