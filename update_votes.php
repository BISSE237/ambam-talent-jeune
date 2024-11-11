<?php
// Configuration de la base de données
$servername = "localhost"; // Remplacez par votre serveur
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "concours_beaute"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si les données de notification de CinetPay ont été envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Vérifier la structure des données reçues
    if (isset($data['status'], $data['amount'], $data['transaction_id'])) {
        $status = $data['status'];
        $amount = $data['amount'];
        $transaction_id = $data['transaction_id'];

        // Vérifier que le paiement est réussi et que le montant est correct
        if ($status === 'SUCCESS' && $amount == 11) {
            // Mettre à jour le nombre de votes
            $sql = "UPDATE candidats SET votes = votes + 1 WHERE transaction_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $transaction_id);

            // Exécuter la requête
            if ($stmt->execute()) {
                echo "Nombre de votes mis à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des votes : " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Paiement échoué ou montant incorrect.";
        }
    } else {
        echo "Données de notification invalides.";
    }
} else {
    echo "Aucune donnée reçue.";
}

// Fermer la connexion
$conn->close();
?>