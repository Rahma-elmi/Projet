

<?php
// Connexion à la base de données
$host = "127.0.0.1";
$user = "root";  // Modifier si nécessaire
$password = "";  // Modifier si nécessaire
$dbname = "bajeh";

// Créer une connexion
$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les services depuis la base de données
$query = "SELECT id_service, nom_service FROM service";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Services</title>
    <link rel="icon" type="image/png" href="/img/icon.png" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    
    <style>
        /*
primary color #FAFAFA
second color #000000
third color #D45621
4th color #ACC8E5
5th color #AA451A
*/

:root {
  --color-primary: #fafafa;
  --color-secondary: #000000;
  --color-tertiary: #d45621;
  --color-4th: #809131;
  --color-5th: #aa451a;
  --color-tertiary-lither: #dd784d;
}
* {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}




html {
  font-size: 62.5%;
  box-sizing: border-box;
}


/* GENERAL ELEMENTS */
/* .section { */

/* NAVIGATION */
.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 9rem;
  width: 100%;
  padding: 0 6rem;
  z-index: 100;
}
/* nav and stickly class at the same time */
/* .nav.sticky {
  position: fixed;
  background-color: rgba(255, 255, 255, 0.95);
} */

.nav__logo {
  height: 4.5rem;
  transition: all 0.3s;
}

.nav__links {
  display: flex;
  align-items: center;
  list-style: none;
}

.nav__item {
}

.nav__link:link,
.nav__link:visited {
  margin-left: 5rem;
  padding: 0.2rem 1rem;
  border-radius: 0.5rem;
  font-size: 1.7rem;
  font-weight: 400;
  color: var(--color-secondary);
  text-decoration: none;
  display: block;
  transition: all 0.3s;
}

.btn__InsCon:link,
.btn__InsCon:visited {
  background-color: var(--color-tertiary);
}
.btn__InsCon:hover,
.btn__InsCon:active {
  background-color: var(--color-tertiary-lither);
  color: var(--color-secondary);
}

.btn__service:link,
.btn__service:visited {
  background-color: none;
}

/* HEADER */
.header {
  padding: 0 3rem;
  height: 10vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.header__title {
  flex: 1;
  max-width: 130rem;
  display: grid;
  grid-template-columns: 3fr 2fr;
  row-gap: 3rem;
  align-content: center;
  justify-content: center;

  align-items: start;
  justify-items: start;
}
/* Footer Styling */
.footer {
  background-color: #333;
  color: #fff;
  padding: 2rem;
  font-family: Arial, sans-serif;
  font-size: 12px;
}

.footer__container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
}

.footer__title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
  color: #f0a500;
}

.footer__about,
.footer__links,
.footer__contact,
.footer__socials {
  line-height: 1.8;
}

.footer__link {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer__link:hover {
  color: #f0a500;
}

.footer__social {
  color: #fff;
  font-size: 20px;
  margin-right: 0.5rem;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer__social:hover {
  /*color: #f0a500;*/
    color: #007bff; /* Couleur au survol */
    transform: scale(1.2); /* Agrandit l'icône au survol */
}

.footer__bottom {
  text-align: center;
  margin-top: 2rem;
  font-size: 15px;
  border-top: 1px solid #444;
  padding-top: 1rem;
  color: #ccc;
}
/* .section,
.header {
  display: none;
} */

        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container central */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Titres */
        h1 {
            font-size: 2.5em;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Liste des services */
        .service-list {
            list-style-type: none;
            padding: 0;
        }

        .service-list li {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            background-color: #fff;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .service-list li:hover {
            background-color: #f1f1f1;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .service-list li span {
            font-size: 1.4em;
            font-weight: bold;
        }

        .service-list li .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .service-list li .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header class="header">
      <nav class="nav">
        <a href="./index.html">
          <img
            src="img/logo.png"
            alt="HOMEtask logo"
            class="nav__logo"
            id="logo"
          />
        </a>
        <ul class="nav__links">
        <li class="nav__item">
            <a class="nav__link btn__service" href="index.html">Acceuil</a>
          </li>
          <li class="nav__item">
          <a class="nav__link btn__contact" href="apropos.html">A propos</a>
          </li>
          <li class="nav__item">
            <a class="nav__link btn__contact" href="contact.html">Contactez-nous</a>
          </li>
          <li class="nav__item">
            <a class="nav__link btn__InsCon" href="inscription.html"
              >Inscription / Connexion</a
            >
          </li>
        </ul>
      </nav>
    </header>
<div class="container">
    <h1>Liste des Services</h1>

    <ul class="service-list">
        <?php
        // Afficher les services dans une liste avec un bouton "CONSULTER"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>
                        <span>" . $row['nom_service'] . "</span>
                        <a href='presta.php?id_service=" . $row['id_service'] . "' class='btn'>CONSULTER</a>
                      </li>";
            }
        } else {
            echo "<li>Aucun service disponible.</li>";
        }
        ?>
    </ul>
</div>

<?php
// Fermer la connexion
$conn->close();
?>
    <footer class="footer">
      <div class="footer__container">
        <!-- Section À propos -->
        <div class="footer__about">
          <h3 class="footer__title">À propos</h3>
          <p>
            HOMEtask vous offre des services de qualité pour vous simplifier la vie au quotidien.
            Nous sommes dédiés à répondre à vos besoins de manière rapide et efficace.
          </p>
        </div>
    
        <!-- Section Liens rapides -->
        <div class="footer__links">
          <h3 class="footer__title">Liens rapides</h3>
          <ul>
            <li><a href="./index.html" class="footer__link">Accueil</a></li>
            <li><a href="./contact.html" class="footer__link">Contactez-nous</a></li>
            <li><a href="#" class="footer__link">Inscription / Connexion</a></li>
          </ul>
        </div>
    
        <!-- Section Contact -->
        <div class="footer__contact">
          <h3 class="footer__title">Contact</h3>
          <ul>
            <li><i class="fas fa-phone"></i> +253 77 16 62 46</li>
            <li><i class="fas fa-envelope"></i> contact@hometask.com</li>
            <li><i class="fas fa-map-marker-alt"></i> Balbala, Djibouti</li>
          </ul>
        </div>
    
        <!-- Section Réseaux sociaux -->
        <div class="footer__socials">
          <h3 class="footer__title">Suivez-nous</h3>
          <a href="#" class="footer__social"><i class="fab fa-facebook"></i></a>
          <a href="#" class="footer__social"><i class="fab fa-twitter"></i></a>
          <a href="#" class="footer__social"><i class="fab fa-instagram"></i></a>
          <a href="#" class="footer__social"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    
      <!-- Copyright -->
      <div class="footer__bottom">
        <p>&copy; 2024 HOMEtask. Tous droits réservés.</p>
      </div>
    </footer>
  </body>
</html>