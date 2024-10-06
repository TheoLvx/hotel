<h2 class="text-center">Chambres</h2>

<?php foreach ($chambres as $chambre): ?>
    <div class="card my-1" style="width: 18rem;">
        <img class="card-img-top" src="utils/img/<?= $chambre['image'] ?>" alt="Image de la chambre">
        <div class="card-body">
            <h5 class="card-title"><?= $chambre['prix'] ?>€</h5>
            <p class="card-text"><?= $chambre['nbLits'] ?> lit(s)</p>
            <p class="card-text"><?= $chambre['nbPers'] ?> personne(s)</p>
            <a href="chambre.php?action=detail&id=<?= $chambre['numChambre'] ?>" class="btn btn-primary">Détail</a>
            <!-- Bouton Supprimer avec l'appel de la fonction confirmSuppression -->
            <a href="chambre.php?action=supprimer&id=<?= $chambre['numChambre'] ?>" class="btn btn-danger" onclick="return confirmSuppression(<?= $chambre['numChambre'] ?>);">Supprimer</a>
        </div>
    </div>
<?php endforeach; ?>

<!-- Script de confirmation -->
<script>
    // Fonction de confirmation de suppression
    function confirmSuppression(numChambre) {
        return confirm("Confirmez-vous la suppression de la chambre ?");
    }
</script>
