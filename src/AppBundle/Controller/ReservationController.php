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

class ReservationController extends Controller
{
    /**
     * @Route("/criteresVehicule")
     * @Template("@GSB/Default/reservationVehiculePart1.html.twig")
     */
    public function recupererVehiculeAction()
    {
        
    }

    /**
    * @Route("/reservationVehicule")
    * @Template("@GSB/Default/reservationVehiculePart2.html.twig")
    */
    public function choixCriteresVehiculeAction(Request $request)
    {
		// Recupere les données du formulaire
    	$capacite = $request->get('capacite');
    	$type = $request->get('type');

        // Suivant ce qu'on a récupéré sur le champ capacité de formulaire , on défini les variable $interval1 et $interval2
        switch ($capacite) 
        {
            case '<50':
                $interval1 = 0;
                $interval2 = 50;
                break;
            
            case '<150':
                $interval1 = 50;
                $interval2 = 150;
                break;

            case '>150':
                $interval1 = 150;
                $interval2 = 999;  
                break;
        }


    	$em = $this->get('doctrine')->getManager();        

        // Retourne les critères d'interval de stockage et de Type 
        $lesCrit = $em->getRepository('GSBBundle:Vehicule')->createQueryBuilder('v')
          ->where('v.capastockage between :interval1 and :interval2 AND v.typvehicule = :leType')
          ->setParameter('interval1', $interval1)
          ->setParameter('interval2', $interval2)          
          ->setParameter('leType', $type)          
          ->getQuery()
          ->getResult();

        // A partir des immatriculation de véhicule non disponible et des critères du client
        // On réalise une comparaison des deux
        // Si ils sont identiques , on passe la variable réserve a true
        // Sinon on met le véhicule dans un tableau qu'on retourne à la fin
        $lesVoituresDisponible = array();
        foreach($lesCrit as $unVehicule)
        {
            $reserve = false;
            $immatAllVehicules = $unVehicule->getNumImmatriculation();   
            if ($reserve == false)
            {
                $lesVoituresDisponible[] = $unVehicule;
            }
        }
    	return array('lesVehiculesChoisi' => $lesVoituresDisponible);
    }

    /**
    * @Route("/reserverEnfinLeVehicule")
    */

    public function reservationFinalVehiculeAction(Request $request)
    {
        $session = $request->getSession();
        $user = $this->getDoctrine()->getRepository('GSBBundle:User')->findBy(array('id'=>$session->get('id')));

        // Va me permettre de recup les donnees du formulaire        
        $immatriculation = $request->get('vehicule');
        $vehicule = $this->getDoctrine()->getRepository('GSBBundle:Vehicule')->findBy(array('numImmatriculation'=>$immatriculation));

        $dateD = \DateTime::createFromFormat('Y-m-d',date('Y-m-d',strtotime($request->get('dateD'))));
        $dateF = \DateTime::createFromFormat('Y-m-d',date('Y-m-d',strtotime($request->get('dateF'))));
        $em = $this->getDoctrine()->getManager();
        $vehicule[0]->setEstdispo(0);
        $maReservation = new Reservation();
        $maReservation->setNumImmatriculation($vehicule[0]);
        $maReservation->setIduser($user[0]);   
        $maReservation->setDateReservation(\DateTime::createFromFormat('Y-m-d',date("Y-m-d")));
        $maReservation->setDateDebutLoc($dateD);
        $maReservation->setDateFinLoc($dateF);

        $em->persist($maReservation);
        $em->flush();
        return $this->redirect($this->generateUrl('tableau_de_bord'));
    }

    /**
    * @Route("/formulaireApresUtil")  
    */
    public function formulaireApUtilisationAction(Request $request)
    {
         // Va me permettre de recup les donnees du formulaire
        $leVehicule = $request->get('immat'); 
        return $this->render("@GSB/Default/formulaireLocAp.html.twig", array('leVehicule' => $leVehicule));
    }
	
	/**
    * @Route("/detailApresUtilisation")  
    */
	public function detailApresUtilisationAction(Request $request)
	{
		//permet de recuperer la session
		$session = $request->getSession();
		// va me permettre de recuperer les donnees
		$kilometre = $request->get('kilometre');
		$conso = $request->get('conso');
		$leVehicule = $request->get('immat');
		$em = $this->get('doctrine')->getManager();
		$User = $this->getDoctrine()->getRepository('GSBBundle:User')->findby(array('id'=>$session->get('id')));
		
		
		$qB = $em->getRepository('GSBBundle:Reservation')->createQueryBuilder('r');
		$qB ->update('GSBBundle:Reservation', 'r')
			->set('r.estrendu', '?1')
			->set('r.essenceConso', '?2')
			->where('r.iduser = ?3 AND r.numImmatriculation = ?4')
			->setParameter(1,"Rendu")
			->setParameter(2,$conso)
			->setParameter(3,$User)
			->setParameter(4,$leVehicule)
			->getQuery()
			->getResult();
            			
	    $qB2 = $em->getRepository('GSBBundle:Vehicule')->createQueryBuilder('v');
		$qB2 ->update('GSBBundle:Vehicule', 'v')
			->set('v.kilometre', '?1')	
			->where('v.numImmatriculation = ?4')
			->setParameter(1,$kilometre)	
			->setParameter(4,$leVehicule)
			->getQuery()
			->getResult();


        return $this->redirect($this->generateUrl('tableau_de_bord'));
	}

    
}
