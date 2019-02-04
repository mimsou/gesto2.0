<?php

namespace AppBundle\crbController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Crb;

class crbController extends FOSRestController {

    /**
     * @Rest\Get("/crb")
     */
    
    public function getCrbAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Crb')->findAll();
        if ($restresult === null) {
            return new View("there are no crbs exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/crb/{id}")
     */
    
    public function idCrbAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Crb')->find($id);
        if ($singleresult === null) {
            return new View("crb not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/crb/")
     */
    
    public function postCrbAction(Request $request) {
        $data = new Crb;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setCrbCode($artcod);
        $data->setCrbDateCreation(new \DateTime($dca));
        $data->setCrbLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Crb Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/crb/{id}")
     */
    
    public function updateCrbAction($id, Request $request) {
        $data = new Crb;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $crb = $this->getDoctrine()->getRepository('AppBundle:Crb')->find($id);
        if (empty($crb)) {
            return new View("crb not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $crb->setCrbDateCreation($name);
            $crb->setCrbLibelle($role);
            $sn->flush();
            return new View("Crb Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $crb->setCrbLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $crb->setCrbDateCreation($name);
            $sn->flush();
            return new View("Crb Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Crb name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/crb/{id}")
     */
    
    public function deleteCrbAction($id) {
        $data = new Crb;
        $sn = $this->getDoctrine()->getManager();
        $crb = $this->getDoctrine()->getRepository('AppBundle:Crb')->find($id);
        if (empty($crb)) {
            return new View("crb not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($crb);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
