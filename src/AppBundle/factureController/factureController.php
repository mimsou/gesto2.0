<?php

namespace AppBundle\factureController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Facture;

class factureController extends FOSRestController {

    /**
     * @Rest\Get("/facture")
     */
    
    public function getFactureAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Facture')->findAll();
        if ($restresult === null) {
            return new View("there are no factures exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/facture/{id}")
     */
    
    public function idFactureAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Facture')->find($id);
        if ($singleresult === null) {
            return new View("facture not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/facture/")
     */
    
    public function postFactureAction(Request $request) {
        $data = new Facture;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setFactureCode($artcod);
        $data->setFactureDateCreation(new \DateTime($dca));
        $data->setFactureLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Facture Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/facture/{id}")
     */
    
    public function updateFactureAction($id, Request $request) {
        $data = new Facture;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $facture = $this->getDoctrine()->getRepository('AppBundle:Facture')->find($id);
        if (empty($facture)) {
            return new View("facture not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $facture->setFactureDateCreation($name);
            $facture->setFactureLibelle($role);
            $sn->flush();
            return new View("Facture Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $facture->setFactureLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $facture->setFactureDateCreation($name);
            $sn->flush();
            return new View("Facture Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Facture name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/facture/{id}")
     */
    
    public function deleteFactureAction($id) {
        $data = new Facture;
        $sn = $this->getDoctrine()->getManager();
        $facture = $this->getDoctrine()->getRepository('AppBundle:Facture')->find($id);
        if (empty($facture)) {
            return new View("facture not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($facture);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
