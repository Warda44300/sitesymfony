<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
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