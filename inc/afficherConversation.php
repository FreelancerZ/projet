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
        require_once "recupConversations.php";
        $messages = recupConversation($conv);
        $destinataire = 0;
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
                    echo "<tr><td class='msgg'>{$messages[$i][3]}<br><span class=\"msg_petit\">[$date] {$messages[$i][1]}{$messages[$i][0]}</span><br></td><td></td></tr>";
                }
                echo "<span class=\"msg_cb\"></span>";
            }
            if ($messages[0][4] == $_SESSION['id']) {
                $destinataire = $messages[0][5];
            } else {
                $destinataire = $messages[0][4];
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
    }