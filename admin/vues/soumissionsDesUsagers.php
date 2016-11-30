<!-- AFFICHAGE DES SOUMISSIONS DES USAGERS, TABLE Soumissions --------------------------------------->

<div class="afficheSoumissionsUsagers">
    <h1 class="margin100">SOUMISSIONS DES USAGERS</h1>
	<ul>
	<?php
		foreach($data as $soumission)
        {
            ?>
            <hr/>
            <li class='soumissionDesUsagers margin10-100' value="<?php echo $soumission['idSoumission']?>"> 
                SOUMISSION #        <?php echo $soumission["idSoumission"]?> <br/>
                PRÉNOM ARTISTE :    <?php echo $soumission["prenomArtisteSoumission"]?> <br/>
                NOM ARTISTE :       <?php echo $soumission["nomArtisteSoumission"]?> <br/>
                COLLECTIF :         <?php echo $soumission["collectifSoumission"]?> <br/>
                ARRONDISSEMENTS :   <?php $modeleSoumisionAdmin = new modeleSoumission();
                                     $nomArrondissementSoumissionUsager = $modeleSoumisionAdmin->obtenirNomArrondissement($soumission['idArrondissementSoumission']);
                                     echo $nomArrondissementSoumissionUsager;?><br/>      
                PARC :              <?php echo $soumission["parcSoumission"]?> <br/>
                ADRESSE CIVIQUE :   <?php echo $soumission["adresseCiviqueSoumission"]?> <br/>
                DESCRIPTION :       <?php echo $soumission["descriptionSoumission"]?> <br/>
                PHOTO :             <?php echo $soumission["photoSoumission"]?> <br/>
                COURRIEL :          <?php echo $soumission["courrielSoumission"]?> <br/>
            </li>
			<br/>
            <?php
		}
	?>
	</ul>		
</div>