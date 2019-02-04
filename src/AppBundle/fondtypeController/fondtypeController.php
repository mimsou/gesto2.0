<?php

namespace AppBundle\fondtypeController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Fondtype;

class fondtypeController extends FOSRestController {

    /**
     * @Rest\Get("fond-type")
     */
    
    public function getFondtypeAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Fondtype')->findAll();
        if ($restresult === null) {
            return new View("there are no fondtypes exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("fond-type/{id}")
     */
    
    public function idFondtypeAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Fondtype')->find($id);
        if ($singleresult === null) {
            return new View("fondtype not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("fond-type/")
     */
    
    public function postFondtypeAction(Request $request) {
        $data = new Fondtype;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setFondtypeCode($artcod);
        $data->setFondtypeDateCreation(new \DateTime($dca));
        $data->setFondtypeLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Fondtype Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("fond-type/{id}")
     */
    
    public function updateFondtypeAction($id, Request $request) {
        $data = new Fondtype;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $fondtype = $this->getDoctrine()->getRepository('AppBundle:Fondtype')->find($id);
        if (empty($fondtype)) {
            return new View("fondtype not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $fondtype->setFondtypeDateCreation($name);
            $fondtype->setFondtypeLibelle($role);
            $sn->flush();
            return new View("Fondtype Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $fondtype->setFondtypeLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $fondtype->setFondtypeDateCreation($name);
            $sn->flush();
            return new View("Fondtype Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Fondtype name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("fond-type/{id}")
     */
    
    public function deleteFondtypeAction($id) {
        $data = new Fondtype;
        $sn = $this->getDoctrine()->getManager();
        $fondtype = $this->getDoctrine()->getRepository('AppBundle:Fondtype')->find($id);
        if (empty($fondtype)) {
            return new View("fondtype not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($fondtype);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
