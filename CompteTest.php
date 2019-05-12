<?php
use PHPUnit\Framework\TestCase;

final class CompteTest extends TestCase
{
    public function testgetLogin()
    {
        $unCompte = new Compte("lucaas855", "1234", "05/12/2018");
        $this->assertEquals(
            'lucaas855',
            $unCompte->getLogin()
        );  
    }

    public function testgetMotDePasse()
    {
        $unCompte = new Compte("lucaas855", "1234", "05/12/2018");
        $this->assertEquals(
            '1234',
            $unCompte->getMotDePasse()
        );  
    }

    public function testgetDateChangementMDP()
    {
        $unCompte = new Compte("lucaas855", "1234", "05/12/2018");
        $this->assertEquals(
            '05/12/2018',
            $unCompte->getDateChangementMDP()
        );  
    }

    public function testtesterMotDePasseCourt()
    {
        $unCompte = new Compte("lucaas855", "1234", "05/12/2018");
        $this->assertEquals(
            0,
            $unCompte->testerMotDePasse()
        );  
    }

    public function testtesterMotDePasseLettreEtNum()
    {
        $unCompte = new Compte("lucaas855", "eefr1234", "05/12/2018");
        $this->assertEquals(
            2,
            $unCompte->testerMotDePasse()
        );  
    }

    public function testtesterMotDePasseCaractereSpeciaux()
    {
        $unCompte = new Compte("lucaas855", "@]%$@@@@@", "05/12/2018");
        $this->assertEquals(
            2,
            $unCompte->testerMotDePasse()
        );  
    }

    public function testtesterMotDePasseFort()
    {
        $unCompte = new Compte("lucaas855", "@azhgJHU1541", "05/12/2018");
        $this->assertEquals(
            3,
            $unCompte->testerMotDePasse()
        );  
    }

    public function testtesterMotDePasseTropFaible()
    {
        $unCompte = new Compte("lucaas855", "frjuhyfrf", "05/12/2018");
        $this->assertEquals(
            1,
            $unCompte->testerMotDePasse()
        );  
    }

    public function testverifierObsolescence()
    {
        $unCompte = new Compte("lucaas855", "frjuhyfrf", "04-10-2018");
        $this->assertEquals(
            '2',
            $unCompte->verifierObsolescence()
        );  
    }
}
