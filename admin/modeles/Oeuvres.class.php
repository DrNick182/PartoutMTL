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
class Oeuvres extends TemplateBase {
	
    
	/*function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}*/
	
		
	/**
	 * @access public
	 * @return Array
	 */
	 
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
		//traitement des donnes d'oeuvre (ojo...para evitar tanta conexion lo que se puede hacer meter los datos a los cuales no toca hacerle tratamiento en una consulta y despues los otros)
		
		// no se puede dato a dato con insert, porque se crea una celda con cada insert...toca insertar los datos que mas se puedan y despues mirar el tratamiento de los datos especiales
		//echo $oeuvre->NoInterne;
		//echo "<br>";
		//$insertion = $this->insererDonne("Titre",$oeuvre->Titre);//insertion de Titre
		
		
		
		//verification pour savoir si le TitreVariante est rempli ou pas
		if($oeuvre->TitreVariante == null){
						
			$oeuvre->TitreVariante = "";
		}
		
		//verification pour savoir si le DateFinProduction est rempli ou pas
		if($oeuvre->DateFinProduction == null){
						
			$oeuvre->DateFinProduction = "";
		}
		
		//verification pour savoir si le DateAccession est rempli ou pas
		if($oeuvre->DateAccession == null){
						
			$oeuvre->DateAccession = "";
		}
		
		//verification pour savoir si le ModeAcquisition est rempli ou pas
		if($oeuvre->ModeAcquisition == null){
						
			$oeuvre->ModeAcquisition = "";
		}
		
		//verification pour savoir si le Materiaux est rempli ou pas
		if($oeuvre->Materiaux == null){
						
			$oeuvre->Materiaux = "";
		}
		
		//verification pour savoir si le Materiaux est rempli ou pas
		if($oeuvre->Technique == null){
						
			$oeuvre->Technique = "";
		}
		
		//verification pour savoir si le Dimensions est rempli ou pas
		if($oeuvre->DimensionsGenerales == null){
						
			$oeuvre->DimensionsGenerales = "";
		}
		
		//verification pour savoir si le Parc est rempli ou pas
		if($oeuvre->Parc == null){
						
			$oeuvre->Parc = "";
		}
		
		//verification pour savoir si le Batiment est rempli ou pas
		if($oeuvre->Batiment == null){
						
			$oeuvre->Batiment = "";
		}
		
		//verification pour savoir si le AdresseCivique est rempli ou pas
		if($oeuvre->AdresseCivique == null){
						
			$oeuvre->AdresseCivique = "";
		}
		
		$insertion = $this->insererOeuvre($oeuvre->Titre,$oeuvre->TitreVariante,$oeuvre->DateFinProduction,$oeuvre->DateAccession,$oeuvre->NomCollection,$oeuvre->ModeAcquisition,$oeuvre->Materiaux,$oeuvre->Technique,$oeuvre->DimensionsGenerales,$oeuvre->Parc,$oeuvre->Batiment,$oeuvre->AdresseCivique,$oeuvre->CoordonneeLatitude,$oeuvre->CoordonneeLongitude,$oeuvre->NumeroAccession,$oeuvre->NoInterne);
		echo $insertion;
		
		
		//Il manque les querys avec update pour le Id categorie, Id arrondissement et la table artistes oeuvres
		/*try
		{	
			
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (noInterne,nomArtiste,prenomArtiste,collectif) values(:noInterne, :nom, :prenom, :collectif)");
			$stmt->bindParam(":noInterne", $nointerne);
			$stmt->bindParam(":nom", $nom);
			$stmt->bindParam(":prenom", $prenom);
			$stmt->bindParam(":collectif", $collectif);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}*/
	}
	
	public function insererOeuvre($titre,$titrevar,$dateFin,$dateAcc,$nomCol,$modeAcq,$material,$tech,$dimension,$parc,$batiment,$addCiv,$lat,$longu,$numAcc,$numInt){
		
		try
		{	
			
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ."(titre,titreVariante,dateFinProduction,dateAccession,nomCollection,modeAcquisition,materiaux,technique,dimensions,parc,batiment,adresseCivique,latitude,longitude,numeroAccession,noInterne) values(:titre,:titreVariante,:dateFinProduction,:dateAccession,:nomCollection,:modeAcquisition,:materiaux,:technique,:dimensions,:parc,:batiment,:adresseCivique,:latitude,:longitude,:numeroAccession,:noInterne)");
			$stmt->bindParam(":titre", $titre);
			$stmt->bindParam(":titreVariante", $titrevar);
			$stmt->bindParam(":dateFinProduction", $dateFin);
			$stmt->bindParam(":dateAccession", $dateAcc);
			$stmt->bindParam(":nomCollection", $nomCol);
			$stmt->bindParam(":modeAcquisition", $modeAcq);
			$stmt->bindParam(":materiaux", $material);
			$stmt->bindParam(":technique", $tech);
			$stmt->bindParam(":dimensions", $dimension);
			$stmt->bindParam(":parc", $parc);
			$stmt->bindParam(":batiment", $batiment);
			$stmt->bindParam(":adresseCivique", $addCiv);
			$stmt->bindParam(":latitude", $lat);
			$stmt->bindParam(":longitude", $longu);
			$stmt->bindParam(":numeroAccession", $numAcc);
			$stmt->bindParam(":noInterne", $numInt);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
		
	}
	
	/*public function insererDonne($nomCologne,$donnee){
		
		try
		{	
			
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (".$nomCologne.") values(:donnee)");
			$stmt->bindParam(":donnee", $donnee);
			$stmt->execute();
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
		
	}*/
	
	
	
	
	
}




?>