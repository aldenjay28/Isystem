document.getElementById("add-item-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    fetch("../backend/inventory/add_item.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Item added successfully!");
                window.location.href = "inventory.html";
            } else {
                alert("Error: " + data.message);
            }
        });
});
