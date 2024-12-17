
<?php 
ob_start();
// Connexion à la base de données
$host = "127.0.0.1";
$user = "root";  
$password = "";  
$dbname = "bajeh";

// Créer une connexion
$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Messages
$success_message = '';
$error_message = '';

// Ajouter un service (Insert)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nom_service = $_POST['nom_service'];

    // Vérifier si le service existe déjà dans la base de données
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM service WHERE nom_service = ?");
    $stmt_check->bind_param("s", $nom_service);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_row();

    // Si le service existe déjà, on affiche un message d'erreur
    if ($row_check[0] > 0) {
        $error_message = "Ce service existe déjà dans la base de données.";
    } else {
        // Ajouter le service
        $stmt = $conn->prepare("INSERT INTO service (nom_service) VALUES (?)");
        $stmt->bind_param("s", $nom_service);
        if ($stmt->execute()) {
            $success_message = "Service ajouté avec succès !";
            // Rediriger après ajout pour éviter la soumission multiple
            header("Location: " . $_SERVER['PHP_SELF']);
            exit; // S'assurer que le script s'arrête ici après la redirection
        } else {
            $error_message = "Erreur lors de l'ajout du service.";
        }
    }
}

// Récupérer les services
$query_services = "SELECT * FROM service";
$result_services = $conn->query($query_services);

// Modifier un service (Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id_service = $_POST['id_service'];
    $nom_service = $_POST['nom_service'];

    $stmt = $conn->prepare("UPDATE service SET nom_service = ? WHERE id_service = ?");
    $stmt->bind_param("si", $nom_service, $id_service);
    if ($stmt->execute()) {
        $success_message = "Service modifié avec succès !";
    } else {
        $error_message = "Erreur lors de la modification du service.";
    }
}

// Supprimer un service (Delete)
if (isset($_GET['delete']) && isset($_GET['confirm_delete'])) {
    $id_service = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM service WHERE id_service = ?");
    $stmt->bind_param("i", $id_service);
    if ($stmt->execute()) {
        $success_message = "Service supprimé avec succès !";
    } else {
        $error_message = "Erreur lors de la suppression du service.";
    }
}
ob_end_flush();


?>
<?php
// Fermer la connexion
$conn->close();
?>
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
    color: #d9534f !important;
    background-color: transparent; /* Fond transparent par défaut */
    border-color: #d9534f; /* Bordure rouge */
    padding: 10px 20px; /* Espacement du texte dans le bouton (ajustez selon votre besoin) */
}

/* Couleur lors du survol */
.btn-default:hover {
    background-color: #d9534f; /* Fond rouge */
    color: white; /* Texte blanc */
    border-color: #d9534f; /* Bordure rouge lors du survol */
}
     /* Applique un fond noir et une couleur de texte blanche à l'ensemble de la sidebar */
.sidebar-menu {
    background-color: black;
    color: white;
    padding-top: 50px;
    padding-bottom: 50px;
    display: flex;
    flex-direction: column;
    height: 1000px;  
   
}

/* Style de chaque élément de menu */
.menu-item {
    margin-bottom: 60px;
    padding: 10px;
}
.menu-item:first-child {
    margin-top: 20px;  /* Cette ligne ajoute un espacement de 40px en haut du premier élément (Dashboard) */
}

.menu-item a {
    display: flex;
    align-items: center;
    color: white;
    text-decoration: none;
    font-size: 16px;
}
h1 {
    background-color:rgb(226, 96, 10); /* Couleur de fond marron */
    color: black; /* Couleur du texte en blanc */
    padding: 10px 20px; /* Espacement à l'intérieur du cadre */
    border-radius: 50px; /* Bordures arrondies (optionnel) */
    border: 2px solid darkbrown; /* Bordure marron plus foncé autour du cadre */
    margin: 0; /* Supprimer les marges par défaut */
}

.menu-item a:hover {
    background-color: #333;
    border-radius: 4px;
}

.menu-item i {
    margin-right: 10px;
    font-size: 18px;
}

/* Classe active pour surligner l'élément de menu sélectionné */
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
    </div>
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


      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <div class="col-lg-3 col-xs-6">
            <?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";  
$password = "";     
$dbname = "bajeh";   

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour compter le nombre de prestataires
$sql = "SELECT COUNT(*) AS total_admin FROM admin";
$result = $conn->query($sql);

// Vérifier si la requête a retourné un résultat
if ($result->num_rows > 0) {
    // Récupérer le nombre de prestataires
    $row = $result->fetch_assoc();
    $totaladmin = $row['total_admin'];
} else {
    $totaladmin = 0;  // Si aucun prestataire n'est trouvé
}

// Fermer la connexion
$conn->close();
?>

<!-- Code HTML pour afficher le nombre de prestataires -->
<div class="small-box" style="background-color:rgb(21, 201, 247); color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="inner">
        <h3><?php echo $totaladmin; ?></h3>
        <p> Administrateur </p>
    </div>
    <div class="icon">
        <i class="ion-locked"></i>
    </div>
</div>

            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <?php
    // Configuration de la connexion à la base de données
    $servername = "localhost";
    $username = "root";  
    $password = "";      
    $dbname = "bajeh";  

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Requête SQL pour compter le nombre de services
    $sql = "SELECT COUNT(*) AS total_service FROM service";
    $result = $conn->query($sql);

    // Vérifier si la requête a retourné un résultat
    if ($result && $result->num_rows > 0) {
        // Récupérer le nombre de services
        $row = $result->fetch_assoc();
        $totalServices = $row['total_service'];  // Utilisez la variable $totalServices
    } else {
        $totalServices = 0;  // Si aucun service n'est trouvé
    }

    // Fermer la connexion
    $conn->close();
    ?>

    <!-- Code HTML pour afficher le nombre de services -->
    <div class="small-box" style="background-color:rgb(40, 131, 22); color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="inner">
            <h3><?php echo $totalServices; ?></h3> <!-- Affichage du nombre de services -->
            <p>services</p>
        </div>
        <div class="icon">
            <i class="ion-ios-briefcase"></i>
        </div>
    </div>


            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "bajeh";  
// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour compter le nombre de prestataires
$sql = "SELECT COUNT(*) AS total_prestataires FROM prestateurs";
$result = $conn->query($sql);

// Vérifier si la requête a retourné un résultat
if ($result->num_rows > 0) {
    // Récupérer le nombre de prestataires
    $row = $result->fetch_assoc();
    $totalPrestataires = $row['total_prestataires'];
} else {
    $totalPrestataires = 0;  // Si aucun prestataire n'est trouvé
}

// Fermer la connexion
$conn->close();
?>

<!-- Code HTML pour afficher le nombre de prestataires -->
<div class="small-box" style="background-color: #FFEB3B; color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="inner">
        <h3><?php echo $totalPrestataires; ?></h3>
        <p> Prestataire</p>
    </div>
    <div class="icon">
        <i class="fa  fa-users"></i>
    </div>
</div>
</div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";  
$password = "";
$dbname = "bajeh";   

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour compter le nombre d'utilisateurs
$sql = "SELECT COUNT(*) AS total_utilisateur FROM utilisateurs";
$result = $conn->query($sql);

// Vérifier si la requête a retourné un résultat
if ($result->num_rows > 0) {
    // Récupérer le nombre d'utilisateurs
    $row = $result->fetch_assoc();
    $total_utilisateur = $row['total_utilisateur'];  // Correction de la variable ici
} else {
    $total_utilisateur = 0;  // Si aucun utilisateur n'est trouvé
}

// Fermer la connexion
$conn->close();
?>

<!-- Code HTML pour afficher le nombre d'utilisateurs -->
<div class="small-box" style="background-color:rgb(245, 45, 19); color: black;  border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="inner">
        <h3><?php echo $total_utilisateur; ?></h3>  <!-- Utiliser la bonne variable ici -->
        <p>utilisateur enregistré</p>  <!-- Correction de l'orthographe ici -->
    </div>
    <div class="icon">
       <i class="ion ion-person-add"></i>
    </div>
    </div>
</div>
</div>
</body>
</html>      
  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Services</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* CSS spécifique à cette page */
body {
    background-color: #f8f9fa;
}
.gestion-container {
    margin-top: 1px;
}
.gestion-table th, .gestion-table td {
    text-align: center;
}

/* Message de succès avec un vert moins clair */
.alert-success {
    background-color:rgb(234, 236, 234);  /* Couleur de fond vert clair */
    color:rgb(15, 15, 15);  /* Couleur du texte en vert foncé */
}

/* Message d'erreur */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

.btn-gestion-custom {
    margin: 5px;
}

.modal-custom .modal-header {
    background-color: #343a40;
    color: #fff;
}

.modal-custom .modal-footer {
    background-color: #f8f9fa;
}

    </style>
</head>
<body>

<div class="container gestion-container">
    <h1 class="text-center mb-4">Gestion des Services</h1>

    <!-- Message de succès ou d'erreur -->
    <?php if ($success_message): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
    <?php elseif ($error_message): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>

    <!-- Liste des services -->
    <h3>Liste des Services</h3>
    <!-- Bouton pour afficher le modal d'ajout -->
    <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalAddService">Ajouter un Service</button>
    <table class="table table-bordered table-striped gestion-table">
        <thead>
            <tr>
                <th>Nom du service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_services->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['nom_service'] ?></td>
                    <td>
                        <!-- Bouton Modifier avec données dans les attributs -->
                        <button class="btn btn-warning btn-sm btn-gestion-custom" 
                                data-bs-toggle="modal" data-bs-target="#modalEditService"
                                data-id="<?= $row['id_service'] ?>" 
                                data-nom="<?= $row['nom_service'] ?>"
                                onclick="populateEditModal(this)">Modifier</button>

                        <!-- Bouton Supprimer avec modal de confirmation -->
                        <button class="btn btn-danger btn-sm btn-gestion-custom" 
                                data-bs-toggle="modal" data-bs-target="#modalConfirmDelete"
                                data-id="<?= $row['id_service'] ?>">Supprimer</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal Ajouter Service -->
<div class="modal fade modal-custom" id="modalAddService" tabindex="-1" aria-labelledby="modalAddServiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddServiceLabel">Ajouter un Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom_service" class="form-label">Nom du service</label>
                        <input type="text" class="form-control" id="nom_service" name="nom_service" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier Service -->
<div class="modal fade modal-custom" id="modalEditService" tabindex="-1" aria-labelledby="modalEditServiceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditServiceLabel">Modifier un Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" id="edit_service_id" name="id_service">
                    <div class="mb-3">
                        <label for="edit_nom_service" class="form-label">Nom du service</label>
                        <input type="text" class="form-control" id="edit_nom_service" name="nom_service" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" name="edit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade modal-custom" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmDeleteLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce service ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="" id="confirmDeleteButton" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>

<!-- Inclure Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fonction pour mettre à jour les champs du modal avec les données du service à modifier
    function populateEditModal(button) {
        var serviceId = button.getAttribute('data-id');
        var serviceNom = button.getAttribute('data-nom');
        
        document.getElementById('edit_service_id').value = serviceId;
        document.getElementById('edit_nom_service').value = serviceNom;
    }

    // Script pour mettre à jour le lien de confirmation de suppression avec l'ID du service à supprimer
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');
    var deleteButtons = document.querySelectorAll('button[data-bs-target="#modalConfirmDelete"]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var serviceId = this.getAttribute('data-id');
            confirmDeleteButton.setAttribute('href', '?delete=' + serviceId + '&confirm_delete=true');
        });
    });
</script>

</body>
</html>



