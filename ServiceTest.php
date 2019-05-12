<?php
use PHPUnit\Framework\TestCase;

final class ServiceTest extends TestCase
{
    public function testgetUrl()
    {
        //$unService = Service::class;
        $unService = new Service;
        $unService->setUrl("uneUrl");
        $this->assertEquals(
            'uneUrl',
            $unService->getUrl()
        );  
    }

    public function testgetPort()
    {
        //$unPort = Service::class;
        $unService = new Service;
        $unService->setPort("lePort");
        $this->assertEquals(
            'lePort',
            $unService->getPort()
        );
    }

    public function testgetLesComptes()
    {
        //$unPort = Service::class;
        $unCompte = new Compte("lucaas855", "1234", "05/12/2018");
        $unService = new Service;
        $unService->setLesComptes($unCompte);
        $this->assertEquals(
            $unCompte,
            $unService->getLesComptes()
        );
    }
	
	public function testAfficher()
	{
		$unService = new Service();
        $unService->setNom("FTP serveur web");
        $unService->setDate("01-12-2018");
        $unService->setUrl("192.138.56.112");
        $unService->setPort("5222");
		$this-> assertEquals(
            "Compte FTP serveur web - 01-12-2018 - 192.138.56.112 - 5222",
			$unService->afficher()
			);
	}
	
	public function testAjouterCompte() 
	{
		$unCompte = new Compte("lucaas855", "gygfray@F5", "05-11-18");
		$unService = new Service();
        $unService->ajouterCompte($unCompte);
        $tableauDeCompte = $unService->getLesComptes();
		$this->assertEquals(
            $unCompte,
            $tableauDeCompte[0]
        );
		
		
	}
}


//TEST unitaire + maquette (mardi)
