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

                <a href="../connexion/index.php" class="not-active">Connexion</a>
                <a href="../inscription/index.php" class="active">Inscription</a>

            </div>
            <form action="index.php" method="POST">
                <div class="input">

                    <div class="label email">
                        <label for="email">Email :</label>
                        <input type="text" id="email" size=38 name="email" placeholder="John.wick@gmail.com" value="<?php if (!empty($_POST['email'])) {
                                                                                                                        echo $_POST['email'];
                                                                                                                    } ?>">
                        <div class="erreur_email"></div>
                    </div>


                    <div class="nom-prenom">
                        <div class="label nom">
                            <label for="nom">Nom :</label>
                            <input class="width-ltl-form" type="text" id="nom" name="nom" placeholder="Wick" value="<?php if (!empty($_POST['nom'])) {
                                                                                                                        echo $_POST['nom'];
                                                                                                                    } ?>">
                            <div class="erreur_nom"></div>
                        </div>


                        <div class="label prenom">
                            <label for="prenom">Prénom :</label>
                            <input class="width-ltl-form" type="text" id="prenom" name="prenom" placeholder="John" value="<?php if (!empty($_POST['prenom'])) {
                                                                                                                                echo $_POST['prenom'];
                                                                                                                            } ?>">
                            <div class="erreur_prenom"></div>
                        </div>

                    </div>
                    <div class="naissance-mdp">
                        <div class="label naissance">
                            <label for="date">Date de naissance :</label>
                            <input class="width-ltl-form" type="date" id="date_naissance" name="date" value="<?php /* if(!empty($_POST['date'])){echo$_POST['date'];}*/ ?>">
                            <div class="erreur_date"></div>
                        </div>

                        <div class="label mdp">
                            <label for="mdp">Mot de passe :</label>
                            <input class="width-ltl-form" type="password" id="mot_de_passe" name="mdp" placeholder="6+ caractères" onfocus="this.placeholder=''" value="<?php if (!empty($_POST['mdp'])) {
                                                                                                                                                                            echo $_POST['mdp'];
                                                                                                                                                                        } ?>">
                            <div class="erreur_mdp"></div>
                        </div>

                    </div>
                </div>
                <div class="submit-container">
                    <div id="confirm"> <input type="SUBMIT" id="submit" name="confirmer" size="18" value="S'inscrire"></div>
                </div>
            </form>
        </div>
    </section>
    <?php
    if (!empty($_POST['confirmer'])) {
        if (!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
    ?>
                <script type="text/javascript">
                    document.getElementsByClassName('erreur_email')[0].innerHTML = "! E-mail incorrect";
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_email')[0].innerHTML = "! Saisissez votre e-mail";
            </script>
            <?php
        }
        if (!empty($_POST['mdp'])) {
            $mdplength = strlen($_POST['mdp']);
            if ($mdplength >= 6) {
                $mdp = $_POST['mdp'];
            } else {
            ?>
                <script type="text/javascript">
                    document.getElementsByClassName('erreur_mdp')[0].innerHTML = "! 6 caractères minimum requis";
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_mdp')[0].innerHTML = "! Saisissez un mot de passe ";
            </script>
        <?php
        }
        if (!empty($_POST['nom'])) {
            $nom = $_POST['nom'];
        } else {
        ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_nom')[0].innerHTML = "! Saisissez votre nom";
            </script>
        <?php
        }
        if (!empty($_POST['prenom'])) {
            $prenom = $_POST['prenom'];
        } else {
        ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_prenom')[0].innerHTML = "! Saisissez votre prénom";
            </script>
        <?php
        }
        if (!empty($_POST['date'])) {
            $date = $_POST['date'];
        } else {
        ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_date')[0].innerHTML = "! Saisissez votre date de naissance";
            </script>

    <?php
        }
        include  "../table.php";
        if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($date) && !empty($mdp)) {
            $results = table(
                "INSERT INTO utilisateur ('nom', 'prenom', 'email', 'password', 'date_de_naissance', 'role') VALUES(:nom, :prenom, :email, :mdp, :date, '0' );",
                [
                    'nom' => $_POST["nom"],
                    'prenom' => $_POST["prenom"],
                    'email' => $_POST["email"],
                    'mdp' => hash("sha256", $_POST['mdp']),
                    'date' => $_POST["date"]
                ]
            );
            if ($results->rowCount() > 0) {
                while ($row =  $results = $getinfo->fetchAll(PDO::FETCH_ASSOC)) {
                    header('Location: ../page-principale/index.php');
                    $_SESSION['a'] = 1;
                }
            }
        }
    }
    ?>
</body>

</html>