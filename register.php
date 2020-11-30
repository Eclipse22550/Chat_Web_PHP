<?php
    include 'inc/header.php';
    Session::CheckSession();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg_sem'])){
        $reg_sem = $chat->userRegistrationSemplice($_POST);
    }

    if(isset($reg_sem)){
        echo $reg_sem;
    }
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
            <input type="email" id="email" name="email" placeholder="Email">
        </div>
        <div class="input">
            <input type="text" name="username" id="username" placeholder="Username">
        </div>
        <div class="input">
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="input hide" id="btn_semplice">
            <button type="submit" name="reg_sem" class="procede-btn">Registrati</button>
        </div>
        <div class="input hide" id="card2-proc">
            <button type="button" class="procede-btn">Continua</button>
        </div>
    </div>
    <div class="card3 hide" id="card3">
        <div class="input hide">
            <input type="text" name="name" placeholder="Nome">
        </div>
        <div class="input hide">
            <input type="text" name="lname" placeholder="Cognome">
        </div>
        <div class="input">
            <input type="text" name="age" placeholder="Età">
        </div>
        <div class="input">
            <input type="text" name="sex" placeholder="Genere*">
        </div>
        <div class="input hide">
            <button type="button" class="procede-btn">Continua</button>
        </div>
    </div>
    <div class="card4 hide" id="card4">
        <div class="input">
            <select name="vis" class="select-box">
                <option value="Scegli un indice">Scegli un indice</option>
                <option value="">Pubblico</option>
                <option value="">Privato></option>
            </select>
        </div>
        <div class="input">
            <button type="submit" name="registers" class="procede-btn">Registrati</button>
        </div>
    </div>
    <div class="card5 hide" id="card5">

    </div>
</form>
<?php include 'inc/footer.php'; ?>