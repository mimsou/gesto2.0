<?php

namespace AppBundle\serviceController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Service;

class serviceController extends FOSRestController {

    /**
     * @Rest\Get("/service")
     */
    
    public function getServiceAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Service')->findAll();
        if ($restresult === null) {
            return new View("there are no services exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/service/{id}")
     */
    
    public function idServiceAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Service')->find($id);
        if ($singleresult === null) {
            return new View("service not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/service/")
     */
    
    public function postServiceAction(Request $request) {
        $data = new Service;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setServiceCode($artcod);
        $data->setServiceDateCreation(new \DateTime($dca));
        $data->setServiceLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Service Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/service/{id}")
     */
    
    public function updateServiceAction($id, Request $request) {
        $data = new Service;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $service = $this->getDoctrine()->getRepository('AppBundle:Service')->find($id);
        if (empty($service)) {
            return new View("service not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $service->setServiceDateCreation($name);
            $service->setServiceLibelle($role);
            $sn->flush();
            return new View("Service Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $service->setServiceLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $service->setServiceDateCreation($name);
            $sn->flush();
            return new View("Service Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Service name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/service/{id}")
     */
    
    public function deleteServiceAction($id) {
        $data = new Service;
        $sn = $this->getDoctrine()->getManager();
        $service = $this->getDoctrine()->getRepository('AppBundle:Service')->find($id);
        if (empty($service)) {
            return new View("service not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($service);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
