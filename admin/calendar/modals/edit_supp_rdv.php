
<div id="modalEditRdv"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl w-[500px] p-6 shadow-lg">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold"> Modifier le rendez-vous</h2>
            <button onclick="closeEditRdvModal()"
                    class="text-gray-500 hover:text-black">✕</button>
        </div>

        <!-- FORM -->
        <form id="editRdvForm" class="space-y-3">

            <input type="hidden" name="id_rdv" id="edit_id_rdv">

            <input type="text"
                   name="titre"
                   id="edit_titre"
                   class="w-full border rounded px-3 py-2"
                   placeholder="Titre"
                   required>

            <select name="type_rdv"
                    id="edit_type_rdv"
                    class="w-full border rounded px-3 py-2"
                    required>
                <option value="Demande d information">Demande d’information</option>
                <option value="Consultation">Consultation</option>
            </select>

            <div class="grid grid-cols-2 gap-3">
                <input type="date"
                       name="date_rdv"
                       id="edit_date"
                       class="w-full border rounded px-3 py-2"
                       required>

                <input type="time"
                       name="heure_rdv"
                       id="edit_heure"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <select name="statut"
                    id="edit_statut"
                    class="w-full border rounded px-3 py-2">
                <option value="planifié">Planifié</option>
                <option value="traité">Traité</option>
                <option value="annulé">Annulé</option>
            </select>

            <textarea name="notes"
                      id="edit_notes"
                      class="w-full border rounded px-3 py-2"
                      placeholder="Notes"></textarea>

            <!-- ACTIONS -->
            <div class="flex justify-between items-center pt-4">

                <!-- SUPPRIMER -->
                <button type="button"
                        onclick="deleteRdv()"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Supprimer
                </button>

                <div class="flex gap-3">
                    <button type="button"
                            onclick="closeEditRdvModal()"
                            class="px-4 py-2 border rounded">
                        Annuler
                    </button>

                    <button type="submit"
                            class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
                        Modifier
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
