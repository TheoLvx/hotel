<h2 class="text-center">Ajouter Chambres</h2>

<form method="post" action="" enctype="multipart/form-data" id="chambreForm">
    
    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix">
    </div>

    <div class="form-group">
        <label for="">Nombre lits</label>
        <input type="text" class="form-control" name="nbLits" id="nbLits">
    </div>

    <div class="form-group">
        <label for="">Capacité</label>
        <input type="text" class="form-control" name="nbPers" id="nbPers">
    </div>

    <div class="form-group">
        <label for="">Photo</label>
        <input type="file" accept="image/*" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" id="" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
</form>

<script>
    document.getElementById('chambreForm').addEventListener('submit', function(event) {
        const prix = parseFloat(document.getElementById('prix').value);
        const capacite = parseInt(document.getElementById('nbPers').value);
        const lit = parseInt(document.getElementById('nbLits').value);

        // Vérifier si le prix est compris entre 50 et 250
        if (isNaN(prix) || prix < 50 || prix > 250) {
            alert("Le prix doit être compris entre 50 et 250.");
            event.preventDefault(); // Empêche l'envoi du formulaire
        }

        if (isNaN(capacite) || capacite < 1 || capacite > 4) {
            alert("Le prix doit être compris entre 1 et 4.");
            event.preventDefault(); // Empêche l'envoi du formulaire
        }
        
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Configuration du champ "Nombre lits" via le script
        const nbLitsField = document.getElementById('nbLits');
        nbLitsField.value = 2;      // Définit la valeur à 2
        nbLitsField.readOnly = true; // Rend le champ non modifiable
    });
    

    
</script>
