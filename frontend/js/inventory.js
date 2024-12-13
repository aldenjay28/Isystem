document.addEventListener("DOMContentLoaded", () => {
    fetch("../backend/inventory/view_items.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#inventory-table tbody");
            data.forEach(item => {
                const row = `<tr>
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td>${item.quantity}</td>
                    <td>${item.price}</td>
                    <td>
                        <button onclick="editItem(${item.id})">Edit</button>
                        <button onclick="deleteItem(${item.id})">Delete</button>
                    </td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        });
});
