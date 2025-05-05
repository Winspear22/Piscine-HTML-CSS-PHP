<?php

namespace App\Ex02Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex02Controller extends AbstractController
{
    /**
     * @Route("/ex02", name="ex02bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from index!");
    }

        /**
     * @Route("/ex02/insert", name="ex02insert")
     */
    public function insert(): Response
    {
        return new Response("Hello from ex02insert!");
    }

    /**
     * @Route("/ex02/select", name="ex02select")
     */
    public function select(): Response
    {
        return new Response("Hello from ex02select!");
    }
}
