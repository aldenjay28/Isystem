document.addEventListener('DOMContentLoaded', () => {
    fetch('../../backend/roles/get_users.php')
        .then(response => response.json())
        .then(data => {
            const userList = document.getElementById('user-list');
            data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>
                        <button onclick="updateRole(${user.id}, 'admin')">Make Admin</button>
                        <button onclick="updateRole(${user.id}, 'user')">Make User</button>
                    </td>
                `;
                userList.appendChild(row);
            });
        });
});

function updateRole(userId, role) {
    fetch('../../backend/roles/update_role.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, new_role: role })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) alert(data.message);
            location.reload();
        });
}
