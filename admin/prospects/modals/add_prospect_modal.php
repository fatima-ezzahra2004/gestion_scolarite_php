<!-- ================= MODAL AJOUT PROSPECT ================= -->
<div id="modalProspect"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

   <div class="bg-white rounded-lg w-full max-w-5xl p-4
            max-h-[90vh] overflow-y-auto">


        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-lg font-semibold">Ajouter un prospect :</h2>
            <button onclick="closeAddProspectModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="store_prospect.php" class="space-y-6">

            <!-- ================= CONTACT ================= -->
            <div>
                <h4 class="text-sm font-semibold text-gray-600 mb-3">
                   
                    Informations personnelles
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <input name="nom" placeholder="Nom *" required class="input">
   <input name="prenom" placeholder="Prenom *" required class="input">

    <select name="genre" class="input" required>
        <option value="">-- Sexe --</option>
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
    </select>

    <input type="date" name="date_naissance" class="input">

    <input name="cin" placeholder="CIN" class="input">
    <input name="nationalite" placeholder="Nationalité" class="input">

    <select name="id_canal" class="input">
        <option value="">Canal</option>
        <?php
        $canaux = $pdo->query("SELECT * FROM canaux")->fetchAll();
        foreach ($canaux as $c) {
            echo "<option value='{$c['id_canal']}'>{$c['nom']}</option>";
        }
        ?>
    </select>

    <select name="id_source" class="input">
        <option value="">Source</option>
        <?php
        $sources = $pdo->query("SELECT * FROM sources")->fetchAll();
        foreach ($sources as $s) {
            echo "<option value='{$s['id_source']}'>{$s['nom']}</option>";
        }
        ?>
    </select>

    

    <!-- ✅ État -->
    <select name="id_etat" class="input">
        <option value="">État</option>
        <?php
        foreach ($etats as $e) {
            echo "<option value='{$e['id_etat']}'>{$e['nom']}</option>";
        }
        ?>
    </select>

</div>

<!-- ✅ Note sur toute la largeur -->
<textarea name="note"
          placeholder="Note"
          class="input h-24 mt-4 w-full"></textarea>

            </div>

            <!-- ================= CONTACT DETAILS ================= -->
            <div>
                <h4 class="text-sm font-semibold text-gray-600 mb-3">
                    Coordonnées
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="email" type="email" placeholder="Email" class="input">
                    <input name="telephone" placeholder="Téléphone" class="input">

                    <input name="whatsapp" placeholder="WhatsApp" class="input">
                    <input name="ville" placeholder="Ville" class="input">
                </div>

                <input name="adresse"
                       placeholder="Adresse"
                       class="input mt-4">
            </div>

            <!-- ================= TUTEUR ================= -->
            <div>
                <h4 class="text-sm font-semibold text-gray-600 mb-3 flex items-center gap-2">
                    <i class="fa-regular fa-user"></i> Parent / Tuteur
                </h4>

                <div class="bg-gray-50 border rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <select name="tuteur_lien_parente" class="input">
                            <option value="">-- Lien de parenté --</option>
                            <option value="Père">Père</option>
                            <option value="Mère">Mère</option>
                            <option value="Tuteur">Tuteur</option>
                        </select>

                        <input name="tuteur_nom" placeholder="Nom du tuteur" class="input">
                        <input name="tuteur_prenom" placeholder="Prénom du tuteur" class="input">

                        <input name="tuteur_telephone" placeholder="Téléphone du tuteur" class="input">
                        <input name="tuteur_whatsapp" placeholder="WhatsApp du tuteur" class="input">

                        <input name="tuteur_email"
                               type="email"
                               placeholder="Email du tuteur"
                               class="input">

                        <input name="tuteur_cin"
                               placeholder="CIN du tuteur"
                               class="input">
                    </div>

                    <p id="tuteurAlert" class="text-sm mt-2 hidden"></p>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-6 border-t">
                <button type="button"
                        onclick="closeAddProspectModal()"
                        class="px-4 py-2 border rounded-md text-sm hover:bg-gray-50">
                    Fermer
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500
                               text-white rounded-md text-sm font-medium">
                    Enregistrer
                </button>
            </div>

        </form>
    </div>
</div>
