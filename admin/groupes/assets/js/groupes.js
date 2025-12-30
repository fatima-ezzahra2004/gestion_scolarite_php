
document.getElementById('btnAdd')?.addEventListener('click', () => {
    document.getElementById('addGroupeModal').style.display='flex';
});

document.querySelectorAll('.closeModal').forEach(btn=>{
    btn.addEventListener('click', ()=>btn.closest('.modal').style.display='none');
});

document.getElementById('formAddGroupe')?.addEventListener('submit', function(e){
    e.preventDefault();
    const data = new FormData(this);
    fetch('ajax/add_groupe.php',{method:'POST', body:data})
    .then(res=>res.text()).then(msg=>{
        alert(msg);
        document.getElementById('addGroupeModal').style.display='none';
        location.reload();
    });
});

function openEdit(id){
    fetch('ajax/get_groupe.php?id='+id)
    .then(res=>res.json()).then(g=>{
        const form = document.getElementById('formEditGroupe');
        form.id_groupe.value = g.id_groupe;
        form.nom_fr.value = g.nom_fr;
        form.nom_ar.value = g.nom_ar;
        form.effectif_max.value = g.effectif_max;
        form.id_formation.value = g.id_formation;
        document.getElementById('editGroupeModal').style.display='flex';
    });
}

document.getElementById('formEditGroupe')?.addEventListener('submit', function(e){
    e.preventDefault();
    const data = new FormData(this);
    fetch('ajax/update_groupe.php',{method:'POST', body:data})
    .then(res=>res.text()).then(msg=>{
        alert(msg);
        document.getElementById('editGroupeModal').style.display='none';
        location.reload();
    });
});

let deleteId = null;

function openDelete(id) {
    deleteId = id;
    document.getElementById('deleteGroupeModal').style.display = 'flex';
}

// زAnnuler
document.querySelector('#deleteGroupeModal .closeModal').addEventListener('click', () => {
    document.getElementById('deleteGroupeModal').style.display = 'none';
    deleteId = null;
});

//  Supprimer
document.getElementById('confirmDelete').addEventListener('click', () => {
    if(deleteId === null) return;

    fetch('ajax/delete_groupe.php?id=' + deleteId)
        .then(res => res.text())
        .then(msg => {
            alert(msg);
            document.getElementById('deleteGroupeModal').style.display = 'none';
            location.reload();
        });
});





// Modal add/edit/delete 
document.getElementById('btnAdd')?.addEventListener('click', () => {
    document.getElementById('addGroupeModal').style.display='flex';
});
document.querySelectorAll('.closeModal').forEach(btn=>{
    btn.addEventListener('click', ()=>btn.closest('.modal').style.display='none');
});

// Toggle Historique
document.addEventListener("DOMContentLoaded", () => {
    const btnHistorique = document.getElementById("btnShowHistorique");
    const historique = document.getElementById("historiqueGroupes");
    const groupes = document.getElementById("groupesContainer");

    let historiqueVisible = false;

    btnHistorique.addEventListener("click", () => {
        historiqueVisible = !historiqueVisible;

        if (historiqueVisible) {
            historique.style.display = "block";
            groupes.style.display = "none";
            btnHistorique.innerText = "Retour aux groupes";
        } else {
            historique.style.display = "none";
            groupes.style.display = "block";
            btnHistorique.innerText = "Afficher Historique";
        }
    });
});

// Restore Groupe


function openRestoreModal(id) {
    fetch('ajax/restore_groupe.php?id=' + id)
        .then(res => res.json())
        .then(data => {
            alert(data.message);

            if(data.success) {
                // نحيدو العنصر ديال historique
                const elem = document.querySelector(`#historiqueGroupes button[onclick='openRestoreModal(${id})']`).closest('.groupeCard');
                elem.remove();

                
                document.getElementById('groupesContainer').style.display = 'block';
                document.getElementById('historiqueGroupes').style.display = 'none';
                document.getElementById('btnShowHistorique').innerText = 'Afficher Historique';


            }
        });
}


function toggleMenu(btn){
    document.querySelectorAll(".menuDropdown").forEach(m=>{
        if(m!==btn.nextElementSibling) m.style.display="none";
    });
    const menu = btn.nextElementSibling;
    menu.style.display = (menu.style.display==="block") ? "none" : "block";
}

document.addEventListener("click", function(e){
    if(!e.target.closest(".menuContainer")){
        document.querySelectorAll(".menuDropdown").forEach(m=>m.style.display="none");
    }
});

