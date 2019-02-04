<?php

namespace AppBundle\etatController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Etat;

class etatController extends FOSRestController {

    /**
     * @Rest\Get("/etat")
     */
    
    public function getEtatAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Etat')->findAll();
        if ($restresult === null) {
            return new View("there are no etats exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/etat/{id}")
     */
    
    public function idEtatAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Etat')->find($id);
        if ($singleresult === null) {
            return new View("etat not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/etat/")
     */
    
    public function postEtatAction(Request $request) {
        $data = new Etat;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setEtatCode($artcod);
        $data->setEtatDateCreation(new \DateTime($dca));
        $data->setEtatLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Etat Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/etat/{id}")
     */
    
    public function updateEtatAction($id, Request $request) {
        $data = new Etat;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $etat = $this->getDoctrine()->getRepository('AppBundle:Etat')->find($id);
        if (empty($etat)) {
            return new View("etat not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $etat->setEtatDateCreation($name);
            $etat->setEtatLibelle($role);
            $sn->flush();
            return new View("Etat Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $etat->setEtatLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $etat->setEtatDateCreation($name);
            $sn->flush();
            return new View("Etat Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Etat name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/etat/{id}")
     */
    
    public function deleteEtatAction($id) {
        $data = new Etat;
        $sn = $this->getDoctrine()->getManager();
        $etat = $this->getDoctrine()->getRepository('AppBundle:Etat')->find($id);
        if (empty($etat)) {
            return new View("etat not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($etat);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
