<?php

namespace AppBundle\RoleController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Role;

class roleController extends FOSRestController {

    /**
     * @Rest\Get("/role")
     */
    
    public function getRoleAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:GestRole')->findAll();
        if ($restresult === null) {
            return new View("there are no Role exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/role/{id}")
     */
    
    public function idRoleAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:GestRole')->find($id);
        if ($singleresult === null) {
            return new View("Role not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/role/")
     */
    
    public function postRoleAction(Request $request) {
        $data = new Role;
        $artcod = $request->get('artcod');
        $dca = $request->get('dca');
        $lib = $request->get('lib');
        if (empty($dca) || empty($lib) || empty($artcod)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setArticleCode($artcod);
        $data->setArticleDateCreation(new \DateTime($dca));
        $data->setArticleLibelle($lib);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Article Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/role/{id}")
     */
    
    public function updateRoleAction($id, Request $request) {
        
        $data = new Role;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $Role = $this->getDoctrine()->getRepository('AppBundle:GestRole')->find($id);
        if (empty($Role)) {
            return new View("Role not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $Role->setArticleDateCreation($name);
            $Role->setArticleLibelle($role);
            $sn->flush();
            return new View("Article Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $Role->setArticleLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $Role->setArticleDateCreation($name);
            $sn->flush();
            return new View("Article Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Article name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
        
    }

    /**
     * @Rest\Delete("/role/{id}")
     */
    
    public function deleteRoleAction($id) {
        
        $data = new Role;
        $sn = $this->getDoctrine()->getManager();
        $Role = $this->getDoctrine()->getRepository('AppBundle:GestRole')->find($id);
        if (empty($Role)) {
            return new View("Role not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($Role);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
        
    }

}
