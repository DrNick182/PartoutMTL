<!-- DÉBUT DE LA PAGE SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------->

<section class="soumissionAdmin">
    <h1>AJOUTER UNE OEUVRE</h1>
    <section class="soumissionAdminFormulaire">
        <label for="titreOeuvreAjoutAdmin"><span class="couleurErreurSoumission">TITRE : </span></label>
        <input type="text" name="titreOeuvreAjout" id="titreOeuvreAjoutAdmin" 
            <?php 
                 if(isset($_GET["idSoumissionUsager"]))
                 {
                    ?>
				    value="<?php echo $data['titreSoumission']; ?>"
				    <?php
			     }
            ?>
        />
        <label for="titreVarianteOeuvreAjoutAdmin">TITRE VARIANTE : </label>
        <input type="text" name="titreVarianteOeuvreAjout" id="titreVarianteOeuvreAjoutAdmin"/>
