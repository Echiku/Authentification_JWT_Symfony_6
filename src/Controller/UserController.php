<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    
    public function __construct(EntityManagerInterface $manager, UserRepository $userRepository)
    {
        $this->em=$manager; 
        $this->user=$userRepository;
    }
    
    //Création de l'utilisateur
    #[Route('/usercreate', name: 'user_create', methods:'POST')]
    public function usercreate(Request $request): Response
    {
        $data=json_decode($request->getContent(),true);

        $email=$data["email"];
        $password=$data["password"];

        //Vérification de l'email dans la base de données
        $checkEmail=$this->user->findOneByEmail($email);

        if($checkEmail)
        {
            return new JsonResponse([
                "status"=>false,
                "message"=>"Cet email existe déjà, vous pouvez choisir un autre !"
            ]);
        }
        else
        
        //Création d'un nouvel utilisateur
        $user= new User();
        $user->setEmail($email)
             ->setPassword(sha1($password));
        
        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse([
            "status"=>true,
            "message"=>"L'utilisateur a été créé avec succès !"
        ]); 
    }

   
}
