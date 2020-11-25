<?php
    include 'lib/Database.php';
    include_once 'lib/Session.php';
    
    class Chat{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }
        //Funzione formato della data
        public function formatDate($date){
            $strtime = strotime($date);
            return date('Y-m-d H:i:s', $strtime);
        }
        //Funzione per verificare se l'email è già in uso
        //Argomenti: "email"
        public function checkEmail($email){
            $sql = "SELECT email FROM u_login WHERE email = :email";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
        //Funczione per controllare se l'utente è ricercabile nel sistema
        //Argomenti: "username"
        public function checkSearch($username){
            $sql = "SELECT username FROM c_search WHERE username = :username";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per controllare le duplicità utente
        //Argomenti: "username"
        public function checkUsername($username){
            $sql = "SELECT username FROM u_login WHERE username = :username";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        //Funzione per controllare le duplicità utente guest
        //Argomenti: "username"
        public function checkGuest($username){
            $sql = "SELECT username FROM u_guest WHERE username = :username AND isActive = 1";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        //Funczione per controllare lo stato dell'utente
        //Argomenti: "username"
        public function checkActive($username){
            $sql = "SELECT username FROM u_login WHERE username = :username AND isActive = :isActive";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':isActive', 1536);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        //Funzione per registrare utenti
        public function userRegistrationSemplice($data){
            $user_code = rand(10, 1000000);
            $username = $data['username'];
            $password = $data['password'];
            $email = $data['email'];
            
            $checkEmail = $this->checkEmail($email);
            $checkUsername = $this->checkUsername($username);

            if($email == "" || $username == "" || $password == ""){
                $msg = 'Compilare tutti i campi di input !';
                return $msg;
            }else if(strlen($username) <= 3){
                $msg = 'Username troppo corto, minimo tre caratteri';
                return $msg;
            }else if(strlen($password) < 5){
                $msg = 'Password troppo corta, minimo 5 caratteri';
                return $msg;
            }else if(!preg_match("#[0-9]+#",$password)){
                $msg = 'La tua password deve contenere almeno un numero';
                return $msg;
            }else if(!preg_match("#[a-z]+#",$password)){
                $msg = 'La tua password deve contenere almeno una lettera';
                return $msg;
            }else if(filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)){
                $msg = 'Inidrizzo email non valido';
                return $msg;
            }else if($checkEmail == TRUE){
                $msg = 'Email già registrata!';
                return $msg;
            }else if($checkUsername == TRUE){
                $msg = 'Username già in uso !';
                return $msg;
            }else{
                $sql = "INSERT INTO u_login (user_code, username, password, email, name, lname, age, sex, country, state, bio, hobby, photo, isActive, roleid, vis, checking, type, status) 
                        VALUES(:user_code, :username, :password, :email, :name, :lname, :age, :sex, :country, :state, :bio, :hobby, :photo, :isActive, :roleid, :vis, :checking, :type, :status)";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindValue(':user_code', $user_code);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', hash("SHA512", $password));
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':name', '-');
                $stmt->bindValue(':lname', '-');
                $stmt->bindValue(':age', 0);
                $stmt->bindValue(':sex', 1546);
                $stmt->bindValue(':country', '-');
                $stmt->bindValue(':state', '-');
                $stmt->bindValue(':bio', '-');
                $stmt->bindValue(':hobby', '-');
                $stmt->bindValue(':photo', '-');
                $stmt->bindValue(':isActive', 1537);
                $stmt->bindValue(':roleid', 1540);
                $stmt->bindValue(':vis', 1538);
                $stmt->bindValue(':checking', 0);
                $stmt->bindValue(':type', 1543);
                $stmt->bindValue(':status', '-');
                $result = $stmt->execute();
                if($result){
                    Session::init();
                    Session::set('logMsg', 'Utente semplice creato');
                    echo "<script>location.href='login.php';</script>";
                }else{
                    $msg = 'Problemi con la registrazione';
                    return $msg;
                }
            }
        }
        //Funzione per inviare email
        //Argomenti richiesti: "email, subject, body, sender, mac, ip"
        public function sendEmail($email,$subject,$body,$sender,$mac,$ip){
            $email_code = rand(10, 10000000);
            $sql = "INSERT INTO email (email_code, receiver, subject, body, sender, mac_adress, ip_adress) 
                    VALUES(:email_code, :receiver, :subject, :body, :sender, :mac_adress, :ip_adress)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':email_code', $email_code);
            $stmt->bindValue(':receiver', $email);
            $stmt->bindValue(':subject', $subject);
            $stmt->bindValue(':body', $body);
            $stmt->bindValue(':sender', 'angeyimportante780@gmail.com');
            $stmt->bindValue(':mac_adress', $mac);
            $stmt->bindValue(':ip_adress', $ip);
            $result = $stmt->execute();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per il login degli utenti in visita
        public function loginGuest($data){
            //
        }
        //Funzione per chiudere la sessione di navigazione
        //Argomenti: "state" || funzioni interne: "date("h:i", time())"
        public function updateCloseState($state){
            $sql = "UPDATE u_login SET logout_at = :date AND status = :state WHERE user_code = :user_code";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':date', date("h:i", time()));
            $stmt->bindValue(':state', $state);
            $stmt->bindValue(':user_code', Session::get("user_code"));
            $result = $stmt->execute();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per aprire la sessione di navigazione
        //Argomenti: "state" || funzioni interne: "date("h:i", time())"
        public function updateOpenState($state){
            $sql = "UPDATE u_login SET login_at = :date AND status = :state WHERE user_code = :user_code";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':date', date("h:i", time()));
            $stmt->bindValue(':state', $state);
            $stmt->bindValue(':user_code', Session::get("user_code"));
            $result = $stmt->execute();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per disabilitare l'utente guest dopo un utilizzo
        public function disableGuest($guest_code){
            $sql = "UPDATE u_guest SET isActive = :isActive WHERE guest_code = :code";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':code', $guest_code);
            $result = $stmt->execute();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per verificare i dati di accesso
        //Argomenti: "username || password"
        public function checkCredential($username, $password){
            $password = hash("SHA512", $password);
            $sql = "SELECT username, password FROM u_login WHERE username = :username AND password = :password";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $result = $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        //Funzione per mettere l'online
        //Argomenti: "username"
        public function onlineStatus($username){
            $sql = "UPDATE u_login SET login_at = :login_at, logout_at = :logout_at, status = :status WHERE username = :username";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':login_at', date("h:m:s", time()));
            $stmt->bindValue(':logout_at', '00:00:00');
            $stmt->bindValue(':status', 'online');
            $stmt->bindValue(':username', $username);
            $result = $stmt->execute();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per mettere l'offline
        public function offlineStatus($data){
            $sql="UPDATE u_login SET status = :status, logout_at = :logout_at WHERE username = :username";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':status', 'offline');
            $stmt->bindValue(':logout_at', date("h:m", time()));
            $stmt->bindValue(':username', Session::get("username"));
            $result = $stmt->execute();
            if($result){
                return true;
            }else{
                return false;
            }
        }
        //Funzione per il login utente registrato
        public function userLoginAuthotication($data){
            $username = $data['username'];
            $password = $data['password'];

            $checkUsername = $this->checkUsername($username);
            $checkActive = $this->checkActive($username);
            $checkCredential = $this->checkCredential($username, $password);
            $online = $this->onlineStatus($username);

            if($username == "" || $password == ""){
                $msg = 'Compilare tutti i campi !';
                return $msg;
            }else if(strlen($username) < 3){
                $msg = 'Username troppo corto, minimo 3 caratteri !';
                return $msg;
            }else if($checkUsername == FALSE){
                $msg = 'Username non trovato !';
                return $msg;
            }else if($checkActive == TRUE){
                $msg = 'Il tuo account è stato temporaneamente disabilitato !';
                return $msg;
            }else{
                if($checkCredential == TRUE || $online != TRUE){
                    Session::init();
                    Session::set('login', TRUE);
                    Session::set('user_code', $checkCredential->user_code);
                    Session::set('username', $checkCredential->username);
                    Session::set('status', $checkCredential->status);
                    Session::set('sex', $checkCredential->sex);
                    Session::set('type', $checkCredential->type);
                    Session::set('msg', 'Hai effettuato il login con successo');
                    echo "<script>location.href='index.php';</script>";
                }else{
                    $msg = 'Username o password errati';
                    return $msg;
                }
            }
        }
        //Funzione per il login guest
        public function userGuestLoginAuthotication($data){
            $username = $data['username'];
            $guest_code = rand(10, 1000000);

            $checkUsername = $this->checkUsername($username);
            $checkGuest = $this->checkGuest($username);

            if($username == "" || $password == ""){
                $msg = 'Compilare i campi di input';
                return $msg;
            }else if($checkUsername == TRUE || $checkGuest == TRUE){
                $msg = 'Nome utente già in uso';
                return $msg;
            }else{
                $sql = "INSERT INTO u_guest(guest_code, username, isActive, type, login_at, status) 
                        VALUES(:guest_code, :username, :isActive, :type :login_at, :status)";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindValue(':guest_code', $guest_code);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':isActive', 1537);
                $stmt->bindValue(':type', 1);
                $stmt->bindValue(':login_at', date("h:i", time()));
                $stmt->bindValue(':status', 'online');
                $result = $stmt->execute();
                if($result){
                    Session::init();
                    Session::set('login', TRUE);
                    Session::set('username', $result->username);
                    Session::set('type', $result->type);
                    Session::set('status', $result->status);
                    Session::set('msg', 'Hai effettuato il login con successo');
                    echo "<script>location.href='index.php';</script>";
                }else{
                    $msg = 'Qualcosa è andato storto';
                    return $msg;
                }
            }
        }
        //Funzione per aggiornare i dati utente
        public function updateUserDataSimply($data){

        }
        //Funzione per vedere i dati utente
        public function getUserInfo($username){
            $sql = "SELECT * FROM u_login WHERE username = :username LIMIT 1";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }
?>