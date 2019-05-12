<?php
class Service extends Acces 
{
	protected $url;
	protected $port;
	
	// Comptes associés au service
	protected $lesComptes = array();

	/*
	* Renverra sous la forme d'une chaîne la concaténation des attributs de la classe
	* Exemple : 
	* Compte FTP serveur Web - 01/12/2018 - 192.138.56.112 - 5222
	*/
    public function afficher()   // A vérifier!!
	{
		return 'Compte '.$this->nom.' - '.$this->date.' - '.$this->url.' - '.$this->port;
	}

    public function getUrl() {
        return $this->url;
	}
	public function getPort() {
        return $this->port;
	}
	public function getLesComptes(){
		return $this->lesComptes;
	}
	public function setUrl($u) {
        $this->url = $u;
	}
	public function setPort($p) {
        $this->port = $p;
	}
	public function setLesComptes($lesC) {
        $this->lesComptes = $lesC;
	}
	
	/*
	* Fonction pour ajouter un compte à un service
	* Attention : l'association est bidirectionnelle
	*/
	public function ajouterCompte($unCompte)
	{
		array_push($this->lesComptes, $unCompte);
		$unCompte->setLeService($this);
		
	}
}

?>