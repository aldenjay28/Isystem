<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Inventory</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Manage Inventory</h1>
    </header>
    <main>
        <form action="../../backend/inventory/add_item.php" method="POST">
            <label>Item Name:</label>
            <input type="text" name="name" required>
            <label>Description:</label>
            <textarea name="description"></textarea>
            <label>Quantity:</label>
            <input type="number" name="quantity" required>
            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>
            <label>Shelf Life:</label>
            <input type="date" name="shelf_life" required>
            <label>Storage Conditions:</label>
            <textarea name="storage_conditions"></textarea>
            <label>Allergens:</label>
            <textarea name="allergens"></textarea>
            <button type="submit">Add Item</button>
        </form>
    </main>
</body>
</html>
