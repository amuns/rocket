<?php 
   /*  session_start();
    require '../db/db-conn.php';
    require '../utils.php';
    date_default_timezone_set('Asia/Kathmandu');
    if(!isset($_SESSION['user_logged_in'], $_SESSION['userData'])){
      $_SESSION['error']="Please Log in!";
      header('location: ../auth/login.php');
      exit;
    }

    if(isset($_POST, $_POST['checkqty'])){
        $stmt3=$conn->query("SELECT product_name, quantity from invoice");
        $row=$stmt3->fetchAll(PDO::FETCH_ASSOC);
        $pname="";
        try {
            foreach ($row as $rows) {
                $pname=$rows['product_name'];
                $qty=$rows['quantity'];
                $stmt4=$conn->prepare("UPDATE products SET quantity=quantity-$qty WHERE product_name='$pname'");
                $stmt4->execute();
            }
        } 
        catch (\Throwable $th) {
            $stmt=$conn->query("SELECT quantity from products WHERE product_name='$pname'");
            $productrow=$stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['error']="Product: ".$pname.". Only: ".$productrow['quantity']." available!";
            header("location: dashboard.php?uid=".$_GET['uid']);
            exit;
        }
    } */
?>