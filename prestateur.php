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
// Récupérer l'ID du service si présent dans l'URL
$id_service = isset($_GET['id_service']) ? $_GET['id_service'] : null;
// Récupérer les services pour le formulaire
$query_services = "SELECT * FROM service";
$result_services = $conn->query($query_services);
// Récupérer les prestataires en fonction du service sélectionné
$query_prestataires = "SELECT * FROM prestateurs WHERE id_service = ?";
$stmt_prestataires = $conn->prepare($query_prestataires);
if ($stmt_prestataires === false) {
    die('Erreur de préparation de la requête : ' . $conn->error);
}
$stmt_prestataires->bind_param("i", $id_service);
$stmt_prestataires->execute();
$result_prestataires = $stmt_prestataires->get_result();
// Vérifier si un prestataire est à modifier
$prestataire_to_edit = null;
if (isset($_GET['id_presta'])) {
    $id_presta = $_GET['id_presta'];
    $stmt_edit = $conn->prepare("SELECT * FROM prestateurs WHERE id_presta = ?");
    if ($stmt_edit === false) {
        die('Erreur de préparation de la requête de modification : ' . $conn->error);
    }
    $stmt_edit->bind_param("i", $id_presta);
    $stmt_edit->execute();
    $result_edit = $stmt_edit->get_result();
    if ($result_edit->num_rows > 0) {
        $prestataire_to_edit = $result_edit->fetch_assoc();
    } else {
        $error_message = "Prestataire non trouvé.";
    }
}
// Modifier un prestataire (Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id_presta = $_POST['id_presta'];
    $nom = $_POST['nom_presta'];
    $prenom = $_POST['prenom_presta'];
    $telephone = $_POST['telephone_presta'];
    $email = $_POST['email_presta'];
    $experience = $_POST['experience'];
    $id_service = $_POST['id_service'];
    $stmt = $conn->prepare
    ("UPDATE prestateurs SET nom_presta =?,prenom_presta =?,telephone_presta =?,email_presta =?,experience =?, id_service =? WHERE id_presta =?");
    if ($stmt === false) {
        die('Erreur de préparation de la requête de mise à jour : ' . $conn->error);
    }
    $stmt->bind_param("ssssssi", $nom, $prenom, $telephone, $email, $experience, $id_service, $id_presta);
    if ($stmt->execute()) {
        $success_message = "Prestataire modifié avec succès !";
        // Réinitialiser le formulaire
        $prestataire_to_edit = null;
    } else {
        $error_message = "Erreur lors de la modification du prestataire.";
    }
}
// Supprimer un prestataire (Delete)
if (isset($_GET['delete'])) {
    $id_presta = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM prestateurs WHERE id_presta = ?");
    if ($stmt === false) {
        die('Erreur de préparation de la requête de suppression : ' . $conn->error);
    }
    $stmt->bind_param("i", $id_presta);
    if ($stmt->execute()) {
        $success_message = "Prestataire supprimé avec succès !";
    } else {
        $error_message = "Erreur lors de la suppression du prestataire.";
    }
}
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
        h1 {
    background-color:rgb(226, 96, 10); /* Couleur de fond marron */
    color: black; /* Couleur du texte en blanc */
    padding: 10px 20px; /* Espacement à l'intérieur du cadre */
    border-radius: 50px; /* Bordures arrondies (optionnel) */
    border: 2px solid darkbrown; /* Bordure marron plus foncé autour du cadre */
    margin: 0; /* Supprimer les marges par défaut */
}
        
       
        .btn-default {
        color: #d9534f !important;
        background-color: transparent; 
        border-color: #d9534f;
        padding: 10px 20px;
        }
       .btn-default:hover {
        background-color: #d9534f;
        color: white;
        border-color: #d9534f; 
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
   

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Prestataires</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FFFFFF;
        }
        .a1b2c3d4e {
            margin-top: 30px;
        }
        .f5g6h7i8j th, .f5g6h7i8j td {
            text-align: center;
        }
        .x9y10z11a {
            background-color:rgb(27, 143, 72);
            color:rgb(238, 240, 238);
        }
        .x9y10z11b {
            background-color:rgb(255, 255, 255);
            color: #721c24;
        }
        .m12n13o14p {
            font-weight: bold;
        }
        .k15l16m17n {
            margin: 5px;
        }
        .btn-return {
            background-color: #6c757d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-return:hover {
            background-color: #5a6268;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .btn-return:focus {
            outline: none;
            border: 2px solid #007bff;
        }
    </style>
</head>
<body>
<div class="a1b2c3d4e">
    <h1 class="text-center mb-4">Gestion des Prestataires</h1>
    <!-- Message de succès ou d'erreur -->
    <?php if ($success_message): ?>
        <div class="alert x9y10z11a"><?= $success_message; ?></div>
    <?php elseif ($error_message): ?>
        <div class="alert x9y10z11b"><?= $error_message; ?></div>
    <?php endif; ?>
    <!-- Liste des prestataires -->
    <?php if ($id_service): ?>
        <h3>Liste des Prestataires pour le Service ID: <?= $id_service ?></h3>
        <table class="table f5g6h7i8j table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Expérience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <a href="admin.php" class="btn-return mt-3">Retour</a>

            <tbody>
                <?php while ($row = $result_prestataires->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nom_presta'] ?></td>
                        <td><?= $row['prenom_presta'] ?></td>
                        <td><?= $row['telephone_presta'] ?></td>
                        <td><?= $row['email_presta'] ?></td>
                        <td><?= $row['experience'] ?></td>
                        <td>
                                                <!-- Bouton pour ouvrir le modal de modification -->
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $row['id_presta'] ?>">Modifier</button>
                                                 <!-- Modal de modification -->
                                                <div class="modal fade" id="editModal<?= $row['id_presta'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                               <div class="modal-content">
                                              <div class="modal-header">
                                              <h5 class="modal-title" id="editModalLabel">Modifier Prestataire</h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                                </div>
                                              <div class="modal-body">
                                               <form method="POST" action="">
                                                <input type="hidden" name="id_presta" value="<?= $row['id_presta'] ?>">
                                                <div class="form-group">
                                                    <label for="nom_presta">Nom</label>
                                                    <input type="text" class="form-control" id="nom_presta" name="nom_presta" value="<?= $row['nom_presta'] ?>"required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom_presta">Prénom</label>
                                                    <input type="text" class="form-control" id="prenom_presta" name="prenom_presta" value="<?= $row['prenom_presta'] ?>"required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telephone_presta">Téléphone</label>
                                                    <input type="text" class="form-control" id="telephone_presta" name="telephone_presta" value="<?= $row['telephone_presta']?>"required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_presta">Email</label>
                                                    <input type="email" class="form-control" id="email_presta" name="email_presta" value="<?= $row['email_presta'] ?>"required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="experience_presta">Expérience</label>
                                                    <input type="text" class="form-control" id="experience_presta" name="experience" value="<?= $row['experience'] ?>"required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id_service">Service</label>
                                                    <select class="form-control" name="id_service" required>
                                                        <?php
                                                        $result_services->data_seek(0);
                                                        while ($service = $result_services->fetch_assoc()) {
                                                            $selected = ($service['id_service'] == $row['id_service']) ? 'selected' : '';
                                                            echo "<option value='{$service['id_service']}' $selected>{$service['nom_service']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button type="submit" name="edit" class="btn btn-primary">Modifier</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <!-- Bouton pour ouvrir le modal de confirmation de suppression -->
                             <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?= $row['id_presta'] ?>">Supprimer</button>
                             <!-- Modal de confirmation de suppression -->
                              <div class="modal fade" id="deleteModal<?= $row['id_presta'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" 
                              aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer ce prestataire ?
                                        </div>
                                        <div class="modal-footer">
                                        <a href="?delete=<?= $row['id_presta'] ?>&id_service=<?= $id_service ?>" class="btn btn-danger">
                                            Oui, supprimer</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        </div>
                                       </div>
                                     </div>
                                     </div>
                                  </td>
                                </tr>
                              <?php } ?>
                              </tbody>
                             </table>
                           <?php endif; ?>
                          </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

