<?php
// Connexion à la base de données
$servername = "localhost"; // Remplacez par votre serveur
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "concours_beaute"; // Nom de la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // Gestion du fichier uploadé
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Répertoire de destination des uploads
        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

        // Déplacer le fichier téléchargé
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            // Préparer et lier
            $stmt = $conn->prepare("INSERT INTO candidats (nom, email, telephone, photo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $uploadFile);

            // Exécuter la requête
            if ($stmt->execute()) {
                echo "Inscription réussie pour " . $name . "! Photo téléchargée: " . htmlspecialchars($_FILES['photo']['name']);
            } else {
                echo "Erreur : " . $stmt->error;
            }

            // Fermer la déclaration
            $stmt->close();
        } else {
            echo "Erreur lors du téléchargement de la photo.";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}

// Fermer la connexion
$conn->close();
?>