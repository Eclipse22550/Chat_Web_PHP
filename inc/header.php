<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Session.php";
    Session::init();
    spl_autoload_register(function($classes){
        include 'classes/'.$classes.".php";
    });
    $chat = new Chat();

    //if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    //    Session::destroy();
    //}
?>
<html>
<head>
    <title>Chat-App |</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body id="body">
    <?php if(Session::get("login") == TRUE){ ?>
        <div class="l-navbar" id="navbar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <img src="./assets/img/logo.svg" alt="" class="nav__logo-icon">
                        <span class="nav__logo-text">Chat</span>
                    </a>

                    <div class="nav__toggle" id="nav-toggle">
                    <i class="fas fa-chevron-circle-right"></i>
                    </div>

                    <ul class="nav__list">
                        <a href="#" class="nav__link active">
                            <i class="fas fa-comment-dots nav__icon" ></i>
                            <span class="nav__text">Chat</span>
                        </a>
                        <a href="#" class="nav__link">
                            <i class="fas fa-sim-card nav__icon" ></i>
                            <span class="nav__text">Post</span>
                        </a>
                        <a href="#" class="nav__link">
                            <i class="fas fa-id-badge nav__icon " ></i>
                            <span class="nav__text">Profilo</span>
                        </a>
                        <a href="settings.php" class="nav__link">
                            <i class="fas fa-sliders-h nav__icon" ></i>
                            <span class="nav__text">Impostazioni</span>
                        </a>                 
                    </ul>
                </div>
                <a class="nav__link">           
                    <i class="fas fa-sign-out-alt nav__icon"></i>
                    <span class="nav__text">Logout</span>
                </a>
            </nav>
        </div>
    <?php } ?>
    