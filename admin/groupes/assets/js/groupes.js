import { showModal, hideModal } from './ui.js';

let deleteGroupeId = null;
let restoreGroupeId = null;

/* =========================
   DETAILS GROUPE
========================= */
window.openDetailsGroupe = function (id) {
    fetch(`ajax/get_groupe.php?id=${id}`)
        .then(r => r.text())
        .then(html => {
            document.getElementById('detailsContent').innerHTML = html;
            showModal('modalDetails');
        });
};

window.closeDetailsGroupe = function () {
    hideModal('modalDetails');
};

/* =========================
   EDIT GROUPE
========================= */
window.openEditGroupe = function (id) {
    fetch(`ajax/get_groupe_json.php?id=${id}`)
        .then(r => r.json())
        .then(g => {
            if (!g) return alert('Groupe introuvable');

            const map = {
                edit_id_groupe: g.id_groupe,
                edit_nom_fr: g.nom_fr,
                edit_nom_ar: g.nom_ar,
                edit_effectif_max: g.effectif_max,
                edit_id_formation: g.id_formation
            };

            Object.entries(map).forEach(([id, val]) => {
                const el = document.getElementById(id);
                if (el) el.value = val ?? '';
            });

            showModal('modalEditGroupe');
        });
};

window.closeEditGroupe = function () {
    hideModal('modalEditGroupe');
};

/* =========================
   DELETE GROUPE
========================= */
window.confirmDeleteGroupe = function (id) {
    deleteGroupeId = id;
    showModal('modalDelete');
};

window.closeDeleteGroupe = function () {
    deleteGroupeId = null;
    hideModal('modalDelete');
};

document.getElementById('btnDeleteConfirm')?.addEventListener('click', () => {
    if (!deleteGroupeId) return;

    fetch('ajax/delete_groupe.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${deleteGroupeId}`
    })
    .then(() => {
        hideModal('modalDelete');
        location.reload();
    });
});

/* =========================
   RESTORE GROUPE
========================= */
window.openRestoreGroupe = function (id) {
    restoreGroupeId = id;
    showModal('restoreModal');
};

window.closeRestoreGroupe = function () {
    restoreGroupeId = null;
    hideModal('restoreModal');
};

window.confirmRestoreGroupe = function () {
    if (!restoreGroupeId) return;

    fetch('ajax/restore_groupe.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${restoreGroupeId}`
    })
    .then(() => {
        hideModal('restoreModal');
        location.reload();
    });
};

/* =========================
   ADD GROUPE
========================= */
window.openAddGroupeModal = function () {
    showModal('addGroupeModal');
};

window.closeAddGroupeModal = function () {
    hideModal('addGroupeModal');
};

document.getElementById('addGroupeForm')?.addEventListener('submit', e => {
    e.preventDefault();

    const form = e.target;
    const data = new FormData(form);

    fetch('ajax/add_groupe.php', {
        method: 'POST',
        body: data
    })
    .then(r => r.text())
    .then(res => {
        if (res.trim() === 'ok') {
            hideModal('addGroupeModal');
            location.reload();
        } else {
            alert(res);
        }
    });
});
