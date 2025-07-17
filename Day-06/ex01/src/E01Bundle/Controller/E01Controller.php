<?php

namespace App\E01Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class E01Controller extends AbstractController
{
    /**
     * @Route("/e01", name="e01_index")
     */
    public function index(): Response
    {
        return new Response("Hello from E01Controller!");
    }

    /**
     * @Route("/e01/sign-in", name="e01_sign-in")
     */
    public function signIn(): Response
    {
        return new Response("Hello from E01Controller!");
    }

    /**
     * @Route("/e01/sign-up", name="e01_sign-up")
     */
    public function signUp(): Response
    {
        return new Response("Hello from E01Controller!");
    }

    /**
     * @Route("/e01/sign-out", name="e01_sign-out")
     */
    public function signOut(): Response
    {
        return new Response("Hello from E01Controller!");
    }

    /**
     * @Route("/e01/welcome", name="e01_welcome")
     */
    public function welcome(): Response
    {
        return new Response("Hello from E01Controller!");
    }
}