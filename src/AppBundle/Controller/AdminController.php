<?php

namespace AppBundle\Controller;

use GSBBundle\Entity\User;
use AppBundle\Form\UserType;
use GSBBundle\Entity\Vehicule;
use AppBundle\Form\VehiculeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends Controller
{
     /**
     * @Route("/tableau_de_bord_admin")
     * @Template("@GSB/Default/admin.html.twig")
     */
    public function adminAction(Request $request)
    {
    	$session = $request->getSession();
    	$reservation = $this->get('doctrine')->getManager();
    	$lesUsers = $reservation->getRepository('GSBBundle:User')->findBy(array('admin' => 0));
        $lesPenseBetes = $reservation->getRepository('GSBBundle:Pensebete')->findBy(["iduser" => $session->get('id')]);
        
        return array('lesUsers'=>$lesUsers,'LesPenseBetes'=>$lesPenseBetes);
    }

    /**
     * @Route("/ajout_voiture")
     */
    public function enregistrer_voiture(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $vehicule = new Vehicule();

        $form = $this->createForm(VehiculeType::class, $vehicule);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($vehicule);
            $manager->flush();

            return $this->redirectToRoute('tableau_de_bord_admin');
        }

        return $this->render('@GSB/Default/ajouterVehicule.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    

}
