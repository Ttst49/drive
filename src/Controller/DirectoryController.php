<?php

namespace App\Controller;

use App\Entity\Directory;
use App\Form\DirectoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DirectoryController extends AbstractController
{
    #[Route('/directory/create', name: 'app_directory_createdirectory')]
    public function createDirectory(Request $request, EntityManagerInterface $manager): Response
    {

        $directory = new Directory();
        $formDirectory = $this->createForm(DirectoryType::class,$directory);
        $formDirectory->handleRequest($request);
        if ( $formDirectory->isSubmitted() && $formDirectory->isValid()){
            $directory->setCreatedAt(new \DateTime());
            $manager->persist($directory);
            $manager->flush();

            return $this->redirectToRoute("app_home");
        }



        return $this->render('directory/create.html.twig', [
            'formDirectory' => $formDirectory->createView(),
        ]);
    }
}
