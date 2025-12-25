
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

let currentId = null;

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



/* OUVERTURE MODALS */
function openDetails(id) {
    currentId = id;
    closeMenus();
    openModal('modalDetails');
}

function openEdit(id) {
    currentId = id;
    closeMenus();
    openModal('modalEdit');
}

function openDelete(id) {
    currentId = id;
    closeMenus();
    openModal('modalDelete');
}

function openArchive(id) {
    currentId = id;
    closeMenus();
    openModal('modalArchive');
}

/* UTILITAIRES */
function closeMenus() {
    document.querySelectorAll('[id^="menu-"]').forEach(m => m.classList.add('hidden'));
}

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
