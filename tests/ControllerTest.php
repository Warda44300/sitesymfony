<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ControllerTest extends WebTestCase
{
	public function testMonsiteRoute()
	{
		$client = static::createClient();

        // GET pour afficher la page
        $client->request('GET', '/');

        // on vérifie que la réponse est 200 ( OK )
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
	}

	public function testBoutiqueRoute()
	{
		$client = static::createClient();

        // GET pour afficher la page
        $client->request('GET', 'monsite/boutique');

        // on vérifie que la réponse est 200 ( OK )
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
	}
	
	public function testContactRoute()
	{
		$client = static::createClient();

        // GET pour afficher la page
        $client->request('GET', '/monsite/contact');

        // on vérifie que la réponse est 200 ( OK )
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
	}

	public function testProposRoute()
	{
		$client = static::createClient();

        // GET pour afficher la page
        $client->request('GET', '/monsite/propos');

        // on vérifie que la réponse est 200 ( OK )
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
	}

	public function testSecurityRoute()
	{
		$client = static::createClient();

        // GET pour afficher la page
        $client->request('GET', '/inscription');

        // on vérifie que la réponse est 200 ( OK )
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
	}

	public function testLoginRoute()
	{
		$client = static::createClient();

        // GET pour afficher la page
        $client->request('GET', '/login');

        // on vérifie que la réponse est 200 ( OK )
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
	}	
}
