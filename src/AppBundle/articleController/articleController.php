<?php

namespace AppBundle\articleController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Article;

class articleController extends FOSRestController {

    /**
     * @Rest\Get("/article")
     */
    
    public function getArticleAction() {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Article')->findAll();
        if ($restresult === null) {
            return new View("there are no articles exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/article/{id}")
     */
    
    public function idArticleAction($id) {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
        if ($singleresult === null) {
            return new View("article not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/article/")
     */
    
    public function postArticleAction(Request $request) {
        $data = new Article;
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
     * @Rest\Put("/article/{id}")
     */
    
    public function updateArticleAction($id, Request $request) {
        $data = new Article;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
        if (empty($article)) {
            return new View("article not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $article->setArticleDateCreation($name);
            $article->setArticleLibelle($role);
            $sn->flush();
            return new View("Article Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $article->setArticleLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $article->setArticleDateCreation($name);
            $sn->flush();
            return new View("Article Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("Article name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/article/{id}")
     */
    
    public function deleteArticleAction($id) {
        $data = new Article;
        $sn = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);
        if (empty($article)) {
            return new View("article not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($article);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
