<h2 class="text-center my-4">Nos Chambres</h2>

<div class="container">
    <div class="row">
        <?php foreach ($chambres as $chambre): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm" style="height: 100%; width: 22rem;">
                    <img class="card-img-top" src="utils/img/<?= $chambre['image'] ?>" alt="Image de la chambre" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-info">Prix : <?= $chambre['prix'] ?>€ / nuit</h5>
                        <p class="card-text">
                            <strong><?= $chambre['nbLits'] ?> lit(s)</strong><br>
                            <strong>Pour <?= $chambre['nbPers'] ?> personne(s)</strong>
                        </p>
                        <div class="text-center">
                            <a href="chambre.php?action=detail&id=<?= $chambre['numChambre'] ?>" class="btn btn-outline-primary">Voir Détail</a>
                            <a href="chambre.php?action=supprimer&id=<?= $chambre['numChambre'] ?>" class="btn btn-outline-danger" onclick="return confirmSuppression(<?= $chambre['numChambre'] ?>);">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Script de confirmation -->
<script>
    // Fonction de confirmation de suppression
    function confirmSuppression(numChambre) {
        return confirm("Confirmez-vous la suppression de la chambre n°" + numChambre + " ?");
    }
</script>
