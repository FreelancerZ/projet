<div class="rightpart">
    <div class="right" style="padding-bottom:0px;">
        <header class="head_div">
            MESSAGERIE
        </header>
        <article>
            <div class="conteneur_contrats">
                <?php
                    require "inc/afficherConversation.php";
                    afficherConversation($_GET['m']);
                ?>
            </div>
        </article>
    </div>
</div>