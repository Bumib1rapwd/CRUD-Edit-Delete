<?php

$db = new PDO('sqlite:products.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Product ID is missing.");
}

$stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_name = $_POST["product_name"];
    $description = $_POST["description"];
    $unit_measure = $_POST["unit_measure"];

    $stmt = $db->prepare("
        UPDATE products
        SET product_name = ?, description = ?, unit_measure = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $product_name,
        $description,
        $unit_measure,
        $id
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>

<body>

    <h1>Edit Product</h1>

    <form method="POST">

        <label>Product Name:</label><br>

        <input
            type="text"
            name="product_name"
            value="<?= htmlspecialchars($product['product_name']) ?>"
            required
        >

        <br><br>

        <label>Description:</label><br>

        <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

        <br><br>

        <label>Unit Measure:</label><br>

        <input
            type="text"
            name="unit_measure"
            value="<?= htmlspecialchars($product['unit_measure']) ?>"
        >

        <br><br>

        <button type="submit">Update Product</button>

    </form>

    <br>

    <a href="index.php">Back to Product View</a>

</body>
</html>