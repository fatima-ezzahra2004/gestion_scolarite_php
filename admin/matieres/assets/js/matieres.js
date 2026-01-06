
let deleteId = null;

// Menu 3 points
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
}


/* ======= AJAX ADD MATIERE ======= */

function openAddMatiereModal() {
    const modal = document.getElementById('addMatiereModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex'); 
    }
}


function closeAddMatiereModal() {
    const modal = document.getElementById('addMatiereModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}


document.getElementById('addMatiereForm')?.addEventListener('submit', function(e){
    e.preventDefault();
    const formData = new FormData(this);

    fetch('ajax/add.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.text())
    .then(res => {
        
        location.reload();
    })
    .catch(() => location.reload());
});




//////////////////////////////modifer
// Ouvrir / fermer modal
function openEditMatiereModal(id) {
    const modal = document.getElementById('editMatiereModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    
    fetch('ajax/get_matiere.php?id=' + id)
        .then(r => r.json())
        .then(data => {
            if(!data) return alert('Matière introuvable');
            document.getElementById('edit_id_matiere').value = data.id_matiere;
            document.getElementById('edit_nom_fr').value = data.nom_fr;
            document.getElementById('edit_nom_ar').value = data.nom_ar;
            document.getElementById('edit_description').value = data.description;
        });
}

function closeEditMatiereModal() {
    const modal = document.getElementById('editMatiereModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


document.getElementById('editMatiereForm')?.addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch('ajax/edit.php', {
        method: 'POST',
        body: formData
    })
    .then(r => r.text())
    .then(res => {
      
            
            closeEditMatiereModal();
            location.reload(); 
            
       
    })
    .catch(err => alert('Erreur AJAX'));
});

//////////delete


function confirmDelete(id){
    deleteId = id;
    openModal('modalDelete');
}

//  Confirm delete
document.getElementById('btnDeleteConfirm')?.addEventListener('click', function(){
    if(!deleteId) return;

    fetch('ajax/delete.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + encodeURIComponent(deleteId)
    })
    .then(res => res.text())
    .then(resp => {
        closeModal('modalDelete');
       
           
            document.getElementById('row-'+deleteId)?.remove();
       
        deleteId = null;
        location.reload();
    })
    .catch(() => alert('Erreur suppression'));
});

/* =========================
   RESTORE GROUPE
========================= */
let restoreMatiereId = null;

// OUVRIR MODAL
function openRestoreMatiere(id){
    restoreMatiereId = id;
    document.getElementById('restoreMatiereModal').classList.remove('hidden');
}

// FERMER MODAL
function closeRestoreMatiere(){
    restoreMatiereId = null;
    document.getElementById('restoreMatiereModal').classList.add('hidden');
}

// CONFIRMER RESTORE
function confirmRestoreMatiere(){
    if(!restoreMatiereId) return alert('ID invalide');

    fetch('ajax/restore_matiere.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + restoreMatiereId
    })
    .then(res => res.json())
    .then(resp => {
        console.log(resp); // Pour debug
       
            closeRestoreMatiere();
            location.reload();
        
    })
    .catch(() => alert('Erreur connexion ou serveur'));
}
//////////////////JS pour modal Supprimer Définitivement
let deleteDefMatiereId = null;

function openDeleteDefMatiere(id){
    deleteDefMatiereId = id;
    document.getElementById('deleteDefMatiereModal').classList.remove('hidden');
}

function closeDeleteDefMatiere(){
    deleteDefMatiereId = null;
    document.getElementById('deleteDefMatiereModal').classList.add('hidden');
}

function confirmDeleteDefMatiere(){
    if(!deleteDefMatiereId) return alert('ID invalide');

    fetch('ajax/force_delete_matiere.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + deleteDefMatiereId
    })
    .then(r => r.json())
    .then(resp => {
        if(resp.success){
            closeDeleteDefMatiere();
            location.reload();
        } else {
            alert(resp.message || 'Erreur suppression');
        }
    });
}