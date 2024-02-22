<?php
// src/Controller/OperateurController.php
namespace App\Controller;

use App\Entity\Operateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OperateurController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route("/operateur/create", name: "operateur_create")]
     public function createOperateur(Request $request): Response
    {
        // get the data from the request
        $matricule = $request->request->get('matricule');
        $adresse = $request->request->get('adresse');
        $name = $request->request->get('name');
        $fax = $request->request->get('fax');
        $mail = $request->request->get('mail');

        // create a new operateur object
        $operateur = new Operateur();
        $operateur->setMatricule($matricule);
        $operateur->setAdresse($adresse);
        $operateur->setName($name);
        $operateur->setFax($fax);
        $operateur->setMail($mail);

        // save the operateur in the database
        $this->entityManager->persist($operateur);
        $this->entityManager->flush();

        // return a response
        return new Response('Operateur created successfully');
    }
    
    #[Route("/operateur/update/{id}", name: "operateur_update")]
     public function updateOperateur(int $id, Request $request): Response
    {
        // find the operateur by id
        $operateur = $this->entityManager->find(Operateur::class, $id);

        // check if the operateur exists
        if ($operateur === null) {
            return new Response('Operateur not found');
        }

        // get the data from the request
        $matricule = $request->request->get('matricule');
        $adresse = $request->request->get('adresse');
        $name = $request->request->get('name');
        $fax = $request->request->get('fax');
        $mail = $request->request->get('mail');

        // update the operateur attributes
        $operateur->setMatricule($matricule);
        $operateur->setAdresse($adresse);
        $operateur->setName($name);
        $operateur->setFax($fax);
        $operateur->setMail($mail);

        // save the changes in the database
        $this->entityManager->flush();

        // return a response
        return new Response('Operateur updated successfully');
    }

    
     #[Route("/operateur/delete/{id}", name: "operateur_delete")]
     public function deleteOperateur(int $id): Response
    {
        // find the operateur by id
        $operateur = $this->entityManager->find(Operateur::class, $id);

        // check if the operateur exists
        if ($operateur === null) {
            return new Response('Operateur not found');
        }

        // delete the operateur from the database
        $this->entityManager->remove($operateur);
        $this->entityManager->flush();

        // return a response
        return new Response('Operateur deleted successfully');
    }
}