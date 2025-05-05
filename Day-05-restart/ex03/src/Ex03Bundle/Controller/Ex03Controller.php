<?php

namespace App\Ex03Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex03Controller extends AbstractController
{
    /**
     * @Route("/ex03", name="ex03bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex03index!");
    }

    /**
     * @Route("/ex03insert", name="ex03bundle_insert")
     */
    public function insert(): Response
    {
        return new Response("Hello from Ex03insert!");
    }

    /**
     * @Route("/ex03select", name="ex03bundle_select")
     */
    public function select(): Response
    {
        return new Response("Hello from Ex03select!");
    }

    /**
     * @Route("/ex03delete", name="ex03bundle_delete")
     */
    public function delete(): Response
    {
        return new Response("Hello from Ex03delete!");
    }
}
