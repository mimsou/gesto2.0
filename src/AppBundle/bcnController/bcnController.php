<?php

namespace AppBundle\bcnController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Bcn;

class bcnController extends FOSRestController {

    /**
     * @Rest\Get("/bcn")
     */
    
    public function getBcnAction() {


        $restresult = $this->getDoctrine()->getRepository('AppBundle:Bcn')->findAll();

        if ($restresult === null) {
            return new View("there are no bcns exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/bcn/{id}")
     */
    
    public function idBcnAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Bcn')->find($id);
        if ($singleresult === null) {
            return new View("bcn not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/bcn/")
     */
    
    public function postBcnAction(Request $request) {
        $data = new Bcn;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setBcnCode($artcod);
        $data->setBcnDateCreation(new \DateTime($dca));
        $data->setBcnLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Bcn Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/bcn/{id}")
     */
    
    public function updateBcnAction($id, Request $request) {
        $data = new Bcn;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $bcn = $this->getDoctrine()->getRepository('AppBundle:Bcn')->find($id);
        if (empty($bcn)) {
            return new View("bcn not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $bcn->setBcnDateCreation($name);
            $bcn->setBcnLibelle($role);
            $sn->flush();
            return new View("Bcn Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $bcn->setBcnLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $bcn->setBcnDateCreation($name);
            $sn->flush();
            return new View("Bcn Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Bcn name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/bcn/{id}")
     */
    
    public function deleteBcnAction($id) {
        $data = new Bcn;
        $sn = $this->getDoctrine()->getManager();
        $bcn = $this->getDoctrine()->getRepository('AppBundle:Bcn')->find($id);
        if (empty($bcn)) {
            return new View("bcn not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($bcn);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
