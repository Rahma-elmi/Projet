<?php 

$_SERVER="localhost";
$utilisateur="root";
$mot_de_passe="";
$base="rahma";
$connect=mysqli_connect($_SERVER,$utilisateur,$mot_de_passe,$base);


$email = $_POST["email_user"];
$mdp = $_POST["password_user"];

$query = mysqli_query($connect, "SELECT * FROM utilisateur WHERE email_user = '$email' AND password_user = '$mdp'");

if (mysqli_fetch_row($query) == 0){ 

    echo "Le nom et le mot de passe sont incorrects";
}

else {

    header("Location:page_d_acceuil.html");
    exit();
}

?>