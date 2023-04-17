<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../inscription/styles.css">
    <title>Document</title>
</head>

<body>
    <section id="all">
        <div class="shape__smll"> </div>
        <div class="shape__big_1"> </div>
        <div class="shape__big_2"> </div>
        <div id="div-gauche">
            <div>
                <p>Connecter vous a votre compte pour avoir accès au site de réservation du matériel</p>
            </div>
            <div class="div-perssonage">
                <img src="ressources/perssonage.png" alt="">
            </div>
            <div class="iut-logo">
                <img src="ressources/iut-logo.png" alt="">
            </div>
        </div>

        <div id="forms">
            <div class="login-register">
                
                <a href="../connexion/index.ph" class="active">Connexion</a>
                <a href="../inscription/index.php" class="not-active">Inscription</a>
         
            </div>

           
            <form action="index.php" method="POST">
                <div class="input">
                    <div class="label email">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="John.wick@gmail.com"  value="<?php if(!empty($_POST['email'])){echo$_POST['email'];}?>">
                        <div class="erreur_email"></div>
                    </div>
                        <div class="label mdp">
                            <label for="mot_de_passe">Mot de passe:</label>
                            <input class="width-ltl-form" type="password" id="mot_de_passe" name="mdp" placeholder="6+ caractères"  value="<?php if(!empty($_POST['mdp'])){echo$_POST['mdp'];}?>">
                            <div class="erreur_mdp"></div>
                        </div>
                </div>
                <div class="submit-container"> <!-- Ajouter une div parentsubmite pour centrer l'input "S'inscrire" -->
                    <input class="submit" type="submit" name="confirmer" value="Se connecter">
                </div>
            </form>
        </div>
    </section>
    <?php
    if (!empty($_POST['confirmer'])) {
        if (!empty($_POST['email'])) {
                $email = $_POST['email'];
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_email')[0].innerHTML = "! Saisissez votre e-mail";
            </script>
            <?php
        }
        if (!empty($_POST['mdp'])) {
            $mdp = $_POST['mdp'];
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_mdp')[0].innerHTML = "! Saisissez votre mot de passe";
            </script>
        <?php
        }
        include $path . "../table.php";
    if (!empty($email) && !empty($mdp)) {
    $results = table(
        "Select * from user where email = :email and  mdp = :mdp;",
        [
            'email' => $_POST["email"],
            'mdp' => hash("sha256", $_POST['mdp']),
        ]);
        if($results->rowCount()>0){
            while($row =  $results = $getinfo->fetchAll(PDO::FETCH_ASSOC)){
        header('Location: ../page-principale/index.php');
        $_SESSION['a'] = 1;}
    
/*
        if (!empty($email) && !empty($mdp)) {
            //$result = table("Select * from user where email = '".$email."' and  mdp = '".hash("sha256", $mdp)."'"); 
            header('Location: ../page-principale/index.php');
            while (mysqli_fetch_assoc($result)) {
                  $_SESSION['a'] = 1;
            }*/
        }
        
    }}
        ?>
</body>
</html>