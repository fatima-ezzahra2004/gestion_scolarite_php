const modal = document.getElementById("modal");
const modalBody = document.getElementById("modalBody");
const close = document.getElementById("close");
const btnAdd = document.getElementById("btnAdd");

btnAdd.onclick = () => {
    fetch("modals/add.php")
        .then(r => r.text())
        .then(html => {
            modalBody.innerHTML = html;
            modal.style.display = "flex";

         
            const closeBtn = modalBody.querySelector("#close");
            closeBtn.onclick = () => modal.style.display = "none";

            
            const saveBtn = modalBody.querySelector("#saveMatiere");
            saveBtn.onclick = () => {
                const nom_fr = modalBody.querySelector("#nom_fr").value;
                const nom_ar = modalBody.querySelector("#nom_ar").value;
                const description = modalBody.querySelector("#description").value;

                if (!nom_fr || !nom_ar) {
                    alert("Remplissez tous les champs");
                    return;
                }

                const data = new FormData();
                data.append("nom_fr", nom_fr);
                data.append("nom_ar", nom_ar);
                data.append("description", description);
                data.append("add", "1");

                fetch("actions/insert.php", {
                    method: "POST",
                    body: data
                })
                .then(res => res.text())
                .then(msg => {
                    alert(msg); 
                    modal.style.display = "none";
                    location.reload(); 
                });
            };
        });
};



// Edit
function editMatiere(id){
    fetch("modals/edit.php?id=" + id)
        .then(r => r.text())
        .then(html => {
            modalBody.innerHTML = html;
            modal.style.display = "flex";
                  const closeBtn = modalBody.querySelector("#close");
                  closeBtn.onclick = () => modal.style.display = "none";

            
            const editForm = document.getElementById("editMatiereForm");
            editForm.onsubmit = e => {
                e.preventDefault();
                const formData = new FormData(editForm);

                fetch(editForm.action, {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(msg => {
              
                    modal.style.display = "none";
                    location.reload(); 
                });
            };
        });
}
//delete
function deleteMatiere(id){

    if(!confirm("⚠️Êtes-vous sûr de vouloir supprimer cette matière ")){
        return;
    }

    fetch("actions/delete.php?id=" + id)
        .then(res => {
            return res.text();
        })
        .then(msg => {
            
            location.reload();
        })

}


