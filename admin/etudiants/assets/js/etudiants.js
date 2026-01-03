
function openAdd() {
    document.getElementById('modalEtudiant').classList.remove('hidden');
    document.getElementById('modalEtudiant').classList.add('flex');
}
function closeAdd() {
    document.getElementById('modalEtudiant').classList.add('hidden');
     document.getElementById('modalEtudiant').classList.remove('flex');
}
document.addEventListener('DOMContentLoaded', function () {

    const alertBox = document.getElementById('sessionAlert');
    if (!alertBox) return;

    setTimeout(() => {
        alertBox.style.transition = "opacity 0.3s";
        alertBox.style.opacity = "0";

        setTimeout(() => {
            alertBox.remove();
        }, 200);
    }, 2000);
});



/* MENU 3 POINTS */

function toggleMenu(id) {
    document.querySelectorAll('[id^="menu-"]').forEach(menu => {
        if (menu.id !== 'menu-' + id) {
            menu.classList.add('hidden');
        }
    });
    document.getElementById('menu-' + id).classList.toggle('hidden');
}

// fermer si clic ailleurs
document.addEventListener('click', function (e) {
    if (!e.target.closest('.relative')) {
        document.querySelectorAll('[id^="menu-"]').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
});


/* =========================
   MODALS (général)
========================= */
function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

/* =========================
   DETAILS ETUDIANT
========================= */
function openDetailsEtudiant(id) {
    fetch('ajax/get_etudiant.php?id=' + id)
        .then(r => r.text())
        .then(html => {
            document.getElementById('detailsEtudiantContent').innerHTML = html;
            openModal('modalDetailsEtudiant');
        });
}

/* =========================
   EDIT ETUDIANT + TUTEUR
========================= */
function openEditEtudiant(id) {
    fetch('ajax/get_etudiant_json.php?id=' + id)
        .then(res => res.json())
        .then(e => {
            if (!e) {
                alert('Étudiant introuvable');
                return;
            }

            document.getElementById('edit_id').value = e.id_etudiant;
            document.getElementById('edit_nom').value = e.nom ?? '';
            document.getElementById('edit_prenom').value = e.prenom ?? '';
            document.getElementById('edit_telephone').value = e.telephone ?? '';
            document.getElementById('edit_email').value = e.email ?? '';
            document.getElementById('edit_cin').value = e.cin ?? '';
            document.getElementById('edit_ville').value = e.ville ?? '';
            document.getElementById('edit_genre').value = e.genre ?? '';
            document.getElementById('edit_date_naissance').value = e.date_naissance ?? '';
            document.getElementById('edit_adresse').value = e.adresse ?? '';

            // TUTEUR
            document.getElementById('edit_tuteur_nom').value = e.tuteur_nom ?? '';
            document.getElementById('edit_tuteur_prenom').value = e.tuteur_prenom ?? '';
            document.getElementById('edit_tuteur_tel').value = e.tuteur_tel ?? '';
            document.getElementById('edit_lien_parente').value = e.lien_parente ?? '';

            document.getElementById('modalEditEtudiant').classList.remove('hidden');
        });
}


let deleteEtudiantId = null;

function openDeleteEtudiant(id) {
    deleteEtudiantId = id;
    document.getElementById('modalDeleteEtudiant').classList.remove('hidden');
}

document.getElementById('btnDeleteEtudiantConfirm')
    ?.addEventListener('click', () => {

        if (!deleteEtudiantId) return;

        fetch('ajax/delete_etudiant.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + encodeURIComponent(deleteEtudiantId)
        })
        .then(res => {
              closeModal('modalDeleteEtudiant');
            if (res.ok) {
                showToast('Étudiant supprimé avec succès 🗑️');
                closeModals('modalDeleteEtudiant');
                setTimeout(() => location.reload(), 700);
            } else {
                showToast('Erreur lors de la suppression ❌', 'error');
            }
        });
    });


/* =========================
   RESTORE
========================= */
/* =========================
   RESTORE ETUDIANT + TUTEUR
========================= */

let restoreEtudiantId = null;

function openRestoreEtudiantModal(id) {
    restoreEtudiantId = id;

    const modal = document.getElementById('restoreEtudiantModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // fermer menu 3 points si ouvert
    const menu = document.getElementById('menu-' + id);
    if (menu) menu.classList.add('hidden');
}

function closeRestoreEtudiantModal() {
    const modal = document.getElementById('restoreEtudiantModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');

    restoreEtudiantId = null;
}

function confirmRestoreEtudiant() {
    if (!restoreEtudiantId) return;

    fetch('ajax/restore_etudiant.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(restoreEtudiantId)
    })
    .then(res => {
       
        if (res.ok) {
            closeRestoreEtudiantModal();
            setTimeout(() => location.reload(), 700);
        } else {
            showToast('Erreur lors de la restauration ❌', 'error');
        }
    })
    .catch(() => {
        showToast('Erreur réseau ❌', 'error');
    });
}
