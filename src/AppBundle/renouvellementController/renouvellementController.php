<?php

namespace AppBundle\renouvellementController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Renouvellement;

class renouvellementController extends FOSRestController {

    /**
     * @Rest\Get("/renouvellement")
     */
    
    public function getRenouvellementAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Renouvellement')->findAll();
        if ($restresult === null) {
            return new View("there are no renouvellements exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/renouvellement/{id}")
     */
    
    public function idRenouvellementAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Renouvellement')->find($id);
        if ($singleresult === null) {
            return new View("renouvellement not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/renouvellement/")
     */
    
    public function postRenouvellementAction(Request $request) {
        $data = new Renouvellement;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setRenouvellementCode($artcod);
        $data->setRenouvellementDateCreation(new \DateTime($dca));
        $data->setRenouvellementLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Renouvellement Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/renouvellement/{id}")
     */
    
    public function updateRenouvellementAction($id, Request $request) {
        $data = new Renouvellement;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $renouvellement = $this->getDoctrine()->getRepository('AppBundle:Renouvellement')->find($id);
        if (empty($renouvellement)) {
            return new View("renouvellement not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $renouvellement->setRenouvellementDateCreation($name);
            $renouvellement->setRenouvellementLibelle($role);
            $sn->flush();
            return new View("Renouvellement Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $renouvellement->setRenouvellementLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $renouvellement->setRenouvellementDateCreation($name);
            $sn->flush();
            return new View("Renouvellement Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Renouvellement name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/renouvellement/{id}")
     */
    
    public function deleteRenouvellementAction($id) {
        $data = new Renouvellement;
        $sn = $this->getDoctrine()->getManager();
        $renouvellement = $this->getDoctrine()->getRepository('AppBundle:Renouvellement')->find($id);
        if (empty($renouvellement)) {
            return new View("renouvellement not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($renouvellement);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
