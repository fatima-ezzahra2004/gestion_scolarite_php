
function openModal() {
    document.getElementById('modalProspect').classList.remove('hidden');
    document.getElementById('modalProspect').classList.add('flex');
}
function closModal() {
    document.getElementById('modalProspect').classList.add('hidden');
     document.getElementById('modalProspect').classList.remove('flex');
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



function toggleMenu(id) {
    document.querySelectorAll('[id^="menu-"]').forEach(menu => {
        if (menu.id !== 'menu-' + id) {
            menu.classList.add('hidden');
        }
    });

    const menu = document.getElementById('menu-' + id);
    menu.classList.toggle('hidden');
}

// Fermer si clic ailleurs
document.addEventListener('click', function (e) {
    if (!e.target.closest('.relative')) {
        document.querySelectorAll('[id^="menu-"]').forEach(menu => {
            menu.classList.add('hidden');
        });
    }
});





function openDetails(id) {
    fetch('ajax/get_prospect.php?id=' + id)
        .then(res => res.text())
        .then(html => {
            document.getElementById('detailsContent').innerHTML = html;
            document.getElementById('modalDetails').classList.remove('hidden');
        });
}

function openEdit(id) {
    fetch('ajax/get_prospect_json.php?id=' + id)
        .then(res => res.json())
        .then(p => {
            if (!p) {
                alert('Prospect introuvable');
                return;
            }

            document.getElementById('edit_id').value = p.id_prospect;
            document.getElementById('edit_nom').value = p.nom ?? '';
            document.getElementById('edit_prenom').value = p.prenom ?? '';
            document.getElementById('edit_telephone').value = p.telephone ?? '';
            document.getElementById('edit_whatsapp').value = p.whatsapp ?? '';
            document.getElementById('edit_email').value = p.email ?? '';
            document.getElementById('edit_cin').value = p.cin ?? '';
            document.getElementById('edit_ville').value = p.ville ?? '';
            document.getElementById('edit_nationalite').value = p.nationalite ?? '';
            document.getElementById('edit_genre').value = p.genre ?? '';
            document.getElementById('edit_civilite').value = p.civilite ?? '';
            document.getElementById('edit_date_naissance').value = p.date_naissance ?? '';
            document.getElementById('edit_canal').value = p.id_canal ?? '';
            document.getElementById('edit_source').value = p.id_source ?? '';
            document.getElementById('edit_etat').value = p.id_etat ?? '';
            document.getElementById('edit_adresse').value = p.adresse ?? '';

            document.getElementById('modalEdit').classList.remove('hidden');
        });
}


function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

// submit modification
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();

    fetch('ajax/update_prospect.php', {
        method: 'POST',
        body: new FormData(this)
    }).then(() => location.reload());
});


let deleteId = null;

function confirmDelete(id) {
    deleteId = id;
    document.getElementById('modalDelete').classList.remove('hidden');
}

document.getElementById('btnDeleteConfirm').addEventListener('click', function () {
    fetch('ajax/delete_prospect.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + deleteId
    })
    .then(res => res.text())
    .then(resp => {
        if (resp.trim() === 'success') {
            location.reload();
        } else {
            alert(resp);
        }
    })
    .catch(() => alert('Erreur réseau'));
});



