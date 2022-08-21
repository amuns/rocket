<?php
    session_start();
    require '../db/db-conn.php';
    require '../utils.php';

    $uid=$_GET['uid'];
    $invoice=$_GET['invoice'];

    if(isset($_POST, $_POST['clearinvoice'])){
        $stmt=$conn->query("SELECT product_key, quantity from invoice");
        $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($row as $data) {
            $pkey=$data['product_key'];
            $quantity=$data['quantity'];
            $stmt=$conn->prepare("UPDATE products SET quantity=quantity+$quantity WHERE product_key='$pkey'");
            $stmt->execute();
        }
        
        $stmt=$conn->prepare("DELETE FROM invoice");
        $stmt->execute();
        header("location: dashboard.php?uid=$uid");
        exit;
    }

    if(isset($_POST, $_POST['invoice'])){
        
        try{
            $stmt=$conn->query("SELECT product_name, quantity from invoice WHERE invoice_no=$invoice");
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $pname=$row['product_name'];
            $quantity=$row['quantity'];

            $stmtupdate=$conn->prepare("UPDATE products SET quantity=quantity+$quantity WHERE product_name='$pname'");
            $stmtupdate->execute();

            $stmt=$conn->query("DELETE from invoice WHERE invoice_no='$invoice'");
            $stmt->execute();

            if($stmt){
                // $_SESSION['error']="Table updated!";
                header("location: dashboard.php?uid=$uid");
                exit;
            }
            
        }
        catch(Exception $e){
            $_SESSION['error']="Oops deletion error!";
            header("location: dashboard.php?uid=$uid");
            exit;
        }
    }
    else{
        $_SESSION['error']="Oops unidentified error!";
        header("location: products.php?uid=$uid");
        exit;
    }
?>