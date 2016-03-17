<?php
    function afficherConversations() {
        require_once "recupConversations.php";
        $conv = recupConversations();
        echo "<p>";
        echo "Rejoindre une conversation : <br>";
        for ($i = 0; $i < sizeof($conv); $i++) {
            echo "<a href='messagerie.php?m=".$conv[$i][0]."'>".$conv[$i][1]."</a><br/>";
        }
        echo "</p>";
    }

    function afficherConversation($conv) {
        // Clé pour traduire
        $key = "AIzaSyAwr2gVyEIZtRz7p7znc91TjqYBjxvviD4";
        require_once "recupConversations.php";
        $messages = recupConversation($conv);
        $destinataire = recupDestinataire($conv);
        echo "<div id='messages'>
                <table class=\"msg\">
                <tr>
                    <td></td><td></td>
</tr>";
        if (is_array($messages)) {
            for ($i = 0; $i < sizeof($messages); $i++) {
                $date = date("H:i", strtotime($messages[$i][2]));
                if ($_SESSION['id'] == $messages[$i][4]) {
                    echo "<tr><td></td><td class='msgd'>{$messages[$i][3]}<br><span class=\"msg_petit\"> [$date] {$messages[$i][1]}{$messages[$i][0]}</span></td></tr>";
                } else {
                    echo "<tr><td class='msgg' id=\"toTrad\">{$messages[$i][3]}<br><span class=\"msg_petit\">[$date] {$messages[$i][1]}{$messages[$i][0]}</span><br>
                           Traduire
                           <button onclick=\"translate('{$messages[$i][3]}', $i, 'en')\">anglais</button>
                           <button onclick=\"translate('{$messages[$i][3]}', $i, 'fr')\">français</button>
                           <button onclick=\"translate('{$messages[$i][3]}', $i, 'de')\">allemand</button>
                           <button onclick=\"translate('{$messages[$i][3]}', $i, 'es')\">espagnol</button>
                           <span id=\"translated$i\"></span></td><td></td></tr>";
                }
                echo "<span class=\"msg_cb\"></span>";
            }
            
        } else {
            echo "Aucun message pour le moment.";
        }
        echo "</table>
            </div>";
        echo "

            <form method='post' action=''>
                <textarea name='message' placeholder='Entrez votre message ici'></textarea><br>
                <input type='hidden' name='u2' value='$destinataire'>
                <input type='submit' value='Envoyer'>
            </form>

        ";
        ?>
        <script>
            function translate(texte, i, lang) {
                // On va charger la traduction
                $(document).ready(function() {
                    $('#translated'+i).load('translate.php?t='+texte+'&lang='+lang);
                });
            }
        </script>
<?php
    }
