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

	public function testContactForm()
    {
        $client = static::createClient();

        //GET pour afficher le formulaire
        $crawler = $client->request('GET', '/monsite/contact');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // on selectionne le bouton pour envoyer le formulaire
        $form = $crawler->selectButton('envoyer')->form();

        // on rempli le formulaire avec nos données
        $form['contact_number'] = 'contact_number';
        $form['user_name'] = 'user_name';
        $form['user_email'] = 'user_email';
        $form['message'] = 'message';

        // on envoie le formulaire
        $client->submit($form);

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
