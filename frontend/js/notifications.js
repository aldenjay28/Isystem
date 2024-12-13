function fetchNotifications() {
    fetch('../../backend/notifications/check_inventory.php')
        .then(response => response.json())
        .then(data => {
            const notificationDiv = document.getElementById('notifications');
            if (data.success) {
                notificationDiv.innerHTML = `<p>${data.message}</p>`;
                notificationDiv.style.display = 'block';
            }
        });
}

function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`; // `type` can be `success` or `error`
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 5000); // Remove after 5 seconds
}

// Call this function on page load
document.addEventListener('DOMContentLoaded', fetchNotifications);
