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