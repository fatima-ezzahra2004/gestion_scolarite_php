/* =========================
   MENU 3 POINTS
========================= */
window.toggleMenu = function (id) {
    document.querySelectorAll('[id^="menu-"]').forEach(menu => {
        if (menu.id !== `menu-${id}`) {
            menu.classList.add('hidden');
        }
    });

    document.getElementById(`menu-${id}`)?.classList.toggle('hidden');
};

document.addEventListener('click', e => {
    if (!e.target.closest('.relative')) {
        document.querySelectorAll('[id^="menu-"]').forEach(menu =>
            menu.classList.add('hidden')
        );
    }
});

/* =========================
   UI HELPERS
========================= */
export function showModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

export function hideModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
