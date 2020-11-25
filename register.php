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
  <div class="container show" id="scelta">
    <header>Tipologia</header>
    <button class="scope-btn" name="scope" value="1515" id="semplice">Semplice</button>
            <button class="scope-btn" name="scope" value="1616" id="completo">Completo</button>
            <button class="scope-btn" name="scope" value="1717" id="customiz">Personalizzata</button>
  </div>
  <div class="container hide" id="container">
    <header>Registrati</header>
    <div class="progress-bar">
      <div class="step">
        <p>Name</p>
        <div class="bullet">
          <span>1</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
      <div class="step">
        <p>Contact</p>
        <div class="bullet">
          <span>2</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
      <div class="step">
        <p>Birth</p>
        <div class="bullet">
          <span>3</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
      <div class="step">
        <p>Submit</p>
        <div class="bullet">
          <span>4</span>
        </div>
        <div class="check fas fa-check"></div>
      </div>
    </div>
    <div class="form-outer">
      <form action="#">
        <div class="page slide-page hide" id="page slde">
          <div class="title">Dati utenti:</div>
          <div class="field">
            <div class="label">Username</div>
            <input type="text" name="username">
          </div>
          <div class="field">
            <div class="label">Password</div>
            <input type="password" name="password">
          </div>
          <div class="field">
            <div class="label">Email</div>
            <input type="email" name="email">
          </div>
          <div class="field hide" id="proc2">
            <button type="submit" name="reg_sem" class="next hide" id="nxt_proc2">Termina</button>
          </div>
          <div class="field hide" id="proc1">
            <button class="firstNext next hide" id="nxt_proc1">Next</button>
          </div>
        </div>
        <div class="page">
          <div class="title">Contact Info:</div>
          <div class="field">
            <div class="label">Email Address</div>
            <input type="text">
          </div>
          <div class="field">
            <div class="label">Phone Number</div>
            <input type="Number">
          </div>
          <div class="field btns">
            <button class="prev-1 prev">Previous</button>
            <button class="next-1 next">Next</button>
          </div>
        </div>
        <div class="page">
          <div class="title">Date of Birth:</div>
          <div class="field">
            <div class="label">Date</div>
            <input type="text">
          </div>
          <div class="field">
            <div class="label">Gender</div>
            <select>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
          </div>
          <div class="field btns">
            <button class="prev-2 prev">Previous</button>
            <button class="next-2 next">Next</button>
          </div>
        </div>
        <div class="page">
          <div class="title">Login Details:</div>
          <div class="field">
            <div class="label">Username</div>
            <input type="text">
          </div>
          <div class="field">
            <div class="label">Password</div>
            <input type="password">
          </div>
          <div class="field btns">
            <button class="prev-3 prev">Previous</button>
            <button class="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<!--<form action="" method="post" action="" name="register" id="register">
    <div class="card1 show" id="card1">
        <div class="input">
            <button class="scope-btn" name="scope" value="1515" id="semplice">Semplice</button>
            <button class="scope-btn" name="scope" value="1616" id="completo">Completo</button>
            <button class="scope-btn" name="scope" value="1717" id="customiz">Personalizzata</button>
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
</form>!-->
<?php include 'inc/footer.php'; ?>