
// ==========================
// TOGGLE MENU
// ==========================
function toggleMenu(id) {
    // نخفي جميع القوائم الأخرى
    document.querySelectorAll('[id^="menu-"]').forEach(menu => {
        if (menu.id !== 'menu-' + id) menu.classList.add('hidden');
    });

    // نعرض/نخفي القائمة المطلوبة
    const menu = document.getElementById('menu-' + id);
    if (menu) menu.classList.toggle('hidden');
}

// ==========================
// FONCTIONS GENERALES POUR MODAL
// ==========================
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// ==========================
// AJOUT FORMATION
// ==========================
function openAddFormationModal() {
    
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));

    openModal('addFormationModal');
}

document.getElementById('addFormationForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    fetch('ajax/add_formation.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(r => r.text())
    .then(resp => {
        if (resp.trim() === 'ok') location.reload();
        else alert(resp);
    })
    .catch(() => alert('Erreur ajout formation'));
});

// ==========================
// SUPPRESSION FORMATION
// ==========================
let deleteFormationId = null;

function confirmDelete(id) {
   
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));

    deleteFormationId = id;
    openModal('modalDelete');
}

document.getElementById('btnDeleteConfirm')?.addEventListener('click', function() {
    if (!deleteFormationId) return;

    fetch('ajax/delete_formation.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + encodeURIComponent(deleteFormationId)
    })
    .then(res => res.json())
    .then(resp => {
        closeModal('modalDelete');
        deleteFormationId = null;
        if (resp.success) location.reload();
        else alert(resp.message || 'Erreur suppression formation');
    })
    .catch(() => alert('Erreur suppression formation'));
});
// ==========================
// EDIT FORMATION
// ==========================
function openModal(id) {
    const modal = document.getElementById(id);
    if(modal){
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(id) {
    const modal = document.getElementById(id);
    if(modal){
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// ==========================
// EDIT FORMATION
// ==========================
function openEditFormation(id){
   
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));

    fetch('ajax/get_formation_json.php?id=' + id)
    .then(res => res.json())
    .then(data => {
        if(!data){
            alert("Formation introuvable");
            return;
        }

        // remplir les champs
        document.getElementById('edit_id').value = data.id_formation;
        document.getElementById('edit_nom').value = data.nom;
        document.getElementById('edit_type').value = data.type_formation;
        document.getElementById('edit_duree').value = data.duree;

        // ouvrir le modal
        openModal('modalEditFormation');
    })
    .catch(err=>{
        console.error(err);
        alert("Erreur chargement formation");
    });
}

// Ajax submit pour la modification
document.querySelector('#modalEditFormation form')?.addEventListener('submit', function(e){
    e.preventDefault();

    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
    .then(res => res.text())
    .then(resp=>{
        if(resp.trim() === 'ok'){
            location.reload(); // reload page après modification
        } else {
            alert(resp);
        }
    })
    .catch(()=>{
        alert("Erreur mise à jour formation");
    });
});



// ==========================
// RESTAURER FORMATION

let restoreId = null;

function openRestoreModal(id) {
    restoreId = id; 
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));
    document.getElementById('restoreformation').classList.remove('hidden');
}

function closeRestoreformationModal() {
    restoreId = null;
    document.getElementById('restoreformation').classList.add('hidden');
}


function confirmRestoreformation() {
    if (!restoreId) return;

    fetch('ajax/restore_formation.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + encodeURIComponent(restoreId)
    })
    .then(res => res.json())
    .then(resp => {
        if (resp.success) {
            location.reload(); // nreloadi page mli t3adet
        } else {
            alert(resp.message || 'Erreur restauration');
        }
    })
    .catch(() => alert('Erreur restauration formation'))
    .finally(() => closeRestoreformationModal());
}

let deleteDefFormationId = null;

function openDeleteDefFormation(id){
    deleteDefFormationId = id;
    document.getElementById('deleteDefFormationModal').classList.remove('hidden');
}

function closeDeleteDefFormation(){
    deleteDefFormationId = null;
    document.getElementById('deleteDefFormationModal').classList.add('hidden');
}

function confirmDeleteDefFormation(){
    if(!deleteDefFormationId) return alert('ID invalide');
    console.log("SENDING ID =", deleteDefFormationId);

    fetch('ajax/force_delete_modal.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'id=' + deleteDefFormationId
    })
    .then(r => r.json())
    .then(resp => {
        if(resp.success){
            closeDeleteDefFormation();
            location.reload();
        } else {
            alert(resp.message || 'Erreur suppression formation');
        }
    })
    .catch(()=> alert('Erreur serveur'));
}
