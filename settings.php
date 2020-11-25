<?php
    include 'inc/header.php';
    Session::CheckLogin();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_simply'])){
        $updateLog = $chat->updateUserDataSimply($_POST);
    }
?>
<link rel="stylesheet" href="./assets/style/index.css">
<?php if(Session::get("login") == TRUE){ ?>
    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <a href="#" class="nav__logo">
                    <img src="./assets/img/logo.svg" alt="" class="nav__logo-icon">
                    <span class="nav__logo-text">Impostazioni</span>
                </a>
                <div class="nav__toggle" id="nav-toggle">
                <i class="fas fa-chevron-circle-right"></i>
                </div>
                <ul class="nav__list">
                    <a href="index.php" class="nav__link active">
                        <i class="fas fa-comment-dots nav__icon" ></i>
                        <span class="nav__text">Chat</span>
                    </a>
                    <a id="dates" class="nav__link">
                        <i class="fas fa-user nav__icon" ></i>
                        <span class="nav__text">Dati</span>
                    </a>
                    <a href="#" class="nav__link">
                        <i class="fas fa-id-badge nav__icon " ></i>
                        <span class="nav__text"></span>
                    </a>
                    <a href="#" class="nav__link">
                        <i class="fas fa-sliders-h nav__icon" ></i>
                        <span class="nav__text"></span>
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
<div class="dates_sc hide" id="dates_sc">
<h3>Ciao</h3>
    <form action="" class="" method="post">
        <?php
            $getUinfo = $chat->getUserInfo();
            if($getUinfo){
        ?>
            <input type="text" value="<?php echo $getUinfo->username ?>">
        <?php } ?>
    </form>
</div>
<?php include 'inc/footer.php'; ?>