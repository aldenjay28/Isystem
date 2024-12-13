document.addEventListener('DOMContentLoaded', () => {
    fetch('../../backend/reports/predict_demand.php')
        .then(response => response.json())
        .then(data => {
            const predictionList = document.getElementById('prediction-list');
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.forecast} units</td>
                `;
                predictionList.appendChild(row);
            });
        });
});
