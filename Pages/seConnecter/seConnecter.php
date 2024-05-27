<?php
session_start();

// Paramètres de connexion à la base de données
$serveur = "localhost"; // ou l'adresse IP du serveur MySQL
$utilisateur = "root";
$motdepasse = "";
$base_de_donnees = "server";

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];

    // Préparer et exécuter la requête SQL pour vérifier l'utilisateur
    $requete = $connexion->prepare("SELECT idclient, motdepasse FROM client WHERE email = ?");
    $requete->bind_param("s", $email);
    $requete->execute();
    $requete->store_result();
    $requete->bind_result($id, $motdepasse_hash);
    $requete->fetch();

    if ($requete->num_rows > 0 && password_verify($motdepasse, $motdepasse_hash)) {
        // Les informations de connexion sont correctes, démarrer une session
        $_SESSION['user_id'] = $id;
        $_SESSION['email'] = $email;
        header("Location: ../acceuil/acceuil.html"); // Rediriger vers la page protégée
        exit;
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $requete->close();
}

// Fermer la connexion à la base de données
$connexion->close();
?>
