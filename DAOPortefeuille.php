<?php
	
namespace classes;
	
class DAOPortefeuille
{
	private $connection;
    
    public function __construct($connection)
    {
        $this->connection = $connection;
    }
			//faire une recherche de l'ID concerné
	public function find_serviceID($id_service)
	{
		$stmt = $this->connection->prepare
			('SELECT * FROM service Where id_service = :id_service');
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'Service');
		return $stmt->fetch();
	}
		
		
		
	public function liste_service()
	{
		$stmt = $this->connection->prepare
			('SELECT * FROM service');
		$stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'service');
			
		return $stmt->fetchAll();
	}
		
		
		
		
	public function addService($service)
	{
		if(!isset($service->id_service))
		{
			throw new \LogicException
			(
				'Problème survenu'
			);
		}
			
		$stmt = $this->connection->prepare
			(
			'INSERT INTO Service(nom,date,url,port)
			VALUES(:nom, :date, :url; :port)'
			);
			
		$stmt->bindParam(':nom', $service->nom);
		$stmt->bindParam(':date', $service->date);
		$stmt->bindParam(':url', $service->url);
		$stmt->bindParam(':port', $service->port);
			
		return $stmt->execute();
	}
		
	public function deleteServiceID($Service)
	{
		if(!isset($Service->id_service))
		{
			throw new \logicException
			(
				'Effacement impossible du service.'
			);
		}
				
		$stmt = $this->connection->prepare
			('DELETE FROM service
			WHERE id_service =: id_service');
				
		$stmt->bindParam(':id_service', $service->id_service);
		return $stmt->execute();
	}
		
		
		

	public function find_compteID($id_compte)
	{
		$stmt = $this->connection->prepare
			('SELECT * FROM compte Where id_compte = :id_compte');
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'compte');
		return $stmt->fetch();
	}
	
	
	
	public function liste_compte()
	{
		$stmt = $this->connection->prepare
			('SELECT * FROM Compte');
		$stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'Compte');
			
		return $stmt->fetchAll();
	}	
		
	public function addCompte($compte)
	{
		if(!isset($Compte->id_compte))
		{
			throw new \LogicException
			(
				'Problème survenu'
			);
		}

		$stmt = $this->connection->prepare
			('INSERT INTO compte(date,nom,login,motDePasse,dateChangementMdp,id_service)
			VALUES(:date, :nom, :url; :port, :id_service)');
			
		$stmt->bindParam(':nom', $compte->nom);
		$stmt->bindParam(':date', $compte->date);
		$stmt->bindParam(':login', $compte->login);
		$stmt->bindParam(':motDePasse', $compte->motDePasse);
		$stmt->bindParam(':dateChangementMdp',$compte->dateChangementMdp);
		$stmt->bindParam(':id_service', $compte->$getLeService()->id_service);
			
		return $stmt->execute();
	}
			//mise à jour du service
	public function updateCompte($compte)
	{
		if(!isset($Compte->id_compte))
		{
			throw new \LogicException
			(
				'Problèmes de mise à jour de la base.'
			);
		}
			
		$stmt = $this->connection->prepare
			('UPDATE compte 
			SET nom = :nom;
				date = :date;
				login = :login;
				motDePasse =:motDePasse;
				dateChangementMdp =:dateChangementMdp;
				id_service =: id_service
			WHERE id_compte = :id_compte');

		$stmt->bindParam(':nom', $compte->nom);
		$stmt->bindParam(':date', $compte->date);
		$stmt->bindParam(':login', $compte->login);
		$stmt->bindParam(':motDePasse', $compte->motDePasse);
		$stmt->bindParam(':dateChangementMdp', $compte->dateChangementMdp);
		$stmt->bindParam(':id_service', $compte->getLeService());
		
			
		return $stmt->execute();
	}
	
		public function updateService($service)
	{
		if(!isset($Service->id_service))
		{
			throw new \LogicException
			(
				'Problèmes de mise à jour de la base.'
			);
		}
			
		$stmt = $this->connection->prepare
			('UPDATE service 
			SET nom = :nom;
				date = :date;
				url = :url;
				port =:port;
			WHERE id_service = :id_service');

		$stmt->bindParam(':nom', $service->nom);
		$stmt->bindParam(':date', $service->date);
		$stmt->bindParam(':url', $service->url);
		$stmt->bindParam(':port', $service->port);
		
		return $stmt->execute();
	}
	
	
	public function deleteCompteID($compte)
	{
		if(!isset($service->id_compte))
		{
			throw new \logicException
			(
				'Effacement impossible du compte.'
			);
		}
				
		$stmt = $this->connection->prepare
			('DELETE FROM compte
			WHERE id_service =: id_compte');
				
		$stmt->bindParam(':id_compte', $service->id_compte);
		return $stmt->execute();
	}
			
	public function seConnecter($login,$motDePasse)
	{
		$stmt = $this->connection->prepare
			('SELECT * FROM compte Where login = :login AND motDePasse = :motDePasse');
        $stmt->bindParam(':login', $compte->login);
		$stmt->bindParam(':motDePasse', $compte->motDePasse);
        $stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'compte');
		//echo "string";
		return $stmt->fetch();
	}	
	
	public function partagerCompte($login)
	{
		if(!isset($compte->login))
		{
			throw new \logicException
			(
				'Effacement impossible du service.'
			);
		}
		$stmt = $this->connection->prepare
			('SELECT * FROM compte Where login = :login');
        $stmt->bindParam(':login', $compte->login);
        $stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'compte');
		return $stmt->fetch();
	}
	
	public function rechercherCompte($id_compte)
	{
		if(!isset($compte->id_compte))
		{
			throw new \logicException
			(
				'Effacement impossible du service.'
			);
		}
		$stmt = $this->connection->prepare
			('SELECT * FROM compte Where id_compte = :id_compte');
        $stmt->bindParam(':id_compte', $compte->id_compte);
        $stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'compte');
		return $stmt->fetch();
	}
	
	public function rechercherService($id_service)
	{
		if(!isset($service->id_service))
		{
			throw new \logicException
			(
				'Effacement impossible du service.'
			);
		}
		$stmt = $this->connection->prepare
			('SELECT * FROM service Where id_service = :id_service');
        $stmt->bindParam(':id_service', $service->id_service);
        $stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'service');
		return $stmt->fetch();
	}
	
		public function Renvoyer($login)
	{
		if(!isset($compte->login))
		{
			throw new \logicException
			(
				'Effacement impossible du service.'
			);
		}
		$stmt = $this->connection->prepare
			('SELECT * FROM compte Where login = :login');
        $stmt->bindParam(':id_compte', $compte->id_compte);
        $stmt->execute();
		$stmt->setFetchMode(\PDO::FETCH_CLASS, 'compte');
		return $stmt->fetch();
	}
		
}

?>