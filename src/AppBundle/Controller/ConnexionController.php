<?php

namespace AppBundle\Controller;

use GSBBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ConnexionController extends Controller
{
    /**
     * @Route("/connexion")
     */
    public function indexAction()
    {
        return $this->render('@GSB/Default/index.html.twig');
    }

    /**
     * @Route("/authentifier")
     */
    public function authentifierAction(Request $request)
    {
        $us = $this->getDoctrine()->getManager();
    	$login = $request->get('login');
    	$mdp = $request->get('mdp');
    	$user = $us->getRepository('GSBBundle:User');
        $Users = $user->findAll();
        foreach($Users as $UnUser)
        {
            if($login == $UnUser->getLogin() && $mdp == $UnUser->getMdp() && $UnUser->getAdmin()==0)
            {
                $session = $request->getSession();
                $session->set('id',$UnUser->getId());
                $session->set('login',$UnUser->getlogin());
                $session->set('mdp',$UnUser->getMdp()); 
                $session->set('nom',$UnUser->getNom());
                $session->set('prenom',$UnUser->getPrenom()); 
                $session->set('age',$UnUser->getAge());
                $session->set('email',$UnUser->getEmail()); 
                $session->set('tel',$UnUser->getTel()); 
                return $this->redirect($this->generateUrl('tableau_de_bord')); 
            }
            elseif($login == $UnUser->getLogin() && $mdp == $UnUser->getMdp() && $UnUser->getAdmin()==1)
            {
                $session = $request->getSession();
                $session->set('id',$UnUser->getId());
                $session->set('login',$UnUser->getlogin());
                $session->set('mdp',$UnUser->getMdp()); 
                $session->set('nom',$UnUser->getNom());
                $session->set('prenom',$UnUser->getPrenom()); 
                $session->set('age',$UnUser->getAge());
                $session->set('email',$UnUser->getEmail()); 
                $session->set('tel',$UnUser->getTel()); 
                return $this->redirect($this->generateUrl('tableau_de_bord_admin')); 
            }
        }
        return $this->render('@GSB/Default/index.html.twig');
    }

    /**
     * @Route("/deconnexion")
     */
	 public function deconnexionAction(Request $request){
        $session = $request->getSession();
        $session->clear();
        return $this->render('@GSB/Default/index.html.twig');
   }

   /**
     * @Route("/security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $user->setAdmin(0);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('connexion');
        }

        return $this->render('@GSB/Default/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

   /**
     * @Route("/security_login")
     */
	 public function security_loginAction(Request $request){

        return $this->render('@GSB/Default/index.html.twig');
   }

    
}
