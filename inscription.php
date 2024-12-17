<STYle>
    .overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 80%; /* Ajuster la largeur si nécessaire */
}

/* Style des messages de succès */
.success-message {
    background-color: #4CAF50; /* Fond vert pour succès */
    color: white;
    padding: 20px;
    margin: 10px 0;
    border-radius: 8px;
    font-size: 18px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    margin-bottom: 20px; /* Espacement entre le message et le bouton */
}

/* Style des messages d'erreur */
.error-message {
    background-color: #F44336; /* Fond rouge pour erreur */
    color: white;
    padding: 20px;
    margin: 10px 0;
    border-radius: 8px;
    font-size: 18px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    margin-bottom: 20px; /* Espacement entre le message et le bouton */
}

/* Style du bouton de retour */
.btn-retour {
    background: linear-gradient(45deg, #ff6b6b, #ff4e4e); /* Dégradé de couleur rouge */
    color: white;
    padding: 15px 32px;
    text-align: center;
    font-size: 18px;
    border-radius: 30px;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

/* Effet au survol du bouton */
.btn-retour:hover {
    background: linear-gradient(45deg, #ff4e4e, #ff6b6b); /* Inverser le dégradé */
    transform: scale(1.05); /* Agrandir légèrement le bouton */
}

/* Effet au clic du bouton */
.btn-retour:active {
    transform: scale(0.98); /* Réduire légèrement le bouton lors du clic */
}


</STYle>
<?php 
$serveur="localhost";
$utilisateur="root";
$motDePasse="";
$base="bajeh";

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $base);

if(!$conn){
    die ("echec de la connexion :" .mysqli_connect_error());
}


$num=$_POST['Num'];
$nom=$_POST['Nom'];
$Prenom=$_POST['prenom'];
$Adresse=$_POST['adresse'];
$Email=$_POST['email'];
$password=$_POST['mdp'];


$sql="INSERT INTO utilisateurs(id_utilisateur,nom_utilisateur,prenom_utilisateur,adresse_utilisateur,email_utilisateur,password_utilisateur)values('$num','$nom','$Prenom','$Adresse','$Email','$password')";

if (mysqli_query($conn, $sql)) {
    
 
    // Message de succès avec un fond vert
        
       
    echo "<div class='overlay'><div class='success-message'>Nouveau enregistrement créé avec succès ✅</div>";
} else {
    // Message d'erreur avec un fond rouge
    echo "<div class='overlay'><div class='error-message'>Erreur : " . $sql . "<br>" . mysqli_error($conn) . " ❌</div>";
}
    mysqli_close($conn);
    
?>
<a href="connexion_rab.php"> <button class="btn-retour" type="button">Connectez-vous</button>
</a>