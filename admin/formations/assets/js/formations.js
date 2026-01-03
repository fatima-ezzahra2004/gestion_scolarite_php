function toggleMenu(id) {
    document.querySelectorAll('[id^="menu-"]').forEach(m => {
        if (m.id !== 'menu-' + id) m.classList.add('hidden');
    });
    document.getElementById('menu-' + id).classList.toggle('hidden');
}

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}
/* =========================
   OUVRIR MODAL AJOUT
========================= */
function openAddFormationModal() {
    openModal('addFormationModal');
}
document.getElementById('addFormationForm')
?.addEventListener('submit', function (e) {
    e.preventDefault();
    fetch('ajax/add_formation.php', {
        method: 'POST',
        body: new FormData(this)
    }).then(r => r.text()).then(resp => {
        if (resp.trim() === 'ok') location.reload();
        else alert(resp);
    });
});
function openEditFormation(id) {
    fetch('ajax/get_formation_json.php?id=' + id)
        .then(response => response.json())
        .then(d => {

            // Sécurité : si aucune donnée
            if (!d) return;

            document.getElementById('edit_id').value = d.id_formation;
            document.getElementById('edit_nom').value = d.nom;
            document.getElementById('edit_type').value = d.type_formation;
            document.getElementById('edit_duree').value = d.duree;

            openModal('modalEditFormation');
        })
        .catch(err => {
            console.error('Erreur chargement formation', err);
        });
}


function openDetailsFormation(id) {
    fetch('ajax/get_formation.php?id=' + id)
        .then(r => r.text())
        .then(html => {
            detailsContent.innerHTML = html;
            openModal('modalDetailsFormation');
        });
}




let deleteFormationId = null;

/* =========================
   OUVRIR MODAL DELETE
========================= */
function confirmDelete(id) {
    deleteFormationId = id;
    openModal('modalDelete');
}

/* =========================
   CONFIRMER SUPPRESSION
========================= */
document.getElementById('btnDeleteConfirm')
?.addEventListener('click', function () {

    if (!deleteFormationId) return;

    fetch('ajax/delete_formation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(deleteFormationId)
    })
    .then(res => res.text())
    .then(resp => {

        closeModal('modalDelete');
        deleteFormationId = null;

        if (resp.trim() === 'deleted') {
            location.reload();
        } else {
            alert(resp);
        }
    })
    .catch(() => {
        alert('Erreur suppression formation');
    });
});
function openRestoreModal(id) {
    fetch('ajax/restore_formation.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + id
    })
    .then(res => res.text())
    .then(resp => {
        if (resp.trim() === 'restored') {
            location.reload();
        } else {
            alert(resp);
        }
    });
}
