<div class="rightpart">
    <div class="right">
        <header class="head_div">
        CONTRAT
        </header>
        <article>
            <?php
            require "inc/afficherContrat.php";
            if (isset($_GET['c']) && is_numeric($_GET['c'])) {
                afficherDetailsContrats($_GET['c']);
            }
            ?>
        </article>
    </div>
</div>