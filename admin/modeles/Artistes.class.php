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
class Artistes extends Modelebase {
	
    
	function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}
	
		
	/**
	 * @access public
	 * @return Array
	 */
	 
	public function getTable()
	{
		return "artistes";
	}
	
	public function obtenirArtiste($nom,$prenom,$collectif)
	{		
		try
		{	
			$connexion = $this->connexionBD();
			$stmt = $connexion->prepare("select * from " . $this->getTable() . " where nomArtiste = :nom and prenomArtiste = :prenom and collectif = :collectif");
			$stmt->bindParam(":nom", $nom);
			$stmt->bindParam(":prenom", $prenom);
			$stmt->bindParam(":collectif", $collectif);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function insererArtiste($nom,$prenom,$collectif)
	{		
		try
		{	
			$connexion = $this->connexionBD();
			$stmt = $connexion->prepare("insert into ". $this->getTable() ." (nomArtiste, prenomArtiste,collectif) values(:nom, :prenom, :collectif)");
			$stmt->bindParam(":nom", $nom);
			$stmt->bindParam(":prenom", $prenom);
			$stmt->bindParam(":collectif", $collectif);
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