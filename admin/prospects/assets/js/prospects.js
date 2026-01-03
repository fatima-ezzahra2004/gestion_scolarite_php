import { showModal, hideModal } from './ui.js';

let deleteId = null;
let restoreProspectId = null;

/* =========================
   DETAILS
========================= */
window.openDetails = function (id) {
    fetch(`ajax/get_prospect.php?id=${id}`)
        .then(r => r.text())
        .then(html => {
            document.getElementById('detailsContent').innerHTML = html;
            showModal('modalDetails');
        });
};

window.closeDetails = function () {
    hideModal('modalDetails');
};

/* =========================
   EDIT
========================= */
window.openEdit = function (id) {
    fetch(`ajax/get_prospect_json.php?id=${id}`)
        .then(r => r.json())
        .then(p => {
            if (!p) return alert('Prospect introuvable');

            const map = {
                edit_id: p.id_prospect,
                edit_nom: p.nom,
                edit_prenom: p.prenom,
                edit_telephone: p.telephone,
                edit_whatsapp: p.whatsapp,
                edit_email: p.email,
                edit_cin: p.cin,
                edit_ville: p.ville,
                edit_genre:p.genre,
                edit_date_naissance : p.date_naissance,
                edit_tuteur_nom: p.tuteur_nom,
                edit_tuteur_prenom: p.tuteur_prenom,
                edit_tuteur_tel: p.tuteur_tel,
                edit_lien_parente: p.lien_parente
            };

            Object.entries(map).forEach(([id, val]) => {
                const el = document.getElementById(id);
                if (el) el.value = val ?? '';
            });

            showModal('modalEdit');
        });
};

window.closeEdit = function () {
    hideModal('modalEdit');
};

/* =========================
   DELETE
========================= */
window.confirmDelete = function (id) {
    deleteId = id;
    showModal('modalDelete');
};

window.closeDelete = function () {
    deleteId = null;
    hideModal('modalDelete');
};

document.getElementById('btnDeleteConfirm')?.addEventListener('click', () => {
    if (!deleteId) return;

    fetch('ajax/delete_prospect.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${deleteId}`
    })
    .then(() => {
        hideModal('modalDelete'); // ✅ hideModal utilisé
        location.reload();
    });
});

/* =========================
   RESTORE
========================= */
window.openRestoreModal = function (id) {
    restoreProspectId = id;
    showModal('restoreModal');
};

window.closeRestoreModal = function () {
    restoreProspectId = null;
    hideModal('restoreModal');
};

window.confirmRestore = function () {
    if (!restoreProspectId) return;

    fetch('ajax/restore_prospect.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${restoreProspectId}`
    })
    .then(() => {
        hideModal('restoreModal'); // ✅ hideModal utilisé
        location.reload();
    });
};
/* =========================
   CONVERT PROSPECT
========================= */

window.openConvertModal = function (id, nom) {
    const modal = document.getElementById('convertModal');
    if (!modal) {
        console.error('Modal introuvable');
        return;
    }

    document.getElementById('convertProspectId').value = id;
    document.getElementById('convertProspectName').textContent = nom;

    showModal('convertModal');

    // fermer menu 3 points si ouvert
    document.getElementById(`menu-${id}`)?.classList.add('hidden');
};

window.closeConvertModal = function () {
    hideModal('convertModal');
};
/* =========================
   ADD PROSPECT
========================= */

window.openAddProspectModal = function () {
    showModal('modalProspect');
};

window.closeAddProspectModal = function () {
    hideModal('modalProspect');
};



/* =========================
   FORCE DELETE (DEFINITIVE)
========================= */

let forceDeleteId = null;

window.openForceDeleteModal = function (id) {
    forceDeleteId = id;
    showModal('restoreModal');
};

window.closeForceDeleteModal = function () {
    forceDeleteId = null;
    hideModal('modalForceDelete');
};

window.confirmForceDelete = function () {
    if (!forceDeleteId) return;

    fetch('ajax/force_delete_prospect.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${forceDeleteId}`
    })
    .then(() => {
        hideModal('modalForceDelete');
        location.reload();
    });
};

