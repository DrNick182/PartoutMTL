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
class ModeleCarroussel extends TemplateBase
{
	protected function getPrimaryKey()
	{
		return "idCaroussel";
	} 
		
	protected  function getTable()
	{
		return "Carroussel";
	}
	
	//Fonction qui va chercher les info des artistes pour construction d'une liste
	public function getPhotoCarroussel() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT * FROM Carroussel");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
}
?>