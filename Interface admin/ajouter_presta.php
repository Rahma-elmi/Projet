<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page administrateur | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="hometask.min.css" rel="stylesheet" type="text/css" /> 
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
        .main-header {
        background-color: black;
        color: #FFFFFF;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 1rem;
      }
      .nav__logo {
        height: 3rem;
       
      }
      .user-image {
        border-radius: 50%;
        width: 40px;
        height: 40px;
      }
      .sidebar-menu li a {
            text-decoration: none;
      }
      .navbar .user-menu a {
            text-decoration: none;
        }
        li.active.treeview {
            position: relative;
            top: 65px;
        }
       
      .btn-default {
        color: #d9534f;
       }
     .btn-default:hover {
        background-color: white; 
        color: white; 
     }
    .sidebar-menu {
    background-color: black;
    color: white;
    padding-top: 50px;
    padding-bottom: 50px;
    display: flex;
    flex-direction: column;
    height: 1000px;  
   }
   .menu-item {
    margin-bottom: 60px;
    padding: 10px;
}
   .menu-item:first-child {
    margin-top: 20px;
}
   .menu-item a {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 16px;
}
   .menu-item a:hover {
    background-color: #333;
    border-radius: 4px;
}

    .menu-item i {
    margin-right: 10px;
    font-size: 18px;
}

    .menu-item.active a {
    font-weight: bold;
    background-color: #555;
    border-radius: 4px;
}
</style>
</head>
  <body class="skin-blue">
    <div class="wrapper">
      <header class="main-header">
       <!-- Logo -->
       <a href="./index.html" >
          <img
            src="img/logo.png"
            alt="HOMEtask logo"
            class="nav__logo"
            id="logo"
          />
        </a>  
        <nav class="navbar navbar-static-top" role="navigation" >         
            <div class="pull-right">
             <a href="connexion_rab.php" class="btn btn-default btn-flat">se deconnecter</a>
            </div>      
          
        </nav>
     </header>
     
      <aside class="main-sidebar">
    <section class="sidebar">
        <div class="sidebar-menu">
            <div class="menu-item active">
                <a href="admin.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="menu-item">
                <a href="service.php">
                    <i class="fa fa-th"></i>
                    <span>Services</span>
                </a>
            </div>

            <div class="menu-item">
                <a href="ajouter_presta.php">
                    <i class="fa fa-users"></i>
                    <span>Prestataires</span>
                </a>
            </div>

            <div class="menu-item">
                <a href="utilisateur.php">
                    <i class="fa fa-user"></i>
                    <span>Utilisateurs</span>
                </a>
            </div>
        </div>
    </section>
</aside>
<div class="content-wrapper">
 <section class="content">
  <div class="row">
    <div class="col-lg-3 col-xs-6">
            <?php

$servername = "localhost";
$username = "root";  
$password = "";     
$dbname = "bajeh";   


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT COUNT(*) AS total_admin FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $totaladmin = $row['total_admin'];
} else {
    $totaladmin = 0;  
}
$conn->close();
?>
<div class="small-box" style="background-color:rgb(21, 201, 247); color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="inner">
        <h3><?php echo $totaladmin; ?></h3>
        <p> Administrateur </p>
    </div>
    <div class="icon">
        <i class="ion-locked"></i>
    </div>
</div>
</div>

<div class="col-lg-3 col-xs-6">
<?php
    
    $servername = "localhost";
    $username = "root";  
    $password = "";      
    $dbname = "bajeh";  

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT COUNT(*) AS total_service FROM service";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalServices = $row['total_service'];
    } else {
        $totalServices = 0;  
    }
    $conn->close();
    ?>

<div class="small-box" style="background-color:rgb(40, 131, 22); color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="inner">
            <h3><?php echo $totalServices; ?></h3> 
            <p>services</p>
        </div>
        <div class="icon">
            <i class="ion-ios-briefcase"></i>
</div>
  </div>
    </div>
<div class="col-lg-3 col-xs-6">
<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "bajeh";  
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT COUNT(*) AS total_prestataires FROM prestateurs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPrestataires = $row['total_prestataires'];
} else {
    $totalPrestataires = 0;  
}

$conn->close();
?>
<div class="small-box" style="background-color: #FFEB3B; color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="inner">
        <h3><?php echo $totalPrestataires; ?></h3>
        <p> Prestataire</p>
    </div>
    <div class="icon">
        <i class="fa  fa-users"></i>
    </div>
</div>
</div>
<div class="col-lg-3 col-xs-6">
<?php

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "bajeh";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS total_utilisateur FROM utilisateurs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_utilisateur = $row['total_utilisateur'];  
} else {
    $total_utilisateur = 0;  
}


$conn->close();
?>
<div class="small-box" style="background-color:rgb(245, 45, 19); color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="inner">
        <h3><?php echo $total_utilisateur; ?></h3>  
        <p>utilisateur enregistré</p>  
    </div>
    <div class="icon">
       <i class="ion ion-person-add"></i>
    </div>
    </div>
</div>
</div>
</body>
</html>      
   
<?php
// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "bajeh";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom_presta = $_POST['nom_presta'];
    $prenom_presta = $_POST['prenom_presta'];
    $telephone_presta = $_POST['telephone_presta'];
    $email_presta = $_POST['email_presta'];
    $password_presta = $_POST['password_presta'];
    $sexe_presta = $_POST['sexe_presta'];
    $id_service = $_POST['id_service'];
    $experience = $_POST['experience'];

    // Gérer l'upload de la photo
    if (isset($_FILES['photo_presta']) && $_FILES['photo_presta']['error'] == 0) {
        // Vérification du type de fichier (doit être une image)
        $file_type = mime_content_type($_FILES['photo_presta']['tmp_name']);
        if (strpos($file_type, 'image') !== false) {
            // Lire le contenu du fichier
            $photo_presta = file_get_contents($_FILES['photo_presta']['tmp_name']);
        } else {
            die("Le fichier téléchargé n'est pas une image valide.");
        }
    } else {
        die("Aucune photo téléchargée ou une erreur lors du téléchargement.");
    }

    // Préparer la requête SQL d'insertion
    $sql = "INSERT INTO prestateurs (nom_presta, prenom_presta, telephone_presta, email_presta, password_presta, sexe_presta, photo_presta, id_service, experience) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Préparer la déclaration SQL
    $stmt = $conn->prepare($sql);

    // Lier les paramètres
    $stmt->bind_param("sssssssis", $nom_presta, $prenom_presta, $telephone_presta, $email_presta, $password_presta, $sexe_presta, $photo_presta, $id_service, $experience);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "<div class='message'>Prestataire enregistré avec succès !</div>";
    } else {
        echo "<div class='error'>Erreur lors de l'enregistrement du prestataire.</div>";
    }

    // Fermer la déclaration
    $stmt->close();
}

// Récupérer les services disponibles pour le champ de sélection
$sql_service = "SELECT id_service, nom_service FROM service";
$result_service = $conn->query($sql_service);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'enregistrement prestataire</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Deux colonnes égales */
            gap: 10px; /* Réduire l'espace entre les éléments */
        }

        label {
            font-size: 14px;
            color: #555;
            font-weight: bold;
            margin: 0; /* Réduire les marges des labels */
            align-self: center;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"], select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }

        input[type="submit"] {
            grid-column: span 2; /* Le bouton s'étend sur deux colonnes */
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .message {
            font-size: 16px;
            text-align: center;
            color: green;
            margin-top: 20px;
        }

        input[type="file"] {
            grid-column: span 2; /* La photo prend aussi toute la largeur */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Enregistrer un Prestataire</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Nom et Prénom côte à côte -->
            <label for="nom_presta">Nom :</label>
            <input type="text" id="nom_presta" name="nom_presta" required>

            <label for="prenom_presta">Prénom :</label>
            <input type="text" id="prenom_presta" name="prenom_presta" required>

            <!-- Téléphone et Email côte à côte -->
            <label for="telephone_presta">Téléphone :</label>
            <input type="text" id="telephone_presta" name="telephone_presta" required>

            <label for="email_presta">Email :</label>
            <input type="email" id="email_presta" name="email_presta" required>

            <!-- Mot de passe et Sexe côte à côte -->
            <label for="password_presta">Mot de passe :</label>
            <input type="password" id="password_presta" name="password_presta" required>

            <label for="sexe_presta">Sexe :</label>
            <select name="sexe_presta" id="sexe_presta" required>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>

            <!-- Service et Expérience côte à côte -->
            <label for="id_service">Service :</label>
            <select name="id_service" id="id_service" required>
                <?php
                // Afficher les services disponibles dans le champ de sélection
                if ($result_service->num_rows > 0) {
                    while($row = $result_service->fetch_assoc()) {
                        echo "<option value='".$row['id_service']."'>".$row['nom_service']."</option>";
                    }
                } else {
                    echo "<option>Aucun service disponible</option>";
                }
                ?>
            </select>

            <label for="experience">Expérience :</label>
            <input type="text" id="experience" name="experience" required>

            <!-- Photo en une seule colonne -->
            <label for="photo_presta">Photo :</label>
            <input type="file" name="photo_presta" id="photo_presta" required>

            <!-- Le bouton en bas qui prend toute la largeur -->
            <input type="submit" value="Enregistrer">
        </form>
    </div>

</body>
</html>
