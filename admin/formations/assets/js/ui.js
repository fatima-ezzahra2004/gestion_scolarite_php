// ==========================
// TOGGLE MENU 3 POINTS
// ==========================
export function toggleMenu(id) {
    // نخفي جميع القوائم الأخرى
    document.querySelectorAll('[id^="menu-"]').forEach(menu => {
        if (menu.id !== 'menu-' + id) menu.classList.add('hidden');
    });

    // نعرض/نخفي القائمة المطلوبة
    const menu = document.getElementById('menu-' + id);
    if (menu) menu.classList.toggle('hidden');
}

// ==========================
// MODAL GENERIC FUNCTIONS
// ==========================
export function openModal(id) {
    const modal = document.getElementById(id);
    if(modal){
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

export function closeModal(id) {
    const modal = document.getElementById(id);
    if(modal){
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}
