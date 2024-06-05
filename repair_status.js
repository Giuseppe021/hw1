document.addEventListener('DOMContentLoaded', function () {
    // Fai una richiesta AJAX per ottenere i dati dello stato di riparazione
    fetch('api/repair_status.php')
        .then(response => response.json())
        .then(data => {
            const repairStatusDiv = document.getElementById('repair-status');
            data.forEach(status => {
                const statusItem = document.createElement('div');
                statusItem.innerHTML = `
                    <div class="repair-item">
                        <h2>Codice riparazione: #${status.id}</h2>
                        <p>Descrizione: ${status.description}</p>
                        <p>Stato: ${status.status}</p>
                        <p>Data di inizio: ${status.start_date}</p>
                        <p>Data prevista di completamento: ${status.estimated_completion}</p>
                    </div>
                `;
                repairStatusDiv.appendChild(statusItem);
            });
        })
        .catch(error => console.error('Errore durante il recupero dei dati:', error));
});
