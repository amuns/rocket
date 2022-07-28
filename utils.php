<?php 
    session_start();
    function debug($string){
        echo "<pre>";
        print_r($string);
        echo "</pre>";
    }

    function flashMessages(){
        if($_SESSION['success'] && !empty($_SESSION['success'])){
            echo "<span style='color: green'>".$_SESSION['success']."</span>";
            unset($_SESSION['success']);
        }

        if($_SESSION['error'] && !empty($_SESSION['error'])){
            echo "<span style='color: red'>".$_SESSION['error']."</span>";
            unset($_SESSION['error']);
        }
    }

    function validate($str){
        trim($str);
        htmlentities($str);
        htmlspecialchars($str);
        return $str;
    }
?>