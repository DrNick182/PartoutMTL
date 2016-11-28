<?php
/**
 * Class Modele
 * Mod�le de classe mod�le. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du d�partement de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
class Oeuvres extends TemplateBase 
{
	 
	protected function getPrimaryKey()
	{
		return "idOeuvre"; 
	} 
	
	
	public function getTable()
	{
		return "Oeuvres";
	}
	
	public function obtenirOeuvre($noInterne)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where noInterne = :noInterne");
			$stmt->bindParam(":noInterne", $noInterne);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function traiterOeuvre($oeuvre)
	{		
		// asignation temporel de date par default
		$oeuvre->DateFinProduction = "2012-06-18";
		$oeuvre->DateAccession = "2012-06-18";
		
		//verification pour savoir si le TitreVariante est rempli ou pas
		if($oeuvre->TitreVariante == null)
		{
						
			$oeuvre->TitreVariante = "";
		}

		//verification pour savoir si le ModeAcquisition est rempli ou pas
		if($oeuvre->ModeAcquisition == null)
		{			
			$oeuvre->ModeAcquisition = "";
		}
		
		//verification pour savoir si le Materiaux est rempli ou pas
		if($oeuvre->Materiaux == null)
		{			
			$oeuvre->Materiaux = "";
		}
		
		//verification pour savoir si le Materiaux est rempli ou pas
		if($oeuvre->Technique == null)
		{
			$oeuvre->Technique = "";
		}
		
		//verification pour savoir si le Dimensions est rempli ou pas
		if($oeuvre->DimensionsGenerales == null)
		{		
			$oeuvre->DimensionsGenerales = "";
		}
		
		//verification pour savoir si le Parc est rempli ou pas
		if($oeuvre->Parc == null)
		{	
			$oeuvre->Parc = "";
		}
		
		//verification pour savoir si le Batiment est rempli ou pas
		if($oeuvre->Batiment == null)
		{			
			$oeuvre->Batiment = "";
		}
		
		//verification pour savoir si le AdresseCivique est rempli ou pas
		if($oeuvre->AdresseCivique == null)
		{		
			$oeuvre->AdresseCivique = "";
		}
		
		$insertion = $this->insererOeuvre
		(
			$oeuvre->Titre,
			$oeuvre->TitreVariante,
			$oeuvre->DateFinProduction,
			$oeuvre->DateAccession,
			$oeuvre->NomCollection,
			$oeuvre->ModeAcquisition,
			$oeuvre->Materiaux,
			$oeuvre->Technique,
			$oeuvre->DimensionsGenerales,
			$oeuvre->Parc,$oeuvre->Batiment,
			$oeuvre->AdresseCivique,
			$oeuvre->CoordonneeLatitude,
			$oeuvre->CoordonneeLongitude,
			$oeuvre->NumeroAccession,
			$oeuvre->NoInterne
		);
		
		$oCategorie = new Categories();
		$idCat = $oCategorie->obtenirCategorie($oeuvre->SousCategorieObjet);
		
		$oArrondissements = new Arrondissements();
		$idArron = $oArrondissements->obtenirArrondissement($oeuvre->Arrondissement);
		
		// une fois que je viens d'obtenir les Id necessaires, on va finir l'insertion de donn�s pour l'oeuvre respective
		$insertion = $this->completerOeuvre($oeuvre->NoInterne,$idCat["idCategorie"],$idArron["idArrondissement"]);
		
		
		//insertion de donnes sur la table artistesoeuvres
		foreach($oeuvre->Artistes as $artiste)
		{
			$oArtistes = new Artistes();
			$idArt = $oArtistes->obtenirArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
			$idOeuvre = $this->obtenirOeuvre($oeuvre->NoInterne);
			$insertion = $this->insererArtistesOeuvres($idArt["idArtiste"],$idOeuvre["idOeuvre"]);
		}
	}
	
	public function insererOeuvre
	(
		$titre,
		$titrevar,
		$dateFin,
		$dateAcc,
		$nomCol,
		$modeAcq,
		$material,
		$tech,
		$dimension,
		$parc,
		$batiment,
		$addCiv,
		$lat,
		$longu,
		$numAcc,
		$numInt
	)
	{
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ". $this->getTable() ."
			(
				titre,
				titreVariante,
				dateFinProduction,
				dateAccession,
				nomCollection,
				modeAcquisition,
				materiaux,
				technique,
				dimensions,
				parc,
				batiment,
				adresseCivique,
				latitude,
				longitude,
				numeroAccession,
				noInterne
			) 
			VALUES
			(
				:titre,
				:titreVariante,
				:dateFinProduction,
				:dateAccession,
				:nomCollection,
				:modeAcquisition,
				:materiaux,
				:technique,
				:dimensions,
				:parc,
				:batiment,
				:adresseCivique,
				:latitude,
				:longitude,
				:numeroAccession,
				:noInterne
			)");
			
			$stmt->bindParam(":titre"				, $titre);
			$stmt->bindParam(":titreVariante"		, $titrevar);
			$stmt->bindParam(":dateFinProduction"	, $dateFin);
			$stmt->bindParam(":dateAccession"		, $dateAcc);
			$stmt->bindParam(":nomCollection"		, $nomCol);
			$stmt->bindParam(":modeAcquisition"		, $modeAcq);
			$stmt->bindParam(":materiaux"			, $material);
			$stmt->bindParam(":technique"			, $tech);
			$stmt->bindParam(":dimensions"			, $dimension);
			$stmt->bindParam(":parc"				, $parc);
			$stmt->bindParam(":batiment"			, $batiment);
			$stmt->bindParam(":adresseCivique"		, $addCiv);
			$stmt->bindParam(":latitude"			, $lat);
			$stmt->bindParam(":longitude"			, $longu);
			$stmt->bindParam(":numeroAccession"		, $numAcc);
			$stmt->bindParam(":noInterne"			, $numInt);
			
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	public function completerOeuvre($numInt,$idCat,$idArron)
	{
		try
		{	
			$stmt = $this->connexion->prepare("UPDATE ". $this->getTable() ." SET idCategorie = :idCat, idArrondissement= :idArron WHERE noInterne = :numInt");
			$stmt->bindParam(":idCat"				, $idCat);
			$stmt->bindParam(":idArron"				, $idArron);
			$stmt->bindParam(":numInt"				, $numInt);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	public function insererArtistesOeuvres($idArt,$idOeuvre)
	{
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ArtistesOeuvres (idArtiste,idOeuvre) VALUES (:idArt, :idOeuvre)");
			$stmt->bindParam(":idArt"				, $idArt);
			$stmt->bindParam(":idOeuvre"			, $idOeuvre);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
}

?>