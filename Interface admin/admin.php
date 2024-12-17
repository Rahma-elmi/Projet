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
            src="logo.png"
            alt="HOMEtask logo"
            class="nav__logo"
            id="logo"
          />
        </a>  
        <nav class="navbar navbar-static-top" role="navigation" >         
            <div class="pull-right">
             <a href="CONNEXION.PHP.php" class="btn btn-default btn-flat">se deconnecter</a>
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
<div class="small-box" style="background-color:rgb(21, 201, 247);color:black;border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
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
<div class="small-box" style="background-color:rgb(245, 45, 19);color: black;border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
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
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "bajeh";
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT id_service, nom_service FROM service";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Services</title>
    <style>
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
<div class="container">
    <h1>Liste des Services</h1>
    <ul class="service-list">
        <?php
        // Afficher les services dans une liste avec un bouton "CONSULTER"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>
                        <span>" . $row['nom_service'] . "</span>
                        <a href='prestateur.php?id_service=" . $row['id_service'] . "' class='btn'>CONSULTER</a>
                      </li>"; }
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
</body>
</html>