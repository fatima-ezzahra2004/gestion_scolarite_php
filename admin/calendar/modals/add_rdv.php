<div id="modalAddRdv"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl w-[480px] p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold"> Nouveau rendez-vous</h2>
            <button onclick="closeAddRdvModal()">✕</button>
        </div>

        <form id="addRdvForm" class="space-y-3">

            <input type="text" name="titre"
                   class="w-full border rounded px-3 py-2"
                   placeholder="Titre du rendez-vous" required>

            <!-- TYPE RDV -->
            <select name="type_rdv"
                    class="w-full border rounded px-3 py-2" required>
                <option value="">-- Type de rendez-vous --</option>
                <option value="Demande d information">Demande d’information</option>
                <option value="Consultation">Consultation</option>
            </select>

            <!-- DATE & HEURE -->
            <div class="grid grid-cols-2 gap-3">
                <input type="date" name="date_rdv"
                       class="w-full border rounded px-3 py-2" required>

                <input type="time" name="heure_rdv"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- STATUT -->
            <select name="statut"
                    class="w-full border rounded px-3 py-2">
                <option value="planifié">Planifié</option>
                <option value="traité">Traité</option>
                <option value="annulé">Annulé</option>
            </select>
<select name="id_prospect" required
        class="w-full border rounded px-3 py-2">
    <option value="">— Prospect concerné —</option>

    <?php foreach ($prospects as $p): ?>
        <option value="<?= $p['id_prospect'] ?>">
            <?= htmlspecialchars($p['nom'] . ' ' . $p['prenom']) ?>
        </option>
    <?php endforeach; ?>
</select>
<select name="id_employe" required
        class="w-full border rounded px-3 py-2">
    <option value="">— Employé responsable —</option>

    <?php foreach ($employes as $e): ?>
        <option value="<?= $e['id_employe'] ?>">
            <?= htmlspecialchars($e['nom_fr'] . ' ' . $e['prenom_fr']) ?>
            <?= $e['categorie'] ? ' — ' . htmlspecialchars($e['categorie']) : '' ?>
        </option>
    <?php endforeach; ?>
</select>

            <textarea name="notes"
                      class="w-full border rounded px-3 py-2"
                      placeholder="Notes"></textarea>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button"
                        onclick="closeAddRdvModal()"
                        class="px-4 py-2 border rounded">
                    Annuler
                </button>
                <button class="px-4 py-2 bg-teal-600 text-white rounded">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>