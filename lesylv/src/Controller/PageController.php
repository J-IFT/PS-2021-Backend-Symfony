<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PageController extends AbstractController
{
    public function index()
    {
        return $this->render('page/index.html.twig');
    }

    public function afficher($url)
    {
        return $this->render('page/afficher.html.twig', [
            'slug' => $url
        ]);
    }
}