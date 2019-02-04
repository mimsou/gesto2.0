<?php

namespace AppBundle\fournisseurController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Fournisseur;

class fournisseurController extends FOSRestController {

    /**
     * @Rest\Get("/fournisseur")
     */
    
    public function getFournisseurAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Fournisseur')->findAll();
        if ($restresult === null) {
            return new View("there are no fournisseurs exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/fournisseur/{id}")
     */
    
    public function idFournisseurAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Fournisseur')->find($id);
        if ($singleresult === null) {
            return new View("fournisseur not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/fournisseur/")
     */
    
    public function postFournisseurAction(Request $request) {
        $data = new Fournisseur;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setFournisseurCode($artcod);
        $data->setFournisseurDateCreation(new \DateTime($dca));
        $data->setFournisseurLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Fournisseur Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/fournisseur/{id}")
     */
    
    public function updateFournisseurAction($id, Request $request) {
        $data = new Fournisseur;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $fournisseur = $this->getDoctrine()->getRepository('AppBundle:Fournisseur')->find($id);
        if (empty($fournisseur)) {
            return new View("fournisseur not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $fournisseur->setFournisseurDateCreation($name);
            $fournisseur->setFournisseurLibelle($role);
            $sn->flush();
            return new View("Fournisseur Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $fournisseur->setFournisseurLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $fournisseur->setFournisseurDateCreation($name);
            $sn->flush();
            return new View("Fournisseur Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Fournisseur name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/fournisseur/{id}")
     */
    
    public function deleteFournisseurAction($id) {
        $data = new Fournisseur;
        $sn = $this->getDoctrine()->getManager();
        $fournisseur = $this->getDoctrine()->getRepository('AppBundle:Fournisseur')->find($id);
        if (empty($fournisseur)) {
            return new View("fournisseur not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($fournisseur);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
