<?php
    include 'lib/Database.php';
    include_once 'lib/Session.php';
    
    class Chat{
        private $db;
        public function __construct(){
            $this->db = new Database();
        }
        /*public function formatDate($date){
            $strtime = strotime($date);
            return date('Y-m-d H:i:s', $strtime);
        }*/
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
        public function checkSearch($username){
            $sql = "SELECT username FROM c_search WHERE username = '$username'";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
        /*public function initSession($username){
            $session_code = rand(10, 1000000);
            $sql = "INSERT INTO t_session (session_code, session_name, session_token, session_usercode, session_ip, session_mac, session_localization, session_start, session_end) 
                    VALUES()";
        }*/
        public function checkUsername($username){
            $sql = "SELECT * FROM u_login WHERE username = :username LIMIT 1";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        public function checkActive($username){
            $sql = "SELECT * FROM u_login 
                    WHERE username = :username 
                    and isActive = :isActive 
                    LIMIT 1";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':isActive', 1536);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        public function userRegistrationSemplice($data){
            $user_code = rand(10, 1000000);
            $email = $data['email'];
            $username = $data['username'];
            $password = $data['password'];
            $vis = $data['vis'];

            $checkUsername = $this->checkUsername($username);

            if($email == "" || $username == "" || $password == "" || $vis == "Scegli un origine"){
                $msg = 'Compilare tutti i campi !';
                return $msg;
            }else if($checkUsername == TRUE){
                $msg = 'Username già in uso !';
                return $msg;
            }else if(strlen($username) < 3){
                $msg = 'Username troppo corto, minimo 3 caratteri';
                return $msg;
            }else if(strlen($password) < 5){
                $msg = 'Password troppo cort, minimo 5 caratteri';
                return $msg;
            }else if(!preg_match("#[0-9]+#",$password)){
                $msg = 'La tua password deve contenere almeno un numero';
                return $msg;
            }else if(!preg_match("#[a-z]+#",$password)){
                $msg = 'La tua password deve contenere almeno una lettera';
                return $msg;
            }else if(filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)){
                $msg = 'Formato email non valido';
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
                $stmt->bindValue(':age', 1549);
                $stmt->bindValue(':sex', 1549);
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
                $rsl = $stmt->execute();
                if($rsl == TRUE){
                    $sql1 ="INSERT INTO c_search 
                            (user_code, username, bio, hobby, country, state, age, sex, photo, type, vis, isActive, roleid) 
                            VALUES (:user_code, :username, :bio, :hobby, :country, :state, :age, :sex, :photo, :type, :vis, :isActive, :roleid)";
                    $stmt = $this->db->pdo->prepare($sql1);
                    $stmt->bindValue(':user_code', $user_code);
                    $stmt->bindValue(':username', $username);
                    $stmt->bindValue(':bio', '-');
                    $stmt->bindValue(':hobby', '-');
                    $stmt->bindValue(':country', '-');
                    $stmt->bindValue(':state', '-');
                    $stmt->bindValue(':age', 1549);
                    $stmt->bindValue(':sex', 1549);
                    $stmt->bindValue(':photo', '-');
                    $stmt->bindValue(':type', 1543);
                    $stmt->bindValue(':vis', 1538);
                    $stmt->bindValue(':isActive', 1537);
                    $stmt->bindValue(':roleid', 1540);
                    $rslt1 = $stmt->execute();
                    if($rslt1 == TRUE){
                        /*$receiver = "$email";
                        $subject = "Attivazione";
                        $body = "
                            Congratulazioni!!! Il tuo account è ora creato e attivo.
                            Qui sotto un riepilogo delle tue informazioni:
                            
                            Username: $username
                            Email: $email
                            Tipo di registrazione: semplice

                        ";
                        $sender = "From:angeyimportante780@gmail.com";
                        if(mail($receiver, $subject, $body, $sender)){
                            $email_code = rand(10, 100000);
                            $sql = "INSERT INTO s_email (email_code, receiver, subject, body, sender, mac_adress, ip_adress) 
                                    VALUES (:email_code, :receiver, :subject, :body, :sender, :mac_adress, :ip_adress)";
                            $stmt = $this->db->pdo->prepare($sql);
                            $stmt->bindValue(':email_code', $email_code);
                            $stmt->bindValue(':receiver', $receiver);
                            $stmt->bindValue(':subject', $subject);
                            $stmt->bindValue(':body', $body);
                            $stmt->bindValue(':sender', $sender);
                            $stmt->bindValue(':mac_adress', '15A');
                            $stmt->bindValue(':ip_adress', '192.168.1.20');
                            $rslt5 = $stmt->execute();
                            if($rslt5 == TRUE){*/
                                $msg = 'Utente creato';
                                return $msg;
                            /*}else{
                                $msg = 'Insert 3 fallito';
                                return $msg;
                                exit();
                            }
                        }*/
                    }else{
                        $msg = 'Insert 2 fallito';
                        return $msg;
                    }
                }else{
                    $msg = 'Oops, qualcosa è andato storto';
                    return $msg;
                }
            }
        }
        public function checkCredential($username, $password){
            $password = hash("SHA512", $password);
            $sql = "SELECT * FROM u_login WHERE username = :username and password = :password LIMIT 1";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        public function userLoginAuthotication($data){
            $username = $data['username'];
            $password = $data['password'];

            $checkUsername = $this->checkUsername($username);
            $checkActive = $this->checkActive($username);
            $chekCredential = $this->checkCredential($username, $password);

            if($username == "" || $password == ""){
                $msg = 'Compilare i campi di input';
                return $msg;
            }else if($checkUsername != TRUE){
                $msg = 'Username non trovato';
                return $msg;
            }else{
                if($checkActive == TRUE){
                    $msg = 'Utente disattivato';
                    return $msg;
                }else if($chekCredential){
                    Session::init();
                    Session::set("login", TRUE);
                    Session::set("username", $chekCredential->username);
                    Session::set("warning", $chekCredential->warning);
                    Session::set("checking", $chekCredential->checking);
                    Session::set("msg", 'Hai effettuato il login con successo !');
                    echo "<script>location.href='index.php';</script>";
                }else{
                    $msg = 'Oops, qualcosa è andato storto';
                    return $msg;
                }
            }
        }
    }
?>