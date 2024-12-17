<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Page administrateur | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
 
  
    <link href="css developper/hometask.min.css" rel="stylesheet" type="text/css" />  <link href="css developper/bootstrap.min.css" rel="stylesheet" type="text/css" />    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /><!-- Ionicons 2.0.0 --><link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    


<style>
        .main-header {
            background-color: black;  /* Couleur rouge vif */
            color: #FFFFFF;             /* Texte blanc */
        }

    </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
         
       
        <a href="index2.html" class="logo"  style="color: white;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check" viewBox="0 0 16 16">
  <path d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708z"/>
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514"/>
</svg><i class="bi bi-house-check"></i>&nbsp;<b>HOME TASK </b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
session_start();
$servername = "127.0.0.1";
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "bajeh";

// Créer la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'admin est connecté (si l'email est en session)
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Requête pour récupérer l'image de l'admin depuis la base de données
    $sql = "SELECT photo_admin FROM admin WHERE email_admin = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo_admin = $row['photo_admin'];

        // Si une image est trouvée, on l'affiche en base64
        if ($photo_admin) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($photo_admin) . '" class="user-image" alt="User Image" />';
        } else {
        
        }
    } else {
        // Si aucun utilisateur n'est trouvé (ce qui ne devrait pas arriver après la connexion)
        echo '<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />';
    }
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Fermer la connexion à la base de données
$conn->close();
?>

  
                  <span class="hidden-xs">     <?php


if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    // Si l'email ou le mot de passe ne sont pas définis dans la session, redirige vers la page de connexion
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$servername = "127.0.0.1";
$username = "root"; // Votre nom d'utilisateur MySQL
$password = ""; // Votre mot de passe MySQL
$dbname = "bajeh";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'email et le mot de passe de la session
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Requête SQL pour obtenir les informations de l'admin correspondant à l'email et au mot de passe
$sql = "SELECT prenom_admin, nom_admin FROM admin WHERE email_admin = '$email' AND password_admin = '$password'";
$result = $conn->query($sql);

// Vérifier si l'admin existe dans la base de données
if ($result->num_rows > 0) {
    // Si l'admin est trouvé, récupérer son prénom et nom
    $row = $result->fetch_assoc();
    $prenom_admin = $row['prenom_admin'];
    $nom_admin = $row['nom_admin'];

    // Afficher le nom et le prénom
    echo "<span style='color: white;'>$prenom_admin $nom_admin</span>";

} else {
    echo "<p>Admin non trouvé ou information incorrecte.</p>";
}

$conn->close();
?>
</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                   
                    <?php

$servername = "127.0.0.1";
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "bajeh";

// Créer la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'admin est connecté (si l'email est en session)
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Requête pour récupérer l'image de l'admin depuis la base de données
    $sql = "SELECT photo_admin FROM admin WHERE email_admin = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo_admin = $row['photo_admin'];
       
        // Si une image est trouvée, on l'affiche en base64
        if ($photo_admin) {
            echo '<img src ="data:image/jpeg;base64,' . base64_encode($photo_admin) . '" class="img-circle" alt="User Image" />';
        } else {
        
        }
    } else {
        // Si aucun utilisateur n'est trouvé (ce qui ne devrait pas arriver après la connexion)
        echo '<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />';
    }
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: login.php");
    exit();
}

// Fermer la connexion à la base de données
$conn->close();
?>

                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                  
                    <div class="pull-right">
                      <a href="../connexion.php" class="btn btn-default btn-flat">se deconnecté</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            
            <div class="pull-left info">

              
            </div>
          </div>
  
        <ul class="sidebar-menu" style="background-color: black; color: white; margin-top: -30px; margin-bottom: 20px; width: 100%;">
       
 
            <li class="header"></li>
            <li class="active treeview">
              <a href="admin.php">
                <i class="fa fa-dashboard"  style="color: white;"></i> <span  style="color: white;">Dashboard</span> 
              </a>
             
            </li>
            <li class="treeview">
          
            </li>
         <br>
         <br>
         <br>
         <br>
            <li>
              <a href="service.php">
                <i class="fa fa-th" style="color: white;"></i> <span style="color: white;">Services</span> <small class="label pull-right bg-green"></small>
              </a>
              <br>
            </li>
            <li>
              <a href="ajouter_presta.php">
                <i class="fa  fa-users" style="color: white;"></i> <span style="color: white;">Prestataires</span> <small class="label pull-right bg-green"></small>
              </a>
              <br>
              
            </li>
            <li>
              <a href="utilisateur.php">
                <i class="fa  fa-user" style="color: white;"></i> <span style="color: white;">utilisateurs</span> <small class="label pull-right bg-green"></small>
              </a>
            </li>
           
           
            <li><a ><i ></i> </a></li>
            <li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li><li><a ><i ></i> </a></li>
          </ul>
         
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
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
<div class="small-box bg-aqua">
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
    <div class="small-box bg-green">
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
$username = "root";  // Change ceci en fonction de ton utilisateur MySQL
$password = "";      // Change ceci en fonction de ton mot de passe MySQL
$dbname = "bajeh";   // Nom de ta base de données

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
<div class="small-box bg-yellow">
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
<div class="small-box bg-red">
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

           
         
   <!-- jQuery 2.1.3 -->
   <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
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

// Récupérer l'ID du service si présent dans l'URL
$id_service = isset($_GET['id_service']) ? $_GET['id_service'] : null;

// Récupérer les services
$query_services = "SELECT * FROM service";
$result_services = $conn->query($query_services);

// Vérifier si un service est à modifier
$service_to_edit = null;
if (isset($_GET['id_service_edit'])) {
    $id_service_edit = $_GET['id_service_edit'];
    $stmt_edit = $conn->prepare("SELECT * FROM service WHERE id_service = ?");
    $stmt_edit->bind_param("i", $id_service_edit);
    $stmt_edit->execute();
    $result_edit = $stmt_edit->get_result();
    if ($result_edit->num_rows > 0) {
        $service_to_edit = $result_edit->fetch_assoc();
    } else {
        $error_message = "Service non trouvé.";
    }
}

// Ajouter un service (Insert)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nom_service = $_POST['nom_service'];
    $stmt = $conn->prepare("INSERT INTO service (nom_service) VALUES (?)");
    $stmt->bind_param("s", $nom_service);
    if ($stmt->execute()) {
        $success_message = "Service ajouté avec succès !";
    } else {
        $error_message = "Erreur lors de l'ajout du service.";
    }
}

// Modifier un service (Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id_service = $_POST['id_service'];
    $nom_service = $_POST['nom_service'];

    $stmt = $conn->prepare("UPDATE service SET nom_service = ? WHERE id_service = ?");
    $stmt->bind_param("si", $nom_service, $id_service);
    if ($stmt->execute()) {
        $success_message = "Service modifié avec succès !";
        // Réinitialiser le formulaire
        $service_to_edit = null;
    } else {
        $error_message = "Erreur lors de la modification du service.";
    }
}

// Supprimer un service (Delete)
if (isset($_GET['delete'])) {
    $id_service = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM service WHERE id_service = ?");
    $stmt->bind_param("i", $id_service);
    if ($stmt->execute()) {
        $success_message = "Service supprimé avec succès !";
    } else {
        $error_message = "Erreur lors de la suppression du service.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Services</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .table th, .table td {
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .btn-custom {
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
        }
        .btn-return:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">Gestion des Services</h1>

    <!-- Message de succès ou d'erreur -->
    <?php if ($success_message): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
    <?php elseif ($error_message): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>

    <!-- Formulaire pour ajouter un service -->
    <h3>Ajouter un Service</h3>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nom_service" class="form-label">Nom du service</label>
            <input type="text" class="form-control" id="nom_service" name="nom_service" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary btn-custom">Ajouter</button>
    </form>

    <h3 class="mt-4">Liste des Services</h3>
    <table class="table table-bordered table-striped">
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
                        <a href="?id_service_edit=<?= $row['id_service'] ?>" class="btn btn-warning btn-custom btn-sm">Modifier</a>
                        <a href="?delete=<?= $row['id_service'] ?>" class="btn btn-danger btn-custom btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Formulaire de modification de service -->
    <?php if ($service_to_edit): ?>
        <h3>Modifier le Service</h3>
        <form method="POST" action="">
            <input type="hidden" name="id_service" value="<?= $service_to_edit['id_service'] ?>">
            <div class="mb-3">
                <label for="nom_service" class="form-label">Nom du service</label>
                <input type="text" class="form-control" id="nom_service" name="nom_service" value="<?= $service_to_edit['nom_service'] ?>" required>
            </div>
            <button type="submit" name="edit" class="btn btn-primary btn-custom">Modifier</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
