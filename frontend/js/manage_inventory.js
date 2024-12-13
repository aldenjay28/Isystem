document.addEventListener("DOMContentLoaded", () => {
    const inventoryTable = document.getElementById("inventory-table");

    // Fetch inventory items from the backend
    fetch("../../backend/inventory/view_items.php")
        .then(response => response.json())
        .then(items => {
            items.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td>${item.quantity}</td>
                    <td>${item.price}</td>
                    <td>
                        <button onclick="editItem(${item.id})">Edit</button>
                        <button onclick="deleteItem(${item.id})">Delete</button>
                    </td>
                `;
                inventoryTable.appendChild(row);
            });
        })
        .catch(error => console.error("Error fetching inventory:", error));
});

// Edit item function
function editItem(itemId) {
    location.href = `edit_item.html?id=${itemId}`;
}

// Delete item function
function deleteItem(itemId) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch(`../../backend/inventory/delete_item.php?id=${itemId}`, { method: "DELETE" })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert("Item deleted successfully!");
                    location.reload();
                } else {
                    alert("Failed to delete item: " + result.message);
                }
            });
    }
}
