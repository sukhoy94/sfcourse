<?php

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ArticleControllerTest extends WebTestCase
{
    private KernelBrowser $client;    
    private Router $router;
    
    protected function setUp()
    {
        $this->client = static::createClient();        
        $this->router = $this->client->getContainer()->get("router");
    }
    
    public function testUnloggedUserRedirectsToLoginPage(): void
    {
        $this->client->request('GET', '/articles/list');        
        
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $this->assertResponseRedirects($this->router->generate('app_login'));
    }
}
