// Example: Fetch and display inventory
document.addEventListener('DOMContentLoaded', () => {
    fetch('../../backend/inventory/view_items.php')
        .then(response => response.json())
        .then(data => {
            const inventoryList = document.getElementById('inventory-list');
            data.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = `${item.name} - ${item.quantity} in stock`;
                inventoryList.appendChild(listItem);
            });
        });
});

document.getElementById('dark-mode-toggle').addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));
});

// Load preference
if (localStorage.getItem('dark-mode') === 'true') {
    document.body.classList.add('dark-mode');
}
