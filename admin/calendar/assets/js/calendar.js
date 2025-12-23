let calendar;
document.addEventListener('DOMContentLoaded', function () {

    calendar = new FullCalendar.Calendar(
        document.getElementById('calendar'),
        {
            locale: 'fr',
            initialView: 'timeGridWeek',
            selectable: true,
            editable: true,
            height: 'auto',
eventDisplay: 'block',
            /* ✅ CLIC SUR CASE VIDE */
            select: function (info) {

                // Pré-remplir date & heure
                document.querySelector('#addRdvForm [name="date_rdv"]').value =
                    info.startStr.substring(0, 10);

                document.querySelector('#addRdvForm [name="heure_rdv"]').value =
                    info.startStr.substring(11, 16);

                openAddRdvModal();
            },

            customButtons: {
                newRdv: {
                    text: 'Nouveau rendez-vous',
                    click() {
                        openAddRdvModal();
                    }
                }
            },

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'newRdv dayGridMonth,timeGridWeek,timeGridDay'
            },

            events: 'ajax/fetch_events.php',

            /* ✅ AFFICHAGE RDV */
            eventContent: function (arg) {
                return {
                    html: `
                        <div class="text-xs">
                            <div class="font-semibold">${arg.event.title}</div>
                            <div> ${arg.event.extendedProps.employe}</div>
                            <div> ${arg.event.extendedProps.type_rdv}</div>
                        </div>
                    `
                };
            },

            /* ✅ CLIC SUR RDV EXISTANT */
            eventClick: function (info) {

                const e = info.event;

                document.getElementById('edit_id_rdv').value = e.id;
                document.getElementById('edit_titre').value = e.title;
                document.getElementById('edit_type_rdv').value = e.extendedProps.type_rdv;
                document.getElementById('edit_statut').value = e.extendedProps.statut;
                document.getElementById('edit_notes').value = e.extendedProps.notes ?? '';

                const d = e.start;
                document.getElementById('edit_date').value = d.toISOString().substring(0, 10);
                document.getElementById('edit_heure').value = d.toTimeString().substring(0, 5);

                document.getElementById('modalEditRdv').classList.remove('hidden');
            }
        }
    );

    calendar.render();
}); 
function closeEditRdvModal() {
    document.getElementById('modalEditRdv').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('editRdvForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('ajax/update_event.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(resp => {
            if (resp.trim() === 'success') {
                closeEditRdvModal();
                calendar.refetchEvents(); // ✅ MAINTENANT ÇA MARCHE
            } else {
                alert(resp);
            }
        })
        .catch(() => alert('Erreur modification'));
    });

});



function deleteRdv() {

    if (!confirm('Supprimer ce rendez-vous ?')) return;

    const id = document.getElementById('edit_id_rdv').value;

    fetch('ajax/delete_event.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id_rdv=' + encodeURIComponent(id)
    })
    .then(res => res.text())
    .then(resp => {
        if (resp.trim() === 'success') {
            closeEditRdvModal();
            calendar.refetchEvents(); // ✅ OK
        } else {
            alert(resp);
        }
    })
    .catch(err => {
        console.error(err);
        alert('Erreur lors de la suppression');
    });
}


    /* ================= MODAL RDV ================= */

    window.openAddRdvModal = function () {
        document.getElementById('modalAddRdv').classList.remove('hidden');
    };

    window.closeAddRdvModal = function () {
        document.getElementById('modalAddRdv').classList.add('hidden');
        document.getElementById('addRdvForm').reset();
    };

    /* 🔹 Submit formulaire RDV */
    document.getElementById('addRdvForm').addEventListener('submit', function (e) {
        e.preventDefault();

        fetch('ajax/add_event.php', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(res => res.text())
        .then(resp => {
            if (resp.trim() === 'success') {
                closeAddRdvModal();
                calendar.refetchEvents();
            } else {
                alert(resp);
            }
        });
    });

