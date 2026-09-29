<?php

$db = new PDO('sqlite:products.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_name = $_POST["product_name"];
    $description = $_POST["description"];
    $unit_measure = $_POST["unit_measure"];

    $stmt = $db->prepare("
        INSERT INTO products (product_name, description, unit_measure)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $product_name,
        $description,
        $unit_measure
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>

<body>

    <h1>Add Product</h1>

    <form method="POST">

        <label>Product Name:</label><br>
        <input type="text" name="product_name" required>
        <br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea>
        <br><br>

        <label>Unit Measure:</label><br>
        <input type="text" name="unit_measure">
        <br><br>

        <button type="submit">Add Product</button>

    </form>

    <br>

    <a href="index.php">Back to Product View</a>

</body>
</html>