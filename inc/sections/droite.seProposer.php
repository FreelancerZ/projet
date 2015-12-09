<div class="rightpart">
    <div class="right">
        <header class="head_div">
           SE PROPOSER
        </header>
        <article>

            <p>
			<div class="div_cr_contrat" >
                <form action="" method="post">
				<table>
					<tr>
						<th>
							<label for="description">Description détaillée : </label><br>
						</th>
						<td>
							<textarea placeholder="..." rows="15" cols="80" style="background-color: #f2f2f2;" name="desc"></textarea><br>
						</td>
					</tr>
				</table>
                <input id="btn_creer" type="submit" value="SE PROPOSER">
                </form>
				<?php
					if (isset($_POST) && !empty($_POST) && isset($_GET['c']) && is_numeric($_GET['c'])) {
						require "inc/seProposer.php";
						echo creerProposition($_GET['c'], $_POST);
					}
				?>
			</div>
        </article>
    </div>
</div>