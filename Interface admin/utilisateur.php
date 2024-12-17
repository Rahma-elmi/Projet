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
      h1 {
    background-color:rgb(226, 96, 10); /* Couleur de fond marron */
    color: white; /* Couleur du texte en blanc */
    padding: 10px 20px; /* Espacement à l'intérieur du cadre */
    border-radius: 50px; /* Bordures arrondies (optionnel) */
    border: 2px solid darkbrown; /* Bordure marron plus foncé autour du cadre */
    margin: 0; /* Supprimer les marges par défaut */
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
$username = "root";  // Change ceci en fonction de ton utilisateur MySQL
$password = "";      // Change ceci en fonction de ton mot de passe MySQL
$dbname = "bajeh";   // Nom de ta base de données

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
   

  
<?php 
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

// Récupérer les utilisateurs
$query_utilisateurs = "SELECT * FROM utilisateurs";
$result_utilisateurs = $conn->query($query_utilisateurs);

// Supprimer un utilisateur (Delete)
if (isset($_GET['delete'])) {
    $id_utilisateur = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $id_utilisateur);
    if ($stmt->execute()) {
        $success_message = "Utilisateur supprimé avec succès !";
    } else {
        $error_message = "Erreur lors de la suppression de l'utilisateur.";
    }
}

// Modifier un utilisateur (Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id_utilisateur = $_POST['id_utilisateur'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $prenom_utilisateur = $_POST['prenom_utilisateur'];
    $email_utilisateur = $_POST['email_utilisateur'];
    $adresse_utilisateur = $_POST['adresse_utilisateur'];

    $stmt = $conn->prepare("UPDATE utilisateurs SET nom_utilisateur = ?, prenom_utilisateur = ?, email_utilisateur = ?, adresse_utilisateur = ? WHERE id_utilisateur = ?");
    $stmt->bind_param("ssssi", $nom_utilisateur, $prenom_utilisateur, $email_utilisateur, $adresse_utilisateur, $id_utilisateur);
    if ($stmt->execute()) {
        $success_message = "Utilisateur modifié avec succès !";
    } else {
        $error_message = "Erreur lors de la modification de l'utilisateur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
/* CSS spécifique à cette page */
body {
    background-color: #f8f9fa;  /* Fond clair */
}

.gestion-container {
    margin-top: 1px;
}

.gestion-table th, .gestion-table td {
    text-align: center;
}

/* Message de succès */
.alert-success {
    background-color: #c3e6cb; /* Couleur verte plus douce */
    color: #155724;
}

/* Message d'erreur */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

/* Espacement pour les boutons */
.btn-gestion-custom {
    margin: 5px;
}

/* Style de l'en-tête et du pied de modal */
.modal-custom .modal-header {
    background-color: #343a40;
    color: #fff;
}

.modal-custom .modal-footer {
    background-color: #f8f9fa;
}

/* Personnalisation du bouton Modifier */
.btn-modifier-custom {
    background-color: #ffc107; /* Jaune clair */
    color: black; /* Texte noir */
    border: none;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
    transition: background-color 0.3s ease; /* Transition douce pour l'effet de survol */
}

/* Effet de survol du bouton Modifier */
.btn-modifier-custom:hover {
    background-color: #e0a800; /* Jaune plus foncé au survol */
    color: white; /* Texte blanc au survol */
}

/* Personnalisation du bouton Supprimer */
.btn-danger {
    background-color: #dc3545; /* Rouge */
    color: white;
    border: none;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
}

/* Effet de survol du bouton Supprimer */
.btn-danger:hover {
    background-color: #c82333; /* Rouge plus foncé au survol */
}

    </style>
</head>
<body>

<div class="container gestion-container">
    <h1 class="text-center mb-4">Gestion des Utilisateurs</h1>

    <!-- Message de succès ou d'erreur -->
    <?php if ($success_message): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
    <?php elseif ($error_message): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>

    
    <table class="table table-bordered table-striped gestion-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_utilisateurs->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['nom_utilisateur'] ?></td>
                    <td><?= $row['prenom_utilisateur'] ?></td>
                    <td><?= $row['email_utilisateur'] ?></td>
                    <td><?= $row['adresse_utilisateur'] ?></td>
                    <td>
                        <!-- Bouton Modifier avec la nouvelle couleur jaune -->
                        <button class="btn btn-modifier-custom btn-sm btn-gestion-custom" 
                                data-bs-toggle="modal" data-bs-target="#modalEditUser"
                                data-id="<?= $row['id_utilisateur'] ?>"
                                data-nom="<?= $row['nom_utilisateur'] ?>"
                                data-prenom="<?= $row['prenom_utilisateur'] ?>"
                                data-email="<?= $row['email_utilisateur'] ?>"
                                data-adresse="<?= $row['adresse_utilisateur'] ?>">Modifier</button>

                        <!-- Bouton Supprimer avec modal de confirmation -->
                        <button class="btn btn-danger btn-sm btn-gestion-custom" 
                                data-bs-toggle="modal" data-bs-target="#modalConfirmDelete"
                                data-id="<?= $row['id_utilisateur'] ?>">Supprimer</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="" id="confirmDeleteButton" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal de modification d'un utilisateur -->
<div class="modal fade modal-custom" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditUserLabel">Modifier l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="id_utilisateur" id="editIdUtilisateur">
                    <div class="mb-3">
                        <label for="nom_utilisateur" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom_utilisateur" id="editNomUtilisateur" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom_utilisateur" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom_utilisateur" id="editPrenomUtilisateur" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_utilisateur" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_utilisateur" id="editEmailUtilisateur" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse_utilisateur" class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="adresse_utilisateur" id="editAdresseUtilisateur" required>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Inclure Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Script pour mettre à jour le lien de confirmation de suppression avec l'ID de l'utilisateur à supprimer
    var confirmDeleteButton = document.getElementById('confirmDeleteButton');
    var deleteButtons = document.querySelectorAll('button[data-bs-target="#modalConfirmDelete"]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var utilisateurId = this.getAttribute('data-id');
            confirmDeleteButton.setAttribute('href', '?delete=' + utilisateurId);
        });
    });

    // Script pour remplir le modal de modification avec les informations de l'utilisateur
    var editModal = document.getElementById('modalEditUser');
    editModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var idUtilisateur = button.getAttribute('data-id');
        var nomUtilisateur = button.getAttribute('data-nom');
        var prenomUtilisateur = button.getAttribute('data-prenom');
        var emailUtilisateur = button.getAttribute('data-email');
        var adresseUtilisateur = button.getAttribute('data-adresse');

        document.getElementById('editIdUtilisateur').value = idUtilisateur;
        document.getElementById('editNomUtilisateur').value = nomUtilisateur;
        document.getElementById('editPrenomUtilisateur').value = prenomUtilisateur;
        document.getElementById('editEmailUtilisateur').value = emailUtilisateur;
        document.getElementById('editAdresseUtilisateur').value = adresseUtilisateur;
    });
</script>

</body>
</html>
