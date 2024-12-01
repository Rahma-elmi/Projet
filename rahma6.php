<?php 
$serveur="localhost";
$utilisateur="root";
$motDePasse="";
$base="rahma";

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $base);

if(!$conn){
    die ("echec de la connexion :" .mysqli_connect_error());
}
echo "connexion reussi";

$num=$_POST['Num'];
$nom=$_POST['Nom'];
$Prenom=$_POST['prenom'];
$Adresse=$_POST['adresse'];
$Email=$_POST['email'];
$password=$_POST['mdp'];


$sql="INSERT INTO utilisateur(id_user,Nom_user,prenom_user,adresse_user,email_user,password_user)values('$num','$nom','$Prenom','$Adresse','$Email','$password')";

if (mysqli_query($conn, $sql)) {
    echo "Nouveau enregistrement créé avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>