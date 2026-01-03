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

   <form method="POST"
      action="store_etudiant.php"
      enctype="multipart/form-data"
      class="space-y-6">

  <!-- ================= USER ================= -->
  <div>
    <h4 class="text-sm font-semibold text-gray-600 mb-3">
      Utilisateur (compte déjà créé)
    </h4>

    <select name="user_id" required class="input">
      <option value="">-- Sélectionner l’étudiant --</option>
      <?php foreach ($users_etudiants as $u): ?>
        <option value="<?= $u['id'] ?>">
          <?= htmlspecialchars($u['prenom'].' '.$u['nom'].' — '.$u['email']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- ================= ÉTUDES ================= -->
  <div>
    <h4 class="text-sm font-semibold text-gray-600 mb-3">
      Informations académiques
    </h4>

    <input name="niveau_etude" placeholder="Niveau d’étude *" required class="input">
  </div>

  <!-- ================= DOCUMENTS ================= -->
<div>
  <h4 class="text-sm font-semibold text-gray-600 mb-3">
    Documents
  </h4>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <!-- CIN -->
    <div>
      <label class="block text-xs font-medium text-gray-600 mb-1">
        CIN (PDF)
      </label>
      <input type="file"
             name="pdf_cin"
             accept="application/pdf"
             class="input">
    </div>

    <!-- PHOTO PROFIL -->
    <div>
      <label class="block text-xs font-medium text-gray-600 mb-1">
        Photo de profil (PDF / Image)
      </label>
      <input type="file"
             name="pdf_profil"
             accept="application/pdf,image/*"
             class="input">
    </div>

    <!-- DIPLÔME -->
    <div>
      <label class="block text-xs font-medium text-gray-600 mb-1">
        Diplôme (PDF / Image)
      </label>
      <input type="file"
             name="diplome_scan"
             accept="application/pdf,image/*"
             class="input">
    </div>

  </div>
</div>


  <div class="flex justify-end gap-3 pt-6 border-t">
    <button type="submit"
            class="px-4 py-2 bg-sky-500 text-white rounded-md">
      Enregistrer
    </button>
  </div>

</form>

  </div>
</div>
