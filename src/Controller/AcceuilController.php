<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'acceuil_index')]
    public function indexAction(): Response
    {
        return $this->render('Sandbox/Layouts/menu.html.twig');
    }

}



