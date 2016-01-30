<?php
    session_start();
// si l'user n'est pas connecté, alors on le redirige vers la page de connexion

    if (!isset($_SESSION['nom'])) {
        header("location:connexion.php");
    }
    if (isset($_POST["message"])) {
        require_once("inc/recupConversations.php");
        ecrireMessage($_POST['message'], $_GET['m'], $_POST['u2']);
    }
    include "inc/head.html";
?>

    <nav>

    </nav>
    <script type="text/javascript"src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">
        function actualise_div() {
            $(document).ready(function() {
                $('#messages').load('messagerie.php?m=<?php echo $_GET['m'];?> #messages');
            });
        }
        setInterval("actualise_div();", 5000);
    </script>
    <div class="corps">

        <!-- CORPS -->
        <!-- GAUCHE -->
        <?php include "inc/sections/gauche.profil.php"; ?>

        <!-- DROITE -->
        <?php include "inc/sections/droite.messagerie.php"; ?>

        <!-- clear both -->
        <div class="clearb"></div>
    </div>

    <!-- FOOTER -->
<?php include "inc/foot.html"; ?>