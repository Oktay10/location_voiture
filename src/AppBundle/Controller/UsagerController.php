<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use GSBBundle\Entity\User;
use GSBBundle\Entity\Vehicule;
use GSBBundle\Entity\Reservation;
use GSBBundle\Entity\Pensebete;

class UsagerController extends Controller
{
    /**
     * @Route("/testVehicule")
     * @Template("@GSB/Default/accueil.html.twig")
     */
    public function testVehiculeAction(Request $request)
    {
    	$session = $request->getSession();
    	$reservation = $this->get('doctrine')->getManager();
    	$lesReservations = $reservation->getRepository('GSBBundle:Reservation')->findBy(["iduser" => $session->get('id')]);
        $lesPenseBetes = $reservation->getRepository('GSBBundle:Pensebete')->findBy(["iduser" => $session->get('id')]);
    	
    	$reservations = array();

    	foreach ($lesReservations as $uneReservation) 
    	{    		
    			//dump('une electrique trouvée');
    			$details = $this->get('doctrine')->getManager();
    			$lesDetails = $details->getRepository('GSBBundle:Vehicule')->findBy(["numImmatriculation" => $uneReservation->getNumImmatriculation()]);
    			//dump($lesDetails);
    			$uneReserv = array();
    			$uneReserv["reservation"] = $lesDetails;
    			$uneReserv["detail"] = $uneReservation;
    			$reservations[] = $uneReserv;
    			//var_dump($reservations);
    	}

        return array('LesReservations'=>$reservations,'LesPenseBetes'=>$lesPenseBetes);
    }

     /**
     * @Route("/formulairePenseBete")
     */
    public function penseBeteFormulaireAction()
    {
		return $this->render('@GSB/Default/formulairePenseBete.html.twig');
    }

    /**
     * @Route("/penseBete")
	 * @Template("@GSB/Default/formulairePenseBete.html.twig")
     */
    public function penseBeteAction(Request $request)
    {
        $session = $request->getSession();
        $user = $this->getDoctrine()->getRepository('GSBBundle:User')->findBy(array('id'=>$session->get('id')));
		// Va me permettre de recup les donnees du formulaire	
		$penseBete = $request->get('penseBete');
		$em = $this->getDoctrine()->getManager();
		$PenseBete = new PenseBete();
        $PenseBete->setIduser($user[0]);   
		$PenseBete->setPensebete($penseBete);  
			
		$em->persist($PenseBete);
		$em->flush();
		return $this->redirect($this->generateUrl('tableau_de_bord'));
	}
	
	/**
     * @Route("/supprimer_Formulaire_Pense_Bete/{id}")
     */
    public function supprimerpenseBeteAction($id, Request $request)
    {	
		$user = $this->getDoctrine()->getRepository('GSBBundle:Pensebete')->find($id);
		$em = $this->getDoctrine()->getManager();	
		$em->remove($user);	
		$em->flush();
		return $this->redirect($this->generateUrl('tableau_de_bord'));
    }

    
}
