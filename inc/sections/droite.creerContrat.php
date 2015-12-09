<div class="rightpart">
    <div class="right">
        <header class="head_div">
         NOUVEAU CONTRAT
     </header>
     <article>

        <p>
         <div class="div_cr_contrat" >
            <form action="" method="post">
                <table>
                   <tr>
                      <th>
                         <label for="titre">Intitulé : </label>
                     </th>
                     <td>
                         <input placeholder="..." type="text" name="titre"><br>
                     </td>
                 </tr>
                 <tr>
                  <th>
                     <label for="theme">Thème : </label>
                 </th>
                 <td>
                     <input placeholder="..." type="text" name="theme"><br>
                 </td>
             </tr>
             <tr>
              <th>
                 <label for="description">Description détaillée : </label><br>
             </th>
             <td>
                 <textarea placeholder="..." rows="15" cols="80" style="background-color: #f2f2f2;" name="desc"></textarea><br>
             </td>
         </tr>
         <tr>
          <th>
             <label for="remuneration">Rémunération : </label>
         </th>
         <td>
             <input type="text" id="€" placeholder="..." name="remuneration"> € <br>
         </td>
     </tr>
     <tr>
      <th>
         <label for="competences" >Compétences requises : </label>
     </th>
     <td>
         <input for="text" placeholder="..." name="competences"><br>
     </td>
 </tr>
 <tr>
    <th>
    <label for="date_deb" >Date de début prévue : </label>
    </th>
    <td>
        <input for="date_deb" placeholder="aaaa-mm-jj" name="date_deb"><br>
    </td>
</tr>
<tr>
    <th>
    <label for="date" >Date de fin prévue : </label>
    </th>
    <td>
        <input for="date" placeholder="aaaa-mm-jj" name="date_fin"><br>
    </td>
</tr>
</table>
<input id="btn_creer" type="submit" value="PUBLIER">
</form>
<?php
if (isset($_POST) && !empty($_POST)) {
  require "inc/creerContrat.php";
  echo creerContrat($_POST);
}
?>
</div>
</article>
</div>
</div>
<script type="text/javascript">
    $(function() {
    // Add markItUp! to your textarea in one line
    // $('textarea').markItUp( { Settings }, { OptionalExtraSettings } );
    $('textarea').markItUp(mySettings);



    // You can add content from anywhere in your page
    // $.markItUp( { Settings } );
    $('.add').click(function() {
        $('#markItUp').markItUp('insert',
            {   openWith:'<opening tag>',
            closeWith:'<\/closing tag>',
            placeHolder:"New content"
        }
        );
        return false;
    });

    // And you can add/remove markItUp! whenever you want
    // $(textarea).markItUpRemove();
    $('.toggle').click(function() {
        if ($("#markItUp.markItUpEditor").length === 1) {
            $("#markItUp").markItUp('remove');
            $("span", this).text("get markItUp! back");
        } else {
            $('#markItUp').markItUp(mySettings);
            $("span", this).text("remove markItUp!");
        }
        return false;
    });
});
</script>