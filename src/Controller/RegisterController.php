<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->EntityManager = $entityManager;
    }

    #[Route('/register', name: 'app_register')]

    public function index(Request $request, UserPasswordHasherInterface $hasher):Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $password = $hasher->hashPassword($user, $user->getPassword());

            $user->setPassword($password);

            $this->EntityManager->persist($user);
            $this->EntityManager->flush();

        }
        return $this->render('register/index.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
