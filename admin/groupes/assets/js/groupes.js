let deleteId = null;
let restoreId = null;

// ==========================
// TOGGLE MENU
// ==========================
function toggleMenu(id){
    document.querySelectorAll('[id^="menu-"]').forEach(m => {
        if(m.id !== 'menu-'+id) m.classList.add('hidden');
    });
    document.getElementById('menu-'+id).classList.toggle('hidden');
}


document.addEventListener('click', e => {
    if(!e.target.closest('.relative')){
        document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
    }
});

// ==========================
// OPEN/CLOSE MODAL
// ==========================
function openModal(id){
    const modal = document.getElementById(id);
    if(modal){
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(id){
    const modal = document.getElementById(id);
    if(modal){
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    deleteId = null;
    restoreId = null;
}

// ==========================
// SUPPRIMER GROUPE
// ==========================
function confirmDelete(id){
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));
    deleteId = id;
    openModal('modalDelete');
}

document.getElementById('btnDeleteConfirm')?.addEventListener('click', function(){
    if(!deleteId) return;

    fetch('ajax/delete_groupe.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + encodeURIComponent(deleteId)
    })
    .then(res => res.json())
    .then(resp => {
        closeModal('modalDelete');
        deleteId = null;
        location.reload(); // تحديث الصفحة مباشرة بعد الحذف
    })
    .catch(() => location.reload());
});

// ==========================
// AJOUTER GROUPE
// ==========================
// =================== FONCTIONS MODAL ===================



function openAddGroupeModal() {
    const modal = document.getElementById('addGroupeModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex'); 
    }
}


function closeAddGroupeModal() {
    const modal = document.getElementById('addGroupeModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}


document.getElementById('addGroupeForm')?.addEventListener('submit', function(e){
    e.preventDefault(); 

    const formData = new FormData(this);

    fetch('ajax/add_groupe.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.text())
    .then(res => {
        
        location.reload();
    })
    .catch(() => location.reload());
});


// ==========================
// MODIFIER GROUPE
// ==========================
function openEditGroupe(id) {
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));

    fetch('ajax/get_groupe_json.php?id=' + id)
    .then(res => res.json())
    .then(data => {
        if(!data) return;

        document.getElementById('edit_id_groupe').value = data.id_groupe;
        document.getElementById('edit_nom_fr').value = data.nom_fr || '';
        document.getElementById('edit_nom_ar').value = data.nom_ar || '';
        document.getElementById('edit_effectif_max').value = data.effectif_max || '';
        document.getElementById('edit_id_formation').value = data.id_formation || '';

        openModal('modalEditGroupe');
    });
}

document.getElementById('editGroupeForm')?.addEventListener('submit', function(e){
    e.preventDefault();
    fetch('ajax/update_groupe.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(r => r.text())
    .then(resp => {
        closeModal('modalEditGroupe');
        location.reload(); 
    });
});
/* =========================
   RESTORE GROUPE
========================= */


let restoreGroupeId = null;

// OUVRIR MODAL
function openRestoreGroupe(id) {
    restoreGroupeId = id;
    document.getElementById('restoreModal').classList.remove('hidden');
}

// FERMER MODAL
function closeRestoreGroupe() {
    restoreGroupeId = null;
    document.getElementById('restoreModal').classList.add('hidden');
}

// CONFIRMER RESTAURE
function confirmRestoreGroupe() {
    if (!restoreGroupeId) return alert('ID du groupe invalide');

    fetch('ajax/restore_groupe.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${restoreGroupeId}`
    })
    .then(res => res.json())
    .then(resp => {
        
        if(resp.success){
            closeRestoreGroupe();
            location.reload();
        } else {
            alert(resp.message || 'Impossible de restaurer ce groupe');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Erreur connexion ou serveur');
    });
}

///////Supprimer définitivement
let deleteDefGroupeId = null;

// Ouvrir modal
function openDeleteDefGroupe(id){
    deleteDefGroupeId = id;
    document.getElementById('deleteDefGroupeModal').classList.remove('hidden');
}

// Fermer modal
function closeDeleteDefGroupe(){
    deleteDefGroupeId = null;
    document.getElementById('deleteDefGroupeModal').classList.add('hidden');
}

// Confirmer delete
function confirmDeleteDefGroupe(){
    if(!deleteDefGroupeId) return alert('ID invalide');
    console.log("SENDING ID =", deleteDefGroupeId);

    fetch('ajax/force_delete_groupe.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + deleteDefGroupeId
    })
    .then(r => r.json())
    .then(resp => {
        if(resp.success){
            closeDeleteDefGroupe();
            location.reload();
        } else {
            alert(resp.message || 'Erreur suppression groupe');
        }
    })
    .catch(()=> alert('Erreur serveur'));
}

