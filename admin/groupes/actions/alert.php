<?php if (!empty($_SESSION['alert'])): ?>
<div id="sessionAlert"
     class="mb-4 p-3 bg-orange-100 text-orange-700 rounded pt-4">
    <?= $_SESSION['alert']; ?>
</div>
<?php unset($_SESSION['alert']); endif; ?>