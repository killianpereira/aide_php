<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!empty($_SESSION['a']) && !empty($_SESSION['a'] == 1)){
?>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles.css">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
   <title>Document</title>
</head>

<body>
   <div class="shape__smll"> </div>
   <div class="shape__big_1"> </div>
   <div class="shape__big_2"> </div>

   <section id="all">
      <div id="div-gauche">
         <div>
            <p>Réservé votre matériel </p>
         </div>
         <div class="div-perssonage">
            <img src="ressources/calender-dynamic-color.png" alt="">
         </div>
         <div class="iut-logo">
            <img src="ressources/iut-logo.png" alt="">
         </div>
      </div>

      <section class="forms">
         <div>
            <h1 class="titre">Demande de réservation</h1>

            <form action="index.php" method="POST">
               <div class="label marge">
                  <label for="menu-deroulant">Matériel souhaité :</label>
                  <select id="menu-deroulant" name ="materiel">
                     <option class="option-select" value="option1">Option 1</option>
                     <option class="option-select" value="option2">Option 2</option>
                     <option class="option-select" value="option3">Option 3</option>
                  </select>
                  <div class="erreur_materiel"></div>
               </div>

               <div class="div-date">
                  <div class="label marge" id="marge-date">
                     <label for="date1">Date de début :</label>
                     <input class="date" name ="date_debut" type="date" id="date1">
                     <div class="erreur_date_debut"></div>
                  </div>
                  <div class="label marge">
                     <label for="date2">Date de fin :</label>
                     <input class="date" name ="date_fin" type="date" id="date2">
                     <div class="erreur_date_fin"></div>
                  </div>
               </div>
               <input type="SUBMIT" class="submit" name="confirmer" size="18" value="Réservé">
            </form>
         </div>
      </section>
   </section>

   <script>
      function toggleDropdown() {
         document.getElementById('dropdown-menu').classList.toggle('dropdown-menu1')
      }
   </script>
   <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>


   <?php
   if (!empty($_POST['confirmer'])) {
        if (!empty($_POST['materiel'])) {
            $materiel = $_POST['materiel'];
        } else {
            ?>
            <script type="text/javascript">
                document.getElementsByClassName('erreur_materiel')[0].innerHTML = "! Saisissez un matériel";
            </script>
        <?php
        }
        if (!empty($_POST['date_debut'])) {
         $date_debut = $_POST['date_debut'];
     } else {
         ?>
         <script type="text/javascript">
             document.getElementsByClassName('erreur_date_debut')[0].innerHTML = "! Saisissez une date de début";
         </script>
     <?php
            }
            if (!empty($_POST['date_fin'])) {
               $date_fin = $_POST['date_fin'];
           } else {
               ?>
               <script type="text/javascript">
                   document.getElementsByClassName('erreur_date_fin')[0].innerHTML = "! Saisissez une date de fin";
               </script>
           <?php
           }
           include $path . "../table.php";
           if (!empty($materiel) && !empty($date_debut) && !empty($date_fin)) {
               $result = table(
                   "Insert into demande ( 'type', 'date_debut', 'date_fin') value(:materiel, :date_debut, :date_fin, );",
                   [
                       'materiel' => $_POST["materiel"],
                       'date_debut' => $_POST["date_debut"],
                       'date_fin' => $_POST["date_fin"],
                   ]
               );
               header('Location: ../reservation/index.php');             
               }
         }
      }
        ?>
</body>
</html>