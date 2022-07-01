<?php 
    session_start();
    require_once '../db/db-conn.php';
    include '../utils.php';
    //debug($_POST);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $uname=trim($_POST['uname']);
        $salt='@PLDtOO#';
        $upass=$salt.trim($_POST['upass']);
        if(isset($_POST, $uname, $upass) && !empty($uname) && !empty($upass)){
            $stmt=$conn->prepare("SELECT user_id, uname, pass, email from users");
            $stmt->execute();
            $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
            //debug($row);
            foreach($row as $arr){
                foreach($arr as $key=>$data){
                    $id=$arr['user_id'];
                    if($arr['uname'] == $uname && password_verify($upass, $arr['pass'])){
                        $_SESSION['user_logged_in']='Logged_in';
                        $_SESSION['userData']=array(
                            'uname'=>$arr['uname'],
                            'email'=>$arr['email']
                        );
                        header('location: ../view/dashboard.php?uid='.$id);
                        exit;
                    }
                }
            }
            $_SESSION['error']="Invalid credentials!";
            header('location: login.php');
            exit;
            
        }
        else{
            header('location: login.php');
            exit;
        }
    }
    else{
        header('location: login.php');
        exit;
    }
?>
