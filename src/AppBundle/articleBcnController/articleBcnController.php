<?php

namespace AppBundle\articleBcnController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\ArticleBcn;
use AppBundle\Annotation\ActionName;

class articleBcnController extends FOSRestController {

    /**
     * @ActionName(nameOfAction="Liste totale des article bcns")
     * @Rest\Get("/article-bcn")
     */
    
    public function getArticleBcnAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:ArticleBcn')->findAll();
        if ($restresult === null) {
            return new View("there are no ArticleBcn exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @ActionName(nameOfAction="Article Bcn par id")
     * @Rest\Get("/article-bcn/{id}")
     */
    
    public function idArticleBcnAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:ArticleBcn')->find($id);
        if ($singleresult === null) {
            return new View("ArticleBcn not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @ActionName(nameOfAction="Ajouter un article bcn")
     * @Rest\Post("/article-bcn/")
     */
    
    public function postArticleBcnAction(Request $request) {
        $data = new ArticleBcn;
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
     * @ActionName(nameOfAction="Mise a jour d'un article bcn")
     * @Rest\Put("/article-bcn/{id}")
     */
    
    public function updateArticleBcnAction($id, Request $request) {
        
        $data = new ArticleBcn;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $articleBcn = $this->getDoctrine()->getRepository('AppBundle:ArticleBcn')->find($id);
        if (empty($articleBcn)) {
            return new View("articleBcn not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $articleBcn->setArticleDateCreation($name);
            $articleBcn->setArticleLibelle($role);
            $sn->flush();
            return new View("Article Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $articleBcn->setArticleLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $articleBcn->setArticleDateCreation($name);
            $sn->flush();
            return new View("Article Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Article name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
        
    }

    /**
     * @ActionName(nameOfAction="Suppression d'un article bcn")
     * @Rest\Delete("/article-bcn/{id}")
     */
    
    public function deleteArticleBcnAction($id) {
        
        $data = new ArticleBcn;
        $sn = $this->getDoctrine()->getManager();
        $articleBcn = $this->getDoctrine()->getRepository('AppBundle:ArticleBcn')->find($id);
        if (empty($articleBcn)) {
            return new View("articleBcn not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($articleBcn);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
        
    }

}
