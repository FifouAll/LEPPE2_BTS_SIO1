<?php
class Compte extends Acces 
{
	protected $login;
	protected $motDePasse;
	protected $dateChangementMDP;
	
	// le service associé si il existe
	protected $leService;

	
	public function __construct($login, $mdp, $dateChangementMDP)
    {
        $this->login = $login;
        $this->motDePasse = $mdp;
        $this->dateChangementMDP = $dateChangementMDP;
    }

	/*
	* Renverra sous la forme d'une chaîne la concaténation des attributs de la classe
	* Exemple : 
	* Compte Mail professionnel - 01/12/2018 - eric.dondelinger@ac-nancy-metz.fr - 1234 - 15/10/2018
	*/
    public function afficher()
    {
		return 'Compte '.$this->nom.' - '.$this->date.' - '.$this->login.' - '.$this->motDePasse.' - '.$this->dateChangementMDP;
	}

	/**
	* GETTERS ET SETTERS
	*/
    public function getLogin() {
        return $this->login;
	}
	public function getMotDePasse() {
        return $this->motDePasse;
	}
	public function getDateChangementMDP() {
        return $this->dateChangementMDP;
	}
	public function getLeService(){
		return $this->leService;
	}
	
	public function setLogin($l) {
        $this->login = $l;
	}
	public function setMotDePasse($m) {
        $this->motDePasse = $m;
	}
	public function setDateChangementMDP($d) {
        $this->dateChangementMDP = $d;
	}
	public function setLeService($s) {
        $this->leService = $s;
	}
	
	/*
	* Vérification de la robustesse du MDP
	*/
	public function testerMotDePasse()
	{
		if(strlen($this->motDePasse) <= 8) 
		{
	    	return 0;//mot de passe trop court
		}
		else if(preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $this->motDePasse))
		{
			return 3;//mot de passe fort [composé de lettre (min et maj), numéro  et caractère spécial]
		}
		else if((preg_match('#^(?=.*[a-z])(?=.*[0-9])#', $this->motDePasse) || (preg_match('#^(?=.*[A-Z])(?=.*[0-9])#', $this->motDePasse))))
		{
			return 2;//mot de passe correct [composé de lettre et numéro]
		}
		else if(preg_match('#^(?=.*\W)#', $this->motDePasse))
		{
			return 2;//mot de passe correct [composé de caractère spéciaux]
		}
		else
		{
			return 1;//mot de passe trop faible
		}
	}
	/*
	* Vérification si le MDP a été changé depuis moins de 3 mois
	*/
	public function verifierObsolescence()
	{
		$dateChange = new DateTime($this->dateChangementMDP);
		$dateChange = $dateChange->format('Y-m-d');
		$dateChange = new DateTime($dateChange);
		$today = new DateTime();
		$today = $today->format('Y-m-d');
		$today = new DateTime($today);

		$diff = $today->diff($dateChange);
		$diff = $diff->format('%m');
		return $diff;
	}
}

?>