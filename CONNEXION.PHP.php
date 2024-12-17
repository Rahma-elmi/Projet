<?php 
if(isset($_POST['bouton']) ){
  session_start();

  if(isset($_POST['email']) && isset($_POST["password"])){

    $serveur = "localhost";
    $user = "root";
    $code = "";
    $base = "bajeh";
    $connexion = mysqli_connect($serveur, $user, $code, $base) or die("connexion impossible");
    $email = $_POST['email'];
    $password = $_POST['password']; 
    
    $_SESSION['email_utlisateur'] = $email;

    // Requête pour vérifier les identifiants d'utilisateur
    $query = mysqli_query($connexion, "SELECT * FROM utilisateurs WHERE email_utilisateur='$email' AND password_utilisateur='$password'");

    $num = mysqli_num_rows($query);
    
    if($num > 0){
        // L'utlisateur est trouvé, récupérer son ID
        $user = mysqli_fetch_assoc($query);
        $_SESSION['id_utilisateur'] = $user['id']; // Stocker l'ID d'utilisateur' dans la session

        // Rediriger vers la page de l'utilisateur
        header("location:../Projet-3/interface_utilisateur.php");
    } else {
        // Si l'utilisateur' n'est pas trouvé, vérifier si c'est un administrateur
        $query = mysqli_query($connexion, "SELECT * FROM admin WHERE password_admin='$password' AND email_admin='$email'");
        $num = mysqli_num_rows($query);

        if($num > 0){
            // L'administrateur est trouvé, rediriger vers la page admin
            header("location:../Projet-3/interface admin/admin.php");
        } else {
            // Identifiants incorrects
            $Error = "Adresse mail ou mot de passe incorrect";
        }
    }
  }
}
?>


<!DOCTYPE html>
<html>

<head>
<title> Connexion</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
 
<link rel="stylesheet" href="connexion_rab.css">
<link rel="icon" href="../picture/icon.png">
<style>
   
@import url('https://onts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    
  }

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


 body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: url("../picture/couverture.jfif") no-repeat;
  background-size: cover;
  background-position: center;

 }
 #errorMessage{
  padding: 10px;
  background-color: #eee;
  margin: 10px;
  color:black;
  border: 1px solid red;
}

  header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 10px 40px;
    background : white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 99;
  }
  .logo {
    left: 11px;
    top: 18;
    width: 30px;
  padding: 0px;
 margin: 0px;

  }


  .nav a {
    position: relative ;
    font-size: 1.1em;
    color: pink;
    text-decoration: none;
    font-weight: 500;
    margin-right: 40px;
  }
  .nav a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 100%;
    height: 3px;
    background: #fff;
    border-radius: 5px;
    transform: scaleX(0);
    transition: transform .5s;
  }
  .nav a:hover::after {
    transform: scaleX(1);

  }
  .nav .lo {
    width: 130px;
    height: 50px;
    background: transparent;
    border: 2px solid #fff;
    outline: none;
    border-radius: 6px;
    font-size: 1.1em;
    color: #fff;
    font-weight: 500;
    margin-left: 40px;
    transition: .5s;

  }

  .nav .lo:hover {
    background: #fff;
    color: #162938;

  }


.input-box label {

  position: absolute;
  
  top: 80%;
  
  left: -50px;
  
  transform: translateY(-450%);
  
  font-size: 1em;
  
  color: #162938;
  
  font-weight: 500;
  
  
  pointer-events: none;
  transition: .5s;
  
  }
  
  .input-box input {
  
  width: 100%;
  
  height: 100%;
  
  background: transparent;
  
  border: none;
  
  outline: none;
  font-size: 1em;
  color: black;
  font-weight: 600;
  padding: 0 35px 0 5px;
  
  
  }
  

  
  .form-box h2 {
  
  font-size: 2em;
  
  color: #135c39;
  
  text-align: center;
  }
  .input-box { 
  position: relative;
  width: 100%;
  height: 50px;
  border-bottom: 2px solid #162938;
  margin: 30px 0;
  }
  .wrapper {
  
  position: relative;
  
  width: 300px;
  
  height: 400px;
  
  background: rgb(205, 185, 141);
  
  border: 2px solid rgba(248, 4, 4, 0.5);
  
  border-radius: 20px;
  
 
  
 
  
  display: flex;
  
  justify-content: center;
  
  align-items: center;
 overflow: hidden; 
 transition: scale(0);
 transition: transform .5s ease, height .2s ease;
  
  
  }
  .wrapper .form-box.login {
    transition: transform .18s ease;
    transform: translateX(0);

  }
  .wrapper.active-lo{
    transform: scale(1);

  }
  .wrapper.active .form-box.login {
    transition: none;
    transform: translateX(-300px);

  }
  .wrapper.active .form-box.register {
    transition: transform .18s ease;
    transform: translateX(0);
  }
  .wrapper.active {
    height: 450px;
  }
  .wrapper .form-box.register {
    position: absolute;
    transition: none;
    transform: translateX(300px);

  }
  .wrapper.form-box {
  
  width: 100%;
  
  padding: 40px;
  }
.input-box .icon {
position: absolute;
right: 8px;
font-size: 1.2em;
color: #dd784d;
line-height: 57px;

  }
  .input-box input:focus~label,
  .input-box input:valid~label {
    top: -5px;
  }
  .remember-forgot {
    font-size: .9em;
    color: black;
    font-weight: 500;
    margin: -15px 0 15px;
    display: flex;
    justify-content: center;  /* Centre horizontalement */
    align-items: center;      /* Centre verticalement */
}

.remember-forgot label input {
    accent-color: pink;
    margin-left: 3px;
}

.remember-forgot a {
    color: pink;
    text-decoration: none;
}

.btn {
  width: 150px;
  height: 45px;
  background:rgb(0, 174, 255);
  border: none;
  outline: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 1em;
  color: #fff;
  font-weight: 500;
  
  display: block;        /* Pour appliquer le centering avec margin */
  margin: 0 auto;        /* Centre le bouton horizontalement */
}

  .login-register {
    font-size: .9em;
    color: black;
    text-align: center;
    font-weight: 300;
    margin: 25px 0 10px;
  }
  .login-register p a {
    color: #162938;
    text-decoration: none;
    font-weight: 600;
  }
  .login-register p a:hover {
    text-decoration: underline;

  }

 
    
  #chk{
    display: none;
}
label {
    color: rgb(0, 174, 255);
    font-size: 2.3em; 
    justify-content: center; 
    display: flex;
    margin: 60px;
    font-weight: bold; 
    cursor: pointer;
    transition: .5s ease-in-out;
 }
 .form-box-register2{
    height: 460px;
    background: #eee;
    border-radius: 60% / 10%;
    transform: translateY(-180px);
    transition: .8s ease-in-out;
 }
 .form-box-register2 label{
    color:#dd784d;
    transform: scale(.6);
    }
    
    


        .input-box1 .icon {
            position: absolute;
            right: 8px;
            font-size: 1.2em;
            color:#dd784d;
            line-height: 57px;
            
              }
              .input-box1 input:focus~label,
              .input-box1 input:valid~label {
                top: -5px;
              }
              .input-box1 { 
                position: relative;
                width: 100%;
                height: 50px;
                border-bottom: 2px solid #162938;
                margin: 30px 0;
                }
                
.input-box1 label {

    position: absolute;
    
    top: 50%;
    
    left: -50px;
    
    transform: translateY(-400%);
    
    font-size: 1em;
    
    color: #162938;
    
    font-weight: 500;
    
    
    pointer-events: none;
    transition: .5s ;
    
    }
    
    .input-box1 input {
    
    width: 100%;
    
    height: 100%;
    
    background: transparent;
    
    border: none;
    
    outline: none;
    font-size: 1em;
    color: blue;
    font-weight: 600;
    padding: 0 35px 0 5px;
    
    }



    /* Garder le premier formulaire visible */
.form-box.register{
   
    opacity: 1;
  
    transition: opacity 0.5s ease-in-out;
}

.form-box.register2{
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
    opacity: 0;
    transform: translateY(100%);
    transition: opacity 0.5s ease, transform 0.5s ease;
  
    transition: opacity 0.5s ease-in-out;
}
/* Cacher le deuxième formulaire par défaut */
.register2 {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    margin-top: 20px;
    transform: translateY(100%);
}

/* Lorsqu'on ajoute la classe active au second formulaire, l'afficher avec une transition */
.register2.active{
    display: block;
    opacity: 1;
    transform:translateY(0);
}



/* Styles de base */
.step {
    display: none;
    position: relative;
    animation: slideUp 0.5s ease forwards;
}

/* Style pour que la deuxième étape glisse par-dessus la première étape */
.register2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.9);
    padding: 40px 30px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    transform: translateY(100%);
    transition: transform 0.5s ease;
    display: none;
    opacity: 0;
}


/* Garder le titre visible */
.register h2 {
    position: relative;
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 10px;
    border-radius: 5px;
}

/* Cacher le contenu sauf le titre quand la deuxième étape est active */
.register.active.hide-content .input-box,
.register.active.hide-content .btn {
    opacity: 0;
    visibility: hidden;
}
.form-box.register.active {
    display: block;
    opacity: 1;
    transform: translate(0);
}
.form-box.login.active {
    display: none;
}
/* Animation de glissement */
@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
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
    <div class="wrapper active-lo">
        <input type="checkbox" id="chk" aria-hidden="true"></label>
       
        <div class="form-box login">
        <h2>Connexion</h2>
       
        <form action="" method="POST">
        <div class="input-box">
        <span class="icon"><ion-icon name="email"></ion-icon></span>
        <input type="email" name="email" required>
        <label>Email</label>
        </div>
           <div class="input-box">
            <span class="icon">
            <ion-icon name="password"></ion-icon></span>
            <input type="password" name="password" required>
            <label>Password</label>
            </div>
            <?php
          if(isset($Error)){
            echo "<p id='errorMessage'>".$Error."</p>" ;
          }
          ?>
                <button type="submit" class="btn" name="bouton">Login </button> 
                
                 <div class="login-register">
                <p>Don't have an account?<a href="inscription.html" class="registre"> Register</a></p>
                <p>Go back to <a href="index.html" class="registre" >Accueil</a></p>
                
                </div>
        </form>
        
    </div>
</body>
</html>