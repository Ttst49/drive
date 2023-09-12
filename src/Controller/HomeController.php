<?php

namespace App\Controller;

use App\Repository\DirectoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/")]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DirectoryRepository $repository): Response
    {
        return $this->render('home/index.html.twig', [
            'directories' => $repository->findAll(),
        ]);
    }
}
