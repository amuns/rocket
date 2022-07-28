<?php 
    require_once '../../db/db-conn.php';
    session_start();
    $stmt=$conn->query("SELECT * from products");

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View Page</title>
</head>
<body>
    <textarea name="product_search" cols="50" rows="1" placeholder="Search"></textarea>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product key</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Company Name</th>
            <th>CreatedAt</th>
            <th>UpdatedAt</th>
        </tr>
        
        <?php 
            while($row=$stmt->fetch()){
                echo "<tr>";
        ?>
            <td><?=htmlentities($row['product_id'])?></td>
            <td><?=htmlentities($row['product_key'])?></td>
            <td><?=htmlentities($row['product_name'])?></td>
            <td><?=htmlentities($row['price'])?></td>
            <td><?=htmlentities($row['quantity'])?></td>
            <td><?=htmlentities($row['company_id'])?></td>
            <td><?=htmlentities($row['createdAt'])?></td>
            <td><?=htmlentities($row['updatedAt'])?></td>
        <?php
                echo "</tr>";
            }
        ?>
        
    </table>
</body>
</html>