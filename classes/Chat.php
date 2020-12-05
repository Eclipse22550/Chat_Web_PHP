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
            $user_code = rand(10, 892561);
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

                $sql = "INSERT INTO u_login (user_code, username, password, email, name, lname, age, sex, country, state, bio, hobby, photo, isActive, roleid, vis, type, status) 
                        VALUES(:user_code, :username, :password, :email, :name, :lname, :age, :sex, :country, :state, :bio, :hobby, :photo, :isActive, :roleid, :vis, :type, :status)";
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
                $stmt->bindValue(':type', 1543);
                $stmt->bindValue(':status', '-');
                $rsl = $stmt->execute();
                if($rsl == TRUE){
                    $msg = 'Utente creato';
                    return $msg;
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
            }else if($chekCredential != TRUE){
                $msg = 'Username o password errati !';
                return $msg;
                $cnt = 0;
                $cnt++;
                if($cnt == 3){
                    echo "<script>location.href='reset.php';</script>";
                }
            }else{
                if($checkActive == TRUE){
                    $msg = 'Utente disattivato';
                    return $msg;
                }else if($chekCredential){
                    Session::init();
                    Session::set("login", TRUE);
                    Session::set("user_code", $chekCredential->user_code);
                    Session::set("username", $chekCredential->username);
                    Session::set("msg", 'Hai effettuato il login con successo !');
                    echo "<script>location.href='index.php';</script>";
                }else{
                    $msg = 'Oops, qualcosa è andato storto';
                    return $msg;
                }
            }
        }
        public function Search($data){
            $input = $data['input'];

            if($input == ""){
                $msg = 'Inserire un dato valido !';
                return $msg;
            }else{
                $result = $this->Result($input);
                if($result == []){
                    $msg = 'Nessun riscontro';
                    return $msg;
                }else{
                    return $result;
                }
            }
        }
        public function Result($input){
            $username = Session::get("username");
            $sql = "SELECT  username
            FROM            c_search 
            WHERE           username 
            LIKE            '%$input%' 
            AND NOT         username = '$username'";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        public function getUserInfo($user_code){
            $sql = "SELECT  * 
                    FROM    c_search 
                    WHERE   user_code = :user_code 
                    LIMIT   1";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':user_code', $user_code);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result;
            }else{
                return false;
            }
        }
        public function updateUserDataSimply(){

        }
        public function TranslateCode($sex, $type, $vis, $isActive, $roleid){
            $sql = "SELECT  c.sex, c.type, c.vis, c.isActive, c.roleid, m.code, m.name 
                    FROM    c_search c, m_coder m
                    WHERE   c.sex = '$sex'
                    AND     c.type = '$type'
                    AND     c.vis = '$vis'
                    AND     c.isActive = '$isActive'
                    AND     c.roleid = '$roleid'";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result) {
                return $result;
            }else{
                return false;
            }
        }
    }
?>