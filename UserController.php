<?php

namespace controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use classes\DAOPortefeuille;
use classes\Compte;
use classes\Service;

class UserController
{

	public function __construct($container)
	{
		$this->container = $container;
	}
			//vérifie la connection
	    private function checkConnected($page, Response $response, $v = array(), $j = array())
    {
        if (isset($_SESSION["connected"]) && $_SESSION["connected"]) {
            return $this->container->view->render($response, $page, array('v' => $v, 'j' => $j));
        } else {
            return $this->container->view->render($response, 'login.html');
        }
    }
			// dirige vers la page d'ajout d'un service/compte après être connecté
	public function ajouterServices(Request $request, Response $response, $args)
    {
        $this->checkConnected("AjouterService.html", $response);
    }
    public function ajouterComptes(Request $request, Response $response, $args)
    {
        $this->checkConnected("AjouterCompte.html", $response);
    }
	
	//idem avec la modification
    public function modifierComptes(Request $request, Response $response, $args)
    {
        $this->checkConnected("ModifierCompte.html", $response);
    }

    public function modifierServices(Request $request, Response $response, $args)
    {
        $this->checkConnected("ModifierService.html", $response);
    }
	
	
	//idem avec la supression
	public function effacerServices(Request $request, Response $response, $args)
    {
        $this->checkConnected("DeleteService.html", $response);
    }
    public function effacerComptes(Request $request, Response $response, $args)
    {
        $this->checkConnected("DeleteCompte.html", $response);
    }
	
	
	//idem avec la recherche
	
	public function rechercherServices(Request $request, Response $response, $args)
    {
        $this->checkConnected("Rechercher_Service.html", $response);
    }
    public function rechercherComptes(Request $request, Response $response, $args)
    {
        $this->checkConnected("Rechercher_Compte.html");
    }
	
	
	
	
	public function PartagerComptes(Request $request, Response $response, $args)
    {
        $this->checkConnected("Partager.html", $response);
	}
	
	
	
	//connection au site 
	public function connect(Request $request, Response $response, $args)
	{
		$params = $request->getQueryParams();
		$message="";
		if(isset($params['error']))
		{
			$message = "Echec d'authentification";
		}
		return $this->container->view->render($response, 'login.html'); //page d'inscription/connexion
	}
	
	
	//vérification du login
	public function login(Request $request, Response $response, $args)
	{
		$data = $request->getParsedBody();
		$donnees = [];
		$donnees['login'] = filter_var($data['login'], FILTER_SANITIZE_STRING);
		$donnees['motDePasse'] = filter_var($data['motDePasse'], FILTER_SANITIZE_STRING); 
		$DAOPortefeuille = new DAOPortefeuille($this->container->db);
		$leUser = $DAOPortefeuille->seConnecter($donnees['login'], $donnees['motDePasse']);

		if($leUser)
		{
			$_SESSION["connected"] = true;
			return $response->withRedirect('./accueil'); // redirection page d'accueil
		}
		else
		{
			$_SESSION["connected"] = false;
			return $response->withRedirect('./?error=invalidCredentials');
		}
	}
	
	public function accueil(Request $request, Response $response, $args)
	{
		if(isset($_SESSION["connected"]) && $_SESSION["connected"] == true)
		{
			return $this->container->view->render($response, 'accueil.html'); //page accueil
		}
		else
		{
			return $this->container->view->render($response, 'login.html'); 
		}           //page inscription
	}
	public function inscription(Request $request, Response $response, $args)
	{
		if(isset($_SESSION["connected"]) && $_SESSION["connected"] == true)
		{
			return $this->container->view->render($response, 'accueil.html'); //page accueil
		}
		else
		{
			return $this->container->view->render($response, 'inscription.html'); 
		}           //page inscription
	} 
	
	
	//reçoit un compte
	public function getCompte(Request $request, Response $response, $args)
	{
		        $bdd = new Bdd($this->container->db);
        $lesComptes = $bdd->getCompte($_SESSION["id_compte"]);
		
	}
	
			//reçoit un service
	public function getService(Request $request, Response $response, $args)
	{
		$bdd = new Bdd($this->container->db);
        $lesServices = $bdd->getService($_SESSION["id_service"]);
		
	}
	
			//remplissage des données pour avoir un ajout de service /compte valide
	public function ajouterCompte(Request $request, Response $response, $args)
	{
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
        $donnees['id_compte']             = filter_var($data['id_compte'], FILTER_SANITIZE_STRING);
		$donnees['date']             = filter_var($data['date'], FILTER_SANITIZE_STRING);
		$donnees['nom']             = filter_var($data['nom'], FILTER_SANITIZE_STRING);
		$donnees['login']             = filter_var($data['login'], FILTER_SANITIZE_STRING);
		$donnees['motDePasse']             = filter_var($data['motDePasse'], FILTER_SANITIZE_STRING);
		$donnees['dateChangementMdp']             = filter_var($data['dateChangementMdp'], FILTER_SANITIZE_STRING);
		$donnees['id_service']             = filter_var($data['id_service'], FILTER_SANITIZE_STRING);
		$donnees['id_compte']            = $_SESSION["id_compte"];
        $compte                       = new Compte($donnees);
        $bdd->AjouterCompte($compte);
		return $response->withRedirect('./accueil');

	}
	
	public fonction ajouterService(Request $request, Response $response, $args)
	{
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
        $donnees['id_service']             = filter_var($data['id_service'], FILTER_SANITIZE_STRING);
		$donnees['nom']             = filter_var($data['nom'], FILTER_SANITIZE_STRING);
		$donnees['date']             = filter_var($data['date'], FILTER_SANITIZE_STRING);
		$donnees['url']             = filter_var($data['url'], FILTER_SANITIZE_STRING);
		$donnees['port']             = filter_var($data['port'], FILTER_SANITIZE_STRING);
		$donnees['id_service']            = $_SESSION["id_compte"];
        $compte                       = new Compte($donnees);
        $bdd->AjouterService($service);
		return $response->withRedirect('./accueil');
	}
	
	
	//idem avec la suppression
	public function effacerCompte(Request $request, Response $response, $args)
	{
		//effacement du compte sélectionné
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['id_compte']         = filter_var($data['id_compte'],
		
		
		
		$bdd->deleteCompteID($compte);
		return $response->withRedirect('./accueil');
		
	}
	
	
	public function effacerService(Request $request, Response $response, $args)
	{
		//effacement du service sélectionné
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['id_service']             = filter_var($data['id_service'],
		
		
		$bdd->deleteServiceID($service);
		return $response->withRedirect('./accueil');
	
	}
	
	public function updateCompte(Request $request, Response $response, $args)
	{
		//mise à jour du compte
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['id_compte']         = filter_var($data['id_compte'], FILTER_SANITIZE_STRING);
		$donnees['date']              = filter_var($data['date'], FILTER_SANITIZE_STRING);
		$donnees['nom']               = filter_var($data['nom'], FILTER_SANITIZE_STRING);
		$donnees['login']             = filter_var($data['login'], FILTER_SANITIZE_STRING);
		$donnees['motDePasse']        = filter_var($data['motDePasse'], FILTER_SANITIZE_STRING);
		$donnees['dateChangementMdp'] = filter_var($data['dateChangementMdp'], FILTER_SANITIZE_STRING);
		$donnees['id_service']        = filter_var($data['id_service'], FILTER_SANITIZE_STRING);
		$
		$bdd->updateCompte($compte);
		return $response->withRedirect('./accueil');
	}
	
	public function UpdateService(Request $request, Response $response, $args)
	{
		//mise à jour du service
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		FILTER_SANITIZE_STRING);
		$donnees['nom']             = filter_var($data['nom'], FILTER_SANITIZE_STRING);
		$donnees['date']             = filter_var($data['date'], FILTER_SANITIZE_STRING);
		$donnees['url']             = filter_var($data['url'], FILTER_SANITIZE_STRING);
		$donnees['port']             = filter_var($data['port'], FILTER_SANITIZE_STRING);
		
		
		$bdd->updateService($service);
		return $response->withRedirect('./accueil');
	}
	
		public function rechercheCompte(Request $request, Response $response, $args)
	{
		//recherche du compte 
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['id_compte']         = filter_var($data['id_compte'],
		
		
		
		$bdd->rechercheCompte($compte);
		return $response->withRedirect('./accueil');	
	}
	
	public function rechercheService(Request $request, Response $response, $args)
	{

		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['id_service']         = filter_var($data['id_service'],
		
		
		
		$bdd->rechercheService($service);
		return $response->withRedirect('./accueil');	
	}
	
	public function Partager(Request $request, Response $response, $args)
	{
	
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['login']         = filter_var($data['login'],

		$bdd->partagerCompte($compte);
		return $response->withRedirect('./accueil');	
	}
	
		public function Renvoyer(Request $request, Response $response, $args)
	{
			//renvoyer le mot de passe si login oublié
		$bdd                          = new Bdd($this->container->db);
        $data                         = $request->getParsedBody();
        $donnees                      = [];
		$donnees['login']         = filter_var($data['login'],

		$bdd->Renvoyer($compte);
		return $response->withRedirect('./accueil');	
	}
}
	

?>