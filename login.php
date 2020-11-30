<?php 
    include 'inc/header.php'; 
    Session::CheckSession();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $userLog = $chat->userLoginAuthotication($_POST);
    }

    if(isset($userLog)){
        echo $userLog;
    }

    $logMsg = Session::get('logMsg');
    if (isset($logMsg)) {
      echo $logMsg;
    }
    $msg = Session::get('msg');
    if (isset($msg)) {
      echo $msg;
    }
    Session::set("msg", NULL);
    Session::set("logMsg", NULL);

    $logout = Session::get('logout');
    if(isset($logout)){
        echo $logout;
    }
?>
<link rel="stylesheet" href="./assets/style/form.css">
<form action="" method="post" name="login">
    <div class="fields">
        <input type="text" name="username" placeholder="Username">
    </div>
    <div class="fields">
        <input type="password" name="password" placeholder="Password">
        <p></p>
        <input type="checkbox" name="rem[]" value="1"> Ricordati di me</input>
    </div>
    <div class="fields">
        <p></p>
        <p></p>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
        <p></p>
        <button type="submit" class="login" name="login">Accedi</button>
    </div>
    <a href="register.php">Registrati</a>
</form>
<?php include 'inc/footer.php'; ?>