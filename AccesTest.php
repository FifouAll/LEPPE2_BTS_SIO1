<?php
	// tests unitaires
use PHPUnit\Framework\TestCase;

final class AccesTest extends TestCase
{
	public function testgetNom()
	{
        $unAccess = new Acces;
        $unAccess->setNom("biter");
        $this->assertEquals(
            'biter',
            $unAccess->getNom()
		);
	}
	
	public function testgetDate()
	{
		$unAccess = new Acces;
        $unAccess->setDate("05/12/2018");
        $this->assertEquals(
            '05/12/2018',
            $unAccess->getDate()
		);
	}
}

?>