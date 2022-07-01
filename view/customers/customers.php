<?php 
    require_once '../../db/db-conn.php';
    session_start();
    $stmt=$conn->query("SELECT * from customers");

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company View Page</title>
</head>
<body>

    <textarea name="product_search" cols="50" rows="1" placeholder="Search"></textarea>
    
    <table border="1">
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>

        <?php 
            while($row=$stmt->fetch()){
                echo "<tr>";
        ?>
            <td><?=htmlentities($row['customer_id'])?></td>
            <td><?=htmlentities($row['customer_name'])?></td>
            <td><?=htmlentities($row['customer_email'])?></td>
            <td><?=htmlentities($row['customer_address'])?></td>
            <td><?=htmlentities($row['customer_contact'])?></td>
            <td><?=htmlentities($row['createdAt'])?></td>
            <td><?=htmlentities($row['updatedAt'])?></td>
        <?php
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>