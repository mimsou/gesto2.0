<?php

namespace AppBundle\userController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\HeaderBag;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;
use AppBundle\Annotation\ActionName; 
use Doctrine\Common\Annotations\AnnotationReader;

class userController extends FOSRestController {

    /**
     * @Rest\Get("/user")
     * @ActionName(nameOfAction="Liste Totale utilisateur")
     */
    public function getUserAction() {
        //$restresult = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $restresult = $qb->select('u','a')
            ->from('AppBundle:User', 'u')
            ->leftJoin('u.role','a')->getQuery()->getArrayResult();

        if ($restresult === null) {
            return new View("there are no User exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/user/{id}")
     * @ActionName(nameOfAction="Utilisateur par id")
     */
    public function idUserAction($id) {



        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $singleresult = $qb->select('u','a')
            ->from('AppBundle:User', 'u')
            ->join('u.role','a')
            ->where('u.username LIKE :param')
            ->setParameter('param', '%'.$id.'%')
            ->getQuery()
            ->getArrayResult();



        if ($singleresult === null) {
            return new View("User not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }


    /**
     * @Rest\Get("/linkeduser/{id}")
     * @ActionName(nameOfAction="Utilisateur par role")
     */
    public function idUserLinkedAction($id) {

        //$singleresult = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($id)->getUser();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $singleresult = $qb->select('u','a')
            ->from('AppBundle:User', 'u')
            ->join('u.role','a')->where("a.roleId = $id")
            ->getQuery()
            ->getArrayResult();



        if ($singleresult === null) {
            return new View("User not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     *
     * @Rest\Post("/user/")
     * @ActionName(nameOfAction="Ajout utilisateur")
     */
    public function postUserAction(Request $request) {
        

    
        $data = new User;



        $param = json_decode($request->getContent());



        $userManager = $this->get('fos_user.user_manager');

  
        if (empty($param->fullName) || empty($param->email) || empty($param->confirmPassword)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }

        $email_exist = $userManager->findUserByEmail($UserEmail);
      
        if ($email_exist) {
            return new View("Email allready exist", Response::HTTP_NOT_ACCEPTABLE);
        }

     
        $user = $userManager->createUser();             
        $user->setUsername($param->fullName);
        $user->setEmail($param->email);
        $user->setEmailCanonical($param->email);
        $user->setEnabled(1);      
        $user->setPlainPassword($param->confirmPassword);
        $user->setRoles(array("ROLE_GEST"));
        $userManager->updateUser($user);
       
        return new View("User Added Successfully", Response::HTTP_OK);
        
    }

    /**
     * @Rest\Put("/user/{id}")
     * @ActionName(nameOfAction="Mise à jour utilisateur")
     */
    public function updateUserAction($id, Request $request) {

        $data = new User;
        $name = $request->get('dca');
        $role = $request->get('lib');
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        } elseif (!empty($name) && !empty($role)) {
            $user->setUserDateCreation($name);
            $user->setUserLibelle($role);
            $sn->flush();
            return new View("User Updated Successfully", Response::HTTP_OK);
        } elseif (empty($name) && !empty($role)) {
            $user->setUserLibelle($role);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        } elseif (!empty($name) && empty($role)) {
            $user->setUserDateCreation($name);
            $sn->flush();
            return new View("User Name Updated Successfully", Response::HTTP_OK);
        } else
            return new View("User name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/user/{id}")
     * @ActionName(nameOfAction="Supprimer utilisateur")
     */
    public function deleteUserAction($id) {

        $data = new User;
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($user);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }

}
