<?php
    include 'inc/header.php';
    Session::CheckSession();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg_sem'])){
        $reg_sem = $chat->userRegistrationSemplice($_POST);
    }

    if(isset($reg_sem)){
        echo $reg_sem;
    }

    /*if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_completo'])){
        $register_completo = $chat->userRegistrationCompleto($_POST);
    }

    if(isset($register_completo)){
        echo $register_completo;
    }*/
?>
<link rel="stylesheet" href="./assets/style/form.css">
<form action="" method="post" action="" name="register" id="register">
    <div class="card1 show" id="card1">
        <div class="input">
            <button class="scope-btn" name="scope" id="semplice">Semplice</button>
            <button class="scope-btn" name="scope" id="completo">Completo</button>
            <button class="scope-btn" name="scope" id="customiz">Personalizzata</button>
        </div>
    </div>
    <div class="card2 hide" id="card2">
        <div class="input">
            <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="input">
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>
        <div class="input">
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="input hide" id="card2-proc">
            <button type="button" class="procede-btn">Continua</button>
        </div>
    </div>
    <div class="card3 hide" id="card3">
        <div class="input">
            <input type="text" name="name" placeholder="Nome">
        </div>
        <div class="input">
            <input type="text" name="lname" placeholder="Cognome">
        </div>
        <div class="input">
            <input type="text" name="age" placeholder="Età">
        </div>
        <div class="input">
            <select name="sex">
                <option value="Scegli un origine">Scegli un origine</option>
                <option value="1547">Maschile</option>
                <option value="1548">Femminile</option>
                <option value="1546">Non definito</option>
            </select>
        </div>
        <div class="input">
            <button type="button" class="procede-btn">Continua</button>
        </div>
    </div>
    <div class="card4 hide" id="card4">
        <div class="input">
            <select name="vis" class="select-box">
                <option value="Scegli una visibilita">Scegli una visibilità</option>
                <option value="1538">Pubblico</option>
                <option value="1539">Privato</option>
            </select>
        </div>
        <div class="input">
            <button type="submit" id="reg_sem" name="reg_sem" class="procede-btn hide">Registrati</button>
            <button type="submit" id="" name="reg_sem" class="procede-btn hide">RegiTTtrati</button>
        </div>
    </div>
    <div class="card5 hide" id="card5">

    </div>
</form>
<a href="login.php">Login</a>
<?php include 'inc/footer.php'; ?>