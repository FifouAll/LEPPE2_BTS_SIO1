<?php

// Creating routes
// Psr-7 Request and Response interfaces
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use classes\DAOPortefeuille;
use controllers\UserController;

$app->get('/', 'UserController:connect')->setName('home');
$app->get('/accueil', 'UserController:accueil')->setName('accueil');
$app->get('/inscription', 'UserController:inscription')->setName('Inscription');
$app->get('/Renvoyer', 'UserController:Renvoyer')->setName('Renvoyer');

$app->post('/login', 'UserController:login')->setName('validLogin');
$app->post('/inscription', 'UserController:inscription')->setName('validInscription');

//ajouter un compte/service
$app->get('/AjouterCompte', 'UserController:ajouterCompte')->setName('Ajouter');
$app->get('/AjouterService', 'UserController:ajouterService')->setName('Ajouter');

//me dirige vers l'endroit où je pourrais ajouter un nouveau compte/service
$app->get('/ajouterComptes', 'UserController:ajouterComptes')->setName('ajouter_compte');
$app->get('/ajouterServices', 'UserController:ajouterServices')->setName('ajouter_service');

//effacer un compte/service
$app->get('/EffacerCompte', 'UserController:effacerCompte')->setName('effacer_compte');
$app->get('/EffacerService', 'UserController:effacerService')->setName('effacer_service');

//me dirige vers l'endroit où je pourrais effacer un compte/service
$app->get('/effacerServices', 'UserController:effacerComptes')->setName('effacer_compte');
$app->get('/effacerComptes', 'UserController:effacerServices')->setName('effacer_service');

//modifier un compte/service
$app->get('/modifierCompte', 'UserController:UpdateCompte')->setName('modifier_compte');
$app->get('/modifierService', 'UserController:UpdateService')->setName('modifier_service');

//me dirige vers l'endroit où je pourrais modifier un compte/service
$app->get('/modifierComptes', 'UserController:modifierComptes')->setName('modifier_compte');
$app->get('/modifierServices', 'UserController:modifierServices')->setName('modifier_service');

//permet de voir la liste des compte/service
/*$app->get('/VoirCompte', 'UserController:voir_compte')->setName('voir_compte');
$app->get('/VoirService', 'UserController:voir_service')->setName('voir_service');*/

//rechercher un compte/service
$app->get('/RechercherCompte', 'UserController:rechercherCompte')->setName('rechercher_compte');
$app->get('/RechercherService', 'UserController:rechercherService')->setName('rechercher_service');

//me dirige vers l'endroit où je pourrais rechercher un compte/service
$app->get('/RechercherCompte', 'UserController:rechercherComptes')->setName('rechercher_compte');
$app->get('/RechercherService', 'UserController:rechercherServices')->setName('rechercher_service');


//partager un compte
$app->get('/PartagerCompte', 'UserController:Partager')->setName('partager_compte');


//me dirige vers l'endroit où je pourrais partager un compte
$app->get('/PartagerComptes', 'UserController:PartagerComptes')->setName('partager_compte');
?>
