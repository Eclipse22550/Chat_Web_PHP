<?php
    class Session {
        public static function init(){
            if (version_compare(phpversion(), '7.2.33', '<')){
                if(session_id() == '') {
                    session_start();

                }
            }else{
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
            }
        }
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }
        public static function destroy(){
            session_destroy();
            session_unset();
            header("Location:login.php");
        }
        public static function CheckSession(){
            if(self::get("login") == TRUE){
                header("Location:index.php");
            }
        }
        public static function CheckLogin(){
            if(self::get("login") == FALSE){
                header("Location:login.php");
            }
        }
    }
?>