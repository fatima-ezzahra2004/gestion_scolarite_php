     <?php if (!empty($_SESSION['alert'])): ?>
<div id="session"
     class="bg-green-100 border border-green-300 text-green-800
            p-4 rounded-lg mb-4 flex justify-between items-start">

    <div class="text-sm leading-relaxed">
        <?= $_SESSION['alert']; ?>
    </div>

    <button
        onclick="this.parentElement.remove()"
        class="ml-4 text-green-700 hover:text-green-900 font-bold text-lg"
        title="Fermer">
        ×
    </button>
</div>
<?php unset($_SESSION['alert']); endif; ?>