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
<div class="dates_sc show" id="dates_sc">
<h3>Ciao</h3>
    <form action="" class="" method="post">
        <?php
            $getUinfo = $chat->getUserInfo(Session::get("user_code"));
            if($getUinfo){
        ?>
            <input type="text" value="<?php echo $getUinfo->username ?>">
            <?php if($getUinfo->bio == '-' || $getUinfo->hobby == '-' || $getUinfo->country == '-' || $getUinfo->state == '-'){ ?>
                <input type="text" value="Nessun dato">
                <input type="text" value="Nessun dato">
                <input type="text" value="Nessun dato">
                <input type="text" value="Nessun dato">
            <?php }else{ ?>
                <input type="text" value="<?php echo $getUinfo->bio ?>">
                <input type="text" value="<?php echo $getUinfo->hobby ?>">
                <input type="text" value="<?php echo $getUinfo->country ?>">
                <input type="text" value="<?php echo $getUinfo->state ?>">
            <?php } ?>
            <?php if($getUinfo->age == '1549'){ ?>
                <input type="text" name="age" value="1549">Nessun dato</input>
            <?php }else{ ?>
                <input type="text" name="age" value="1552">Maggiorenne</inpu>
            <?php } ?>
            <select name="sex">
                <?php if($getUinfo->sex == '1549'){ ?>
                    <option value="1549" selected>Nessun dato</option>
                    <option value="1547">Maschile</option>
                    <option value="1548">Femminile</option>
                <?php }else if($getUinfo->sex == '1547'){ ?>
                    <option value="1547" selected>Maschile</option>
                    <option value="1548">Femminile</option>
                    <option value="1549">Nessun dato</option>
                <?php }else{ ?>
                    <option value="1548" selected>Femminile</option>
                    <option value="1547">Maschile</option>
                    <option value="1549">Nessun dato</option>
                <?php } ?>
            </select>
            <input type="text" value="<?php echo $getUinfo->photo ?>">
            <?php if($getUinfo->type == '1543'){ ?>
                <input type="text" value="1543">Semplice</input>
            <?php }else if($getUinfo->type == '1544'){ ?>
                <input type="text" value="1544">Completa</input>
            <?php }else{ ?>
                <input type="text" value="1545">Custom</input>
            <?php } ?>
            <input type="text" value="<?php echo $getUinfo->vis ?>">
            <input type="text" value="<?php echo $getUinfo->isActive ?>">
            <input type="text" value="<?php echo $getUinfo->roleid ?>">
        <?php } ?>
    </form>
</div>
<?php include 'inc/footer.php'; ?>