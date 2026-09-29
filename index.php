<?php

$db = new PDO('sqlite:products.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$products = $db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Information System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }
    </style>
</head>

<body>

    <h1>Course Information System</h1>

<h3>Created by: Sean Michael Catapusan</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Unit Measure</th>
            <th>Action</th>
        </tr>

        <?php foreach ($products as $product): ?>

        <tr>
            <td><?= htmlspecialchars($product['id']) ?></td>
            <td><?= htmlspecialchars($product['product_name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= htmlspecialchars($product['unit_measure']) ?></td>
            <td>
    <td>
    <a href="edit.php?id=<?= $product['id'] ?>">Edit</a>
    |
    <a href="delete.php?id=<?= $product['id'] ?>"
       onclick="return confirm('Are you sure you want to delete this product?')">
       Delete
    </a>
</td>
</td>
        </tr>

        <?php endforeach; ?>

    </table>

</body>
</html>