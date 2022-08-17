<?php
    /* require_once 'db/db-conn.php';
    $salt='@PLDtOO#';
    $p=$salt."@changee";
    echo password_hash($p, PASSWORD_DEFAULT);
    $stmt=$conn->prepare("INSERT INTO users(user_id, uname, pass, email) VALUES(:user_id, :uname, :pass, :email)");
    $stmt->execute(array(
        ':user_id'=>1,
        ':uname'=>'amun',
        ':pass'=>'$2y$10$oVIzWPVCH5vhUkichYU3dOkUkFNA7oGY1Si6IRtVWhb6dIlPP8cjS',
        ':email'=>'amunpote@gmail.com'
    )); */
    require_once 'db/db-conn.php';
    $stmt=$conn->prepare("UPDATE company SET company_name='aa' WHERE company_id='aa'");
    /* $stmt->execute(array(
        ':cname'=>"test"
    )); */
    
    $stmt->execute();
    if($stmt){
        echo "error";
    }
?>