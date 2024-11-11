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

// Récupérer les données des candidats
$sql = "SELECT nom, email, telephone, photo FROM candidats";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>AMBAM TALENT JEUNE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="AMBAM  TALENT JEUNE" name="keywords">
    <meta content="AMBAM  TALENT JEUNE" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&amp;family=Roboto:wght@400;700&amp;display=swap"

      rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"

      rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"

      rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }
        h1 {
            text-align: center; /* Centre le titre */
            margin-bottom: 20px; /* Espace sous le titre */
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 0 auto;
            max-width: 1200px;
        }
        .candidate-card {
            background-color: rgb(210, 222, 230);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }
        .candidate-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .candidate-card h3 {
            margin: 10px 0 5px 0;
        }
        .candidate-card p {
            margin: 5px 0;
            color: #555;
        }
        .vote-button {
            background-color: #4CAF50; /* Couleur du bouton */
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .social-links {
            margin-top: 10px;
        }
        .social-links a {
            margin: 0 5px;
            text-decoration: none;
            color: #007BFF; /* Couleur des liens */
        }
    </style>
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid py-2 border-bottom d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center"> <a class="text-decoration-none text-body pe-3"

                href="">+237 690 56 80 40</a> <span class="text-body">|</span>
              <a class="text-decoration-none text-body px-3" href="">ambamtalentjeunes14@gmail.com</a>
            </div>
          </div>
          <div class="col-md-6 text-center text-lg-end">
            <div class="d-inline-flex align-items-center"> <a class="text-body px-2"

                href=""> <i class="fab fa-facebook-f"></i> </a> <a class="text-body px-2"

                href=""> <i class="fab fa-twitter"></i> </a> <a class="text-body px-2"

                href=""> <i class="fab fa-linkedin-in"></i> </a> <a class="text-body px-2"

                href=""> <i class="fab fa-instagram"></i> </a> <a class="text-body ps-2"

                href=""> <i class="fab fa-youtube"></i> </a> </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
      <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
          <a href="index.html" class="navbar-brand"> <img src="img/Logo.jpg" alt=""

              title="Logo" style="height: 100px; width: 150px;"> </a> <button

            class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span> </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0"> <a href="index.html" class="nav-item nav-link ">Accueil</a>
              <a href="categorie.html" class="nav-item nav-link">Catégories</a>&nbsp;
              <a href="voter.html" class="nav-item nav-link active">Voter</a>
              <a href="contact.html" class="nav-item nav-link">Contact</a> </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- Navbar End -->

    <h1>Candidats Inscrits</h1>
    <div class="grid-container">
        <?php
        // Vérifier si des candidats ont été trouvés
        if ($result->num_rows > 0) {
            // Afficher chaque candidat
            while($row = $result->fetch_assoc()) {
                echo '<div class="candidate-card">';
                echo '<img src="' . htmlspecialchars($row['photo']) . '" alt="Photo de ' . htmlspecialchars($row['nom']) . '">';
                echo '<h3>' . htmlspecialchars($row['nom']) . '</h3>';
                echo '<p>Email: ' . htmlspecialchars($row['email']) . '</p>';
                echo '<p>Téléphone: ' . htmlspecialchars($row['telephone']) . '</p>';
                echo '<button class="vote-button" onclick="redirection()">Votez</button>';
                echo'<div class="social-links">';
                echo'<a href="https://facebook.com/miss5" target="_blank">Facebook</a>';
                echo'<a href="https://instagram.com/miss5" target="_blank">Instagram</a>';
                echo'<a href="https://twitter.com/miss5" target="_blank">Twitter</a>';
                echo'</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun candidat inscrit.</p>';
        }
        ?>
    </div>
    <script>
        function redirection() {
            window.location.href = "paiement.html" ;
        }
    </script>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
          <div class="row g-5">
            <div class="col-lg-3 col-md-6">
              <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Get
                In Touch</h4>
              <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita
                kasd clita et et dolor sed dolor</p>
              <p class="mb-2">Place des fêtes, Ambam, Sud CMR</p>
              <p class="mb-2">ambamtalentjeunes14@gmail.com</p>
              <p class="mb-0">+237 690 56 80 40 </p>
            </div>
            <div class="col-lg-3 col-md-6">
              <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Quick
                Links</h4>
              <div class="d-flex flex-column justify-content-start"> <a class="text-light mb-2"
  
                  href="#">Accueil</a></div>
              <div class="d-flex flex-column justify-content-start"><a class="text-light mb-2"
  
                  href="#">A propos De Nous</a></div>
              <div class="d-flex flex-column justify-content-start"><a class="text-light mb-2"
  
                  href="#"></a> <a class="text-light mb-2" href="#">Partenaires</a>
                Concourir&nbsp; <a class="text-light" href="#">Contact&nbsp;</a>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Popular
                Links</h4>
              <div class="d-flex flex-column justify-content-start"> <a class="text-light mb-2"
  
                  href="#">Accueil</a> <a class="text-light mb-2" href="#">A
                  Propos De Nous</a> <a class="text-light mb-2" href="#">Partenaires</a>
                <a class="text-light mb-2" href="#">Concourir</a> <a class="text-light"
  
                  href="#">Contact</a> </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">Newsletter</h4>
              <form action="">
                <div class="input-group"> <input class="form-control p-3 border-0"
  
                    placeholder="Your Email Address" type="text"> <button class="btn btn-primary">Sign
                    Up</button> </div>
              </form>
              <h6 class="text-primary text-uppercase mt-4 mb-3">Nous contacter</h6>
              <div class="d-flex"> <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
  
                  href="#"><i class="fab fa-twitter"></i></a> <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
  
                  href="#"><i class="fab fa-facebook-f"></i></a> <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2"
  
                  href="#"><i class="fab fa-linkedin-in"></i></a> <a class="btn btn-lg btn-primary btn-lg-square rounded-circle"
  
                  href="#"><i class="fab fa-instagram"></i></a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
          <div class="row g-5">
            <div class="col-md-6 text-center text-md-start">
              <p class="mb-md-0">© <a class="text-primary" href="#">Ambamtalentjeunes14@gmail.com</a>.
                Tous Droits Reservés.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
              <p class="mb-0">Designed by <a class="text-primary" href="https://htmlcodex.com">ZBJ<br>
                </a></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer End -->
    <!-- Back to Top -->
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>