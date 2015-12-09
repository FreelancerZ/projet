<div class="rightpart">
	<div class="right">
		<header class="head_div">
			DETAILS
		</header>
		<article>
			<?php
            $id = $_SESSION['id'];
			require "inc/afficherDetailsProfil.php";
            if (isset($_GET['p']) && is_numeric($_GET['p'])) {
                $id = $_GET['p'];
            }
			afficherDetailsProfil($id);
			?>
		</article>
	</div>
</div>