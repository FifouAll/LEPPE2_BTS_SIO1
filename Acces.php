<?php
	abstract class Acces
	{
		protected $nom;
		protected $date;
		
	    // Force les classes filles à définir cette méthode
	    abstract protected function afficher();
			//intégration des getters /setters
	    public function getNom() 
		{
	        return $this->nom;
		}
		public function getDate() 
		{
	        return $this->date;
		}
		public function setNom($n) 
		{
	        $this->nom = $n;
		}
		public function setDate($d) 
		{
	        $this->date = $d;
		}
	}
?>