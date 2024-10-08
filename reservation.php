<?php
// Inclure les fichiers nécessaires
include "fonction.php"; // Assurez-vous que cette fonction contient la connexion PDO
include "vue/header.php"; // Si nécessaire

$message = ""; // Variable pour stocker le message de confirmation

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que numClient est dans la session
    if (!isset($_SESSION['user']['id_util'])) {
        echo "Vous devez être connecté pour réserver une chambre.";
        exit;
    }

    // Récupérer le numéro du client depuis la session
    $numClient = $_SESSION['user']['id_util']; // ID du client récupéré de la session

    // Récupérer les données du formulaire
    $numChambre = $_POST['numChambre'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $dateArrivee = $_POST['dateArrivee'];
    $dateDepart = $_POST['dateDepart'];

    // Vérifiez que les champs requis ne sont pas vides
    if (empty($prenom) || empty($nom) || empty($tel) || empty($dateArrivee) || empty($dateDepart)) {
        echo "Tous les champs sont requis.";
        exit;
    }

    // Validation de la date d'arrivée et de la date de départ
    if ($dateArrivee >= $dateDepart) {
        echo "La date de départ doit être postérieure à la date d'arrivée.";
        exit;
    }

    // Préparer la requête d'insertion
    $query = "INSERT INTO reservation (numClient, numChambre, dateArrivee, dateDepart) VALUES (:numClient, :numChambre, :dateArrivee, :dateDepart)";

    // Préparer la requête
    $stmt = $pdo->prepare($query);
    try {
        // Exécuter la requête avec les données
        $stmt->execute([
            "numClient" => $numClient, // ID du client récupéré de la session
            "numChambre" => $numChambre,
            "dateArrivee" => $dateArrivee,
            "dateDepart" => $dateDepart,
        ]);

        $message = "Votre réservation a été confirmée avec succès !";

    } catch (PDOException $e) {
        echo "Erreur lors de la réservation : " . $e->getMessage();
    }
}

// Afficher le message de confirmation
if (!empty($message)) {
    echo "<div class='alert alert-success'>$message</div>";
}

// Afficher les réservations de l'utilisateur
if (isset($_SESSION['user']['id_util'])) {
    $numClient = $_SESSION['user']['id_util'];
    
    // Récupérer les réservations de l'utilisateur
    $query = "SELECT r.numReservation, r.dateArrivee, r.dateDepart, ch.prix 
              FROM reservation r 
              JOIN chambre ch ON r.numChambre = ch.numChambre 
              WHERE r.numClient = :numClient";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute(['numClient' => $numClient]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header("vue/listResv.php");
    // // Afficher les réservations
    // if ($reservations) {
    //     echo "<h2 class='text-center'>Vos Réservations</h2>";
    //     echo "<table class='table'>";
    //     echo "<thead><tr><th>#</th><th>Date d'Arrivée</th><th>Date de Départ</th><th>Prix</th></tr></thead>";
    //     echo "<tbody>";
    //     foreach ($reservations as $reservation) {
    //         echo "<tr>";
    //         echo "<td>{$reservation['numReservation']}</td>";
    //         echo "<td>{$reservation['dateArrivee']}</td>";
    //         echo "<td>{$reservation['dateDepart']}</td>";
    //         echo "<td>{$reservation['prix']}€</td>";
    //         echo "</tr>";
    //     }
    //     echo "</tbody></table>";
    // } else {
    //     echo "<p>Aucune réservation trouvée.</p>";
    // }
}

include "vue/footer.php"; // Si nécessaire
?>
