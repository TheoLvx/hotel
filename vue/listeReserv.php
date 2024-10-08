<?php
// Fonction pour calculer le nombre de nuits et le coût total
function calculateTotal($dateArrivee, $dateDepart, $prixParNuit) {
    $arrivee = new DateTime($dateArrivee);
    $depart = new DateTime($dateDepart);
    $interval = $arrivee->diff($depart);
    $nbrNuits = $interval->days; // Nombre de jours de différence
    return $nbrNuits * $prixParNuit;
}
?>


<h2 class="text-center my-4">Vos Réservations</h2>

<div class="container">
    <div class="row">
        <?php foreach($reservations as $reservation): 
            $chambre = getOne("chambre", "numChambre", $reservation['numChambre']); 
            ?>
            <div class="col-md-4">
                <div class="card my-3 shadow-sm">
                    <img class="card-img-top" src="utils/img/<?= $chambre['image'] ?>" alt="Image de la chambre" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Chambre n°<?= $reservation['numChambre'] ?></h5>
                        <p class="card-text">
                            <strong>Client ID :</strong> <?= $reservation['numClient'] ?><br>
                            <strong>Date d'arrivée :</strong> <?= date("d/m/Y", strtotime($reservation['dateArrivee'])) ?><br>
                            <strong>Date de départ :</strong> <?= date("d/m/Y", strtotime($reservation['dateDepart'])) ?><br>
                            <strong>Prix par nuit :</strong> <?= $chambre['prix'] ?>€<br>
                            <strong>Total :</strong> <?= calculateTotal($reservation['dateArrivee'], $reservation['dateDepart'], $chambre['prix']) ?>€
                        </p>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
