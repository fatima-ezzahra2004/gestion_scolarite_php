<div id="modalEtudiant"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

  <div class="bg-white rounded-lg w-full max-w-5xl p-4
              max-h-[90vh] overflow-y-auto">

    <!-- Header -->
    <div class="flex justify-between items-center border-b pb-3 mb-4">
      <h2 class="text-lg font-semibold">Ajouter un étudiant</h2>
      <button onclick="closeAdd()" class="text-gray-400 hover:text-gray-600">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <form method="POST" action="store_etudiant.php" class="space-y-6">

      <!-- ================= ÉTUDIANT ================= -->
      <div>
        <h4 class="text-sm font-semibold text-gray-600 mb-3">
          Informations de l’étudiant
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input name="nom" placeholder="Nom *" required class="input">
          <input name="prenom" placeholder="Prénom *" required class="input">

          <select name="genre" class="input" required>
            <option value="">-- Sexe --</option>
            <option value="M">Masculin</option>
            <option value="F">Féminin</option>
          </select>

          <select name="civilite" class="input" required>
            <option value="">-- Civilité --</option>
            <option value="Monsieur">Monsieur</option>
            <option value="Madame">Madame</option>
            <option value="Mademoiselle">Mademoiselle</option>
          </select>

          <input type="date" name="date_naissance" class="input">
          <input name="nationalite" placeholder="Nationalité" class="input">

          <input name="cin" placeholder="CIN" class="input">
          <input name="ville" placeholder="Ville" class="input">
        </div>
      </div>

      <!-- ================= CONTACT ================= -->
      <div>
        <h4 class="text-sm font-semibold text-gray-600 mb-3">Coordonnées</h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input name="email" type="email" placeholder="Email" class="input">
          <input name="telephone" placeholder="Téléphone" class="input">
          <input name="whatsapp" placeholder="WhatsApp" class="input">
        </div>

        <input name="adresse" placeholder="Adresse" class="input mt-4">
      </div>

      <!-- ================= TUTEUR ================= -->
      <div>
        <h4 class="text-sm font-semibold text-gray-600 mb-3">
          Parent / Tuteur
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

            <input name="tuteur_email" type="email"
                   placeholder="Email du tuteur" class="input">

            <input name="tuteur_cin" placeholder="CIN du tuteur" class="input">
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="flex justify-end gap-3 pt-6 border-t">
        <button type="button"
                onclick="closeAdd()"
                class="px-4 py-2 border rounded-md text-sm">
          Fermer
        </button>
        <button type="submit"
                class="px-4 py-2 bg-sky-500 hover:bg-sky-600
                       text-white rounded-md text-sm font-medium">
          Enregistrer
        </button>
      </div>

    </form>
  </div>
</div>
