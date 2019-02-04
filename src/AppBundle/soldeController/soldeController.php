<?php

namespace AppBundle\soldeController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Solde;

class soldeController extends FOSRestController {

    /**
     * @Rest\Get("/solde")
     */
    
    public function getSoldeAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Solde')->findAll();
        if ($restresult === null) {
            return new View("there are no soldes exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/solde/{id}")
     */
    
    public function idSoldeAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Solde')->find($id);
        if ($singleresult === null) {
            return new View("solde not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/solde/")
     */
    
    public function postSoldeAction(Request $request) {
        $data = new Solde;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setSoldeCode($artcod);
        $data->setSoldeDateCreation(new \DateTime($dca));
        $data->setSoldeLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Solde Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/solde/{id}")
     */
    
    public function updateSoldeAction($id, Request $request) {
        $data = new Solde;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $solde = $this->getDoctrine()->getRepository('AppBundle:Solde')->find($id);
        if (empty($solde)) {
            return new View("solde not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $solde->setSoldeDateCreation($name);
            $solde->setSoldeLibelle($role);
            $sn->flush();
            return new View("Solde Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $solde->setSoldeLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $solde->setSoldeDateCreation($name);
            $sn->flush();
            return new View("Solde Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Solde name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/solde/{id}")
     */
    
    public function deleteSoldeAction($id) {
        $data = new Solde;
        $sn = $this->getDoctrine()->getManager();
        $solde = $this->getDoctrine()->getRepository('AppBundle:Solde')->find($id);
        if (empty($solde)) {
            return new View("solde not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($solde);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
