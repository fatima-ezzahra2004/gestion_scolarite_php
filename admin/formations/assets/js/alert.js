let toastTimer = null;

window.showToast = function (message, type = 'success', duration = 4000) {
    const toast = document.getElementById('toast');
    if (!toast) return;

    // 🔁 Annuler l'ancien timer
    if (toastTimer) {
        clearTimeout(toastTimer);
        toastTimer = null;
    }

    const styles = {
        success: 'bg-green-100 border border-green-300 text-green-800',
        error:   'bg-red-100 border border-red-300 text-red-800',
        warning: 'bg-yellow-100 border border-yellow-300 text-yellow-800'
    };

    toast.className =
        `fixed top-5 right-5 px-4 py-3 rounded-lg shadow-lg text-sm z-50 transition-opacity duration-300 ${styles[type]}`;

    toast.textContent = message;

    // 👁️ Afficher
    toast.style.opacity = '1';
    toast.classList.remove('hidden');

    // ⏳ Masquer après durée
    toastTimer = setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 300);
    }, duration);
};
/////////////////////////////////////////
/* =========================
   ADD FORMATION
========================= */

// فتح المودال
window.openAddFormationModal = function () {
    // نسكر أي menu مفتوح قبل الفتح
    document.querySelectorAll('[id^="menu-"]').forEach(menu => menu.classList.add('hidden'));
    openModal('addFormationModal');
};

// غلق المودال
window.closeAddFormationModal = function () {
    closeModal('addFormationModal');
};

/* =========================
   SUBMIT ADD FORMATION (AJAX)
========================= */
document.getElementById('addFormationForm')?.addEventListener('submit', function (e) {
    e.preventDefault(); // ⛔ منع redirection

    const formData = new FormData(this);

    fetch('ajax/add_formation.php', {
        method: 'POST',
        body: formData
    })
    .then(r => {
        if (!r.ok) throw new Error('Erreur réseau');
        return r.text(); // backend kayrja3 'ok' ila t3adat
    })
    .then(resp => {
        if (resp.trim() === 'ok') {
            showToast('Formation ajoutée avec succès', 'success'); // fonction toast li katban message
            closeAddFormationModal();

            setTimeout(() => {
                location.reload(); // reload page mli t3adat
            }, 2000);
        } else {
            showToast(resp, 'error', 6000);
        }
    })
    .catch(() => {
        showToast('Erreur serveur lors de l’ajout', 'error');
    });
});
