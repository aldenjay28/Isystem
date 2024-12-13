document.getElementById('add-supplier-form').addEventListener('submit', event => {
    event.preventDefault();

    const formData = new FormData(event.target);

    fetch('../../backend/suppliers/add_supplier.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) alert(data.message);
            location.reload();
        });
});

document.addEventListener('DOMContentLoaded', () => {
    fetch('../../backend/suppliers/get_suppliers.php')
        .then(response => response.json())
        .then(data => {
            const supplierList = document.getElementById('supplier-list');
            data.forEach(supplier => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${supplier.name}</td>
                    <td>${supplier.contact}</td>
                    <td>${supplier.rating}</td>
                `;
                supplierList.appendChild(row);
            });
        });
});
