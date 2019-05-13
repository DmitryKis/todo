<?php

namespace App\Tests;

use phpDocumentor\Reflection\Types\This;
use App\Entity\Notice;
use App\Exception\HttpTeapotException;
use App\Form\NoticeType;
use PHPUnit\Framework\TestCase;
use App\Repository\NoticeRepository;
use App\Controller\NoticeController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Test\IntegrationTestCase;


class NoticeTest extends WebTestCase
{
    /**
     * @var \Symfony\Component\HttpKernel\Client
     */
    private $client;

    /**
     * @var \http\Client\Request
     */
    private $request;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;



    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->request = static::getMockClass(Request::class);

    }

    public function testStart()
    {
        $this->assertTrue(true);
    }

    public function testShowIndexPost()
    {
        $client = static::createClient();

        $client->request('POST', '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function testShowIndexGet()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowNewGet()
    {
        $client = static::createClient();

        $client->request('GET', '/new');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowGet()
    {
        $client = static::createClient();

        $client->request('GET', '/5');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowNewPost()
    {
        $client = static::createClient();

        $client->request('POST', '/new');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('POST', '/5');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }


    public function testEntityManager()
    {


        $this->assertNotNull($this->entityManager);
    }

    public function testRequest()
    {


        $this->assertNotNull(Request::class);
    }

    public function testEditPost()
    {
        $client = static::createClient();

        $client->request('POST', '/5/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testEditGet()
    {
        $client = static::createClient();

        $client->request('GET', '/5/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testNoticePost()
    {
        $client = static::createClient();

        $client->request('POST', '/notice');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function testNoticeGet()
    {
        $client = static::createClient();

        $client->request('GET', '/notice');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }





    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }


}
