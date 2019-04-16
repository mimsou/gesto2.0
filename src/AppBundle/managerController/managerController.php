<?php

namespace AppBundle\managerController;

use AppBundle\Annotation\ActionName;
use AppBundle\Entity\GestAccessPath;
use AppBundle\Entity\GestActions;
use AppBundle\Entity\GestActionsRegle;
use AppBundle\Entity\GestEntity;
use AppBundle\Entity\GestFields;
use AppBundle\Entity\GestList;
use AppBundle\Entity\GestProcess;
use AppBundle\Entity\GestRelations;
use AppBundle\Entity\GestRole;
use AppBundle\Entity\GestSteps;
use AppBundle\Entity\GestListRegle;
use AppBundle\Entity\Facture;
use AppBundle\Entity\UpdateForm;
use Doctrine\Common\Annotations\AnnotationReader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\GestMenu;
use AppBundle\Menu;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Validator\Constraints\Date;
use Doctrine\ORM\Query;


class managerController extends FOSRestController
{


    private $foundedRoute = array();
    private $routecount = 0;


    /**
     * @Rest\Get("/role")
     */

    public function getRoleAction()
    {
        //$restresult = $this->getDoctrine()->getRepository('AppBundle:GestRole')->findAll();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $restresult = $qb->select('u')
            ->from('AppBundle:GestRole', 'u')->getQuery()->getArrayResult();

        if ($restresult === null) {
            return new View("there are no role exist", Response::HTTP_NOT_FOUND);
        }

        return $restresult;

    }


    /**
     * @Rest\Get("/entitymeta")
     */

    public function getEntitymetaAction()
    {

        $em = $this->getDoctrine()->getManager();

        $metadata = $em->getMetadataFactory()->getAllMetadata();

        $manytomany = array();

//        foreach ($metadata as $classMeta) {
//            if (str_replace($classMeta->namespace . "\\", "", $classMeta->name) == "ArticleBcn") {
//                die(json_encode($classMeta->getAssociationMappings()));
//            }
//        }


        $em->createQuery('update AppBundle:GestEntity a set a.checks = 0 where a.checks != 2')->execute();
        $em->createQuery('update AppBundle:Gestfields a set a.checks = 0 where a.checks != 2')->execute();
        $em->createQuery('update AppBundle:GestRelations a set a.checks = 0 where a.checks != 2')->execute();

        foreach ($metadata as $classMeta) {


            if (strpos($classMeta->table["name"], 'gest_') === false && $classMeta->table["name"] !== 'user' && $classMeta->table["name"] !== 'group' && $classMeta->table["name"] !== 'update_form' && $classMeta->table["name"] !== 'view_form') {


                $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->findOneBy(array("entityEntity" => str_replace($classMeta->namespace . "\\", "", $classMeta->name)));

                if ($entity == null) {
                    $entity = new GestEntity();
                    $entity->setEntityPos('264,570');
                }

                $entity->setEntityTable($classMeta->table["name"]);
                $entity->setEntityEntity(str_replace($classMeta->namespace . "\\", "", $classMeta->name));
                $entity->setEntityKey($classMeta->identifier[0]);
                $entity->setEntityType("regular");
                $entity->setChecks('1');


                foreach ($classMeta->fieldMappings as $fieldMapping) {


                    $field = $this->getDoctrine()
                        ->getRepository('AppBundle:GestFields')
                        ->findOneBy(
                            array(
                                "fieldEntityName" => $fieldMapping["fieldName"],
                                "fieldEntity" => $entity,
                            )
                        );

                    if ($field == null) {
                        $field = new GestFields();
                    }

                    $field->setFieldEntityName($fieldMapping["fieldName"]);
                    $field->setFieldColumnName($fieldMapping["columnName"]);
                    $field->setFieldType($fieldMapping["type"]);
                    $field->setFieldNature(0);
                    $field->setChecks('1');
                    //$field->setFieldLength($fieldMapping["length"]);
                    $entity->addField($field);

                }

                foreach ($classMeta->getAssociationMappings() as $mapping) {


                    $fieldf = $this->getDoctrine()
                        ->getRepository('AppBundle:GestFields')
                        ->findOneBy(
                            array(
                                "fieldEntityName" => $mapping["fieldName"],
                                "fieldEntity" => $entity,
                            )
                        );

                    $addtoEntity = false;
                    if ($fieldf == null) {
                        $addtoEntity = true;
                        $fieldf = new GestFields();
                    }

                    $fieldf->setFieldEntityName($mapping["fieldName"]);
                    $fieldf->setFieldColumnName($mapping["fieldName"]);
                    $fieldf->setFieldType("integer");
                    $fieldf->setFieldNature(1);
                    $fieldf->setFieldTargetEntity(str_replace($classMeta->namespace . "\\", "", $mapping["targetEntity"]));
                    $fieldf->setChecks('1');
                    //$field->setFieldLength($fieldMapping["length"]);

                    if ($addtoEntity) {
                        $entity->addField($fieldf);
                    }

                    if (isset($mapping["joinTable"]["inverseJoinColumns"])) {
                        if (!empty($mapping["joinTable"]["inverseJoinColumns"])) {


                            if (!in_array($mapping["joinTable"]["name"], $manytomany)) {
                                array_push($manytomany, $mapping["joinTable"]["name"]);

                                $entitysub = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->findOneBy(array("entityEntity" => $mapping["joinTable"]["name"]));

                                if ($entitysub) {

                                    $entitysub = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->findOneBy(array("entityTable" => $mapping["joinTable"]["name"]));

                                    if ($entitysub == null) {
                                        $entitysub = new GestEntity();
                                        $entitysub->setEntityPos('264,570');
                                    }

                                }


                                $entitysub->setEntityTable($mapping["joinTable"]["name"]);
                                $entitysub->setEntityEntity($mapping["joinTable"]["name"]);
                                $entitysub->setEntityType("association");
                                $entitysub->setChecks('1');


                                $fieldsub = $this->getDoctrine()
                                    ->getRepository('AppBundle:GestFields')
                                    ->findOneBy(
                                        array(
                                            "fieldColumnName" => $mapping["joinTable"]["joinColumns"][0]["name"],
                                            "fieldEntity" => $entitysub,
                                        )
                                    );

                                if ($fieldsub == null) {
                                    $fieldsub = new GestFields();
                                }


                                $fieldsub = new GestFields();
                                $fieldsub->setFieldEntityName($mapping["joinTable"]["joinColumns"][0]["name"]);
                                $fieldsub->setFieldColumnName($mapping["joinTable"]["joinColumns"][0]["name"]);
                                $fieldsub->setFieldNature(2);
                                $fieldsub->setChecks('1');
                                $entitysub->addField($fieldsub);


                                $fieldsub = $this->getDoctrine()
                                    ->getRepository('AppBundle:GestFields')
                                    ->findOneBy(
                                        array(
                                            "fieldColumnName" => $mapping["joinTable"]["inverseJoinColumns"][0]["name"],
                                            "fieldEntity" => $entitysub,
                                        )
                                    );

                                if ($fieldsub == null) {
                                    $fieldsub = new GestFields();
                                }

                                $fieldsub = new GestFields();
                                $fieldsub->setFieldEntityName($mapping["joinTable"]["inverseJoinColumns"][0]["name"]);
                                $fieldsub->setFieldColumnName($mapping["joinTable"]["inverseJoinColumns"][0]["name"]);
                                $fieldsub->setFieldNature(2);
                                $fieldsub->setChecks('1');
                                $entitysub->addField($fieldsub);

                                $em->persist($entitysub);


                                $relation = $this->getDoctrine()
                                    ->getRepository('AppBundle:GestRelations')
                                    ->findOneBy(
                                        array(
                                            "relationTableName" => str_replace($classMeta->namespace . "\\", "", $mapping["targetEntity"]),
                                            "relationEntitie" => $entity,
                                        )
                                    );

                                if ($relation == null) {
                                    $relation = new GestRelations();
                                }

                                $relation->setRelationKey($mapping["fieldName"]);
                                $relation->setRelationTableName(str_replace($classMeta->namespace . "\\", "", $mapping["targetEntity"]));
                                $relation->setChecks('1');
                                if ($mapping["inversedBy"] != "") {
                                    $relation->setRelationInverseKey($mapping["inversedBy"]);
                                }
                                $entity->addRelation($relation);

                            }

                        }

                    } else if (empty($mapping["mappedBy"])) {


                        $relation = $this->getDoctrine()
                            ->getRepository('AppBundle:GestRelations')
                            ->findOneBy(
                                array(
                                    "relationTableName" => str_replace($classMeta->namespace . "\\", "", $mapping["targetEntity"]),
                                    "relationEntitie" => $entity,
                                )
                            );

                        if ($relation == null) {
                            $relation = new GestRelations();
                        }

                        $relation->setRelationKey($mapping["fieldName"]);
                        $relation->setRelationTableName(str_replace($classMeta->namespace . "\\", "", $mapping["targetEntity"]));
                        $relation->setChecks('1');
                        if ($mapping["inversedBy"] != "") {
                            $relation->setRelationInverseKey($mapping["inversedBy"]);
                        }
                        $entity->addRelation($relation);
                    }


                }

                $em->persist($entity);

            }

        }

        $em->flush();


        $relations = $this->getDoctrine()->getRepository('AppBundle:GestRelations')->findAll();
        foreach ($relations as $relation) {
            $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->findOneBy(array("entityEntity" => $relation->getRelationTableName()));
            $relation->setRelationsTable($entity);
            $em->persist($relation);
            $em->flush();
        }

        $fields = $this->getDoctrine()->getRepository('AppBundle:GestFields')->findAll();
        foreach ($fields as $field) {
            $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->findOneBy(array("entityEntity" => $field->getFieldTargetEntity()));
            $field->setFieldTargetEntityId($entity);

            if($field->getFieldNature()==1){

                $fields = $this->getDoctrine()->getRepository('AppBundle:GestFields')->findOneBy(
                    array(
                        "fieldEntityName" => $entity->getEntityKey(),
                        "fieldEntity" => $entity
                    )
                );

                $field->setFieldType($fields->getFieldType());

            }

            $em->persist($field);
            $em->flush();
        }

        $em->createQuery('delete from AppBundle:GestRelations a  where a.checks = 0')->execute();
        $em->createQuery('delete from AppBundle:GestEntity a  where a.checks = 0')->execute();
        $em->createQuery('delete from AppBundle:Gestfields a  where a.checks = 0')->execute();

        $em->flush();


    }


    /**
     * @Rest\Get("/schema")
     */

    public function getSchemaAction()
    {

        $em = $this->getDoctrine()->getManager();

        $schema = array();

        $qb = $em->createQueryBuilder();

        $qb->select('u', 'p')
            ->from('AppBundle:GestEntity', 'u')
            ->leftJoin('u.fields', 'p')->orderBy("p.fieldOrder");

        $schema["table"] = $qb->getQuery()->getArrayResult();

        $qbr = $em->createQueryBuilder();

        $qbr->select('u', 'p', 'o')
            ->from('AppBundle:GestRelations', 'u')
            ->leftJoin('u.relationEntitie', 'p')
            ->leftJoin('u.relationsTable', 'o');

        $schema["relation"] = $qbr->getQuery()->getArrayResult();

        return $schema;

    }


    /**
     * @Rest\Get("/menufront")
     */

    public function getMenuFrontAction()
    {


        $user = $this->getCurrentUser();
        $iduser = $user->getId();

        $em = $this->getDoctrine()->getManager();


        $restresult = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->findBy(array("menuTag" => "m"));


        if ($restresult === null) {
            return new View("there are no menus exist", Response::HTTP_NOT_FOUND);
        }

        $menu = array();
        foreach ($restresult as $key => $item) {
            $itemmenu = new  Menu\Menu();
            $itemmenu->title = $item->getMenuLibelle();
            $itemmenu->icone = "";
            $itemmenu->link = $item->getMenuInterface();
            $itemmenu->children = array();

            $qb = $em->createQueryBuilder();
            $subrest = $qb->select('u', 'a', 'o')
                ->from('AppBundle:GestMenu', 'u')
                ->join('u.role', 'a')
                ->join('a.user', 'o')
                ->where("o.id = $iduser")
                ->andWhere('u.menuParent = ' . $item->getMenuId())
                ->getQuery()->getResult();

            //die(var_dump($subrest));

            // $subrest = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->findBy(array("menuParent" => $item->getMenuId()));

            foreach ($subrest as $keys => $itemchild) {
                $itemmenuchild = new Menu\Menu();
                $itemmenuchild->title = $itemchild->getMenuLibelle();
                $itemmenuchild->icone = "";
                $itemmenuchild->link = $itemchild->getMenuInterface();
                $itemmenu->children[] = $itemmenuchild;
                if ($itemchild->getMenuTag() == 'p') {
                    $itemmenuchild->queryParams = array("processId" => $itemchild->getMenuProcess());
                    $itemmenuchild->link = "/pages/app-generator/app";
                }
            }

            $menu[] = $itemmenu;

        }

        return $menu;

    }


    protected function getCurrentUser()
    {

        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The Security Bundle is not registered in your application.');
        }
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }
        if (!is_object($user = $token->getUser())) {
            return;
        }
        return $user;
    }

    /**
     * @Rest\Get("/allcontroller")
     */

    public function getControllerAction()
    {


        $allAnnotations = new AnnotationReader();
        $controllers = array();
        $routes = $this->container->get('router')->getRouteCollection()->all();

        foreach ($routes as $route) {
            $defaults = $route->getDefaults();

            if (isset($defaults['_controller'])) {

                $controllerAction = explode(':', $defaults['_controller']);
                $controller = $controllerAction[0];
                if (!isset($controllers[$controller]) && class_exists($controller)) {
                    $controllers[$controller] = $controller;
                }


            }
        }

        $controlarray = array();

        foreach ($controllers as $controller) {

            $reflectionClass = new \ReflectionClass($controller);
            $reflectionMethod = $reflectionClass->getMethods();
            foreach ($reflectionMethod as $method) {

                $actionName = $allAnnotations->getMethodAnnotation($method, ActionName::class);

                $cont = $method->class;
                $cont .= "\\" . $method->name;

                if ($actionName) {

                    $em = $this->getDoctrine()->getManager();
                    $singleresult = $this->getDoctrine()->getRepository('AppBundle:GestAccessPath')->findBy(array("apController" => $cont));
                    array_push($controlarray, $cont);
                    if (empty($singleresult)) {

                        $action = new GestAccessPath();
                        $action->setApController($cont);
                        $action->setApLibelle($actionName->nameOfAction);
                        $em->persist($action);
                        $em->flush();


                    } else {
                        $singleresult[0]->setApLibelle($actionName->nameOfAction);
                        $em->persist($singleresult[0]);
                        $em->flush();
                    }
                }


            }

        }

        $allcont = $this->getDoctrine()->getRepository('AppBundle:GestAccessPath')->findAll();

        foreach ($allcont as $contsaved) {

            if (!in_array($contsaved->getApController(), $controlarray)) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($contsaved);
                $em->flush();
            }
        }


        // $restresult = $this->getDoctrine()->getRepository('AppBundle:GestAccessPath')->findAll();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $restresult = $qb->select('u', 'a')
            ->from('AppBundle:GestAccessPath', 'u')
            ->leftJoin('u.role', 'a')->getQuery()->getArrayResult();

        if ($restresult === null) {
            return new View("there are no controller exist", Response::HTTP_NOT_FOUND);
        }


        return $restresult;

    }


    /**
     * @Rest\Get("/role/{id}")
     */

    public function idRoleAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:GestRole')->find($id);
        if ($singleresult === null) {
            return new View("role not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }


    /**
     * @Rest\Post("/role/")
     */

    public function postRoleAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        foreach ($param as $key => $prm) {
            $functionName = "set" . ucfirst($key);

            if (method_exists($data, $functionName)) {
                $data->$functionName($prm);
            }

        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("role Added Successfully", Response::HTTP_OK);
    }


    /**
     * @Rest\Patch("/entitypos/{id}")
     */

    public function updateEntityPosAction($id, Request $request)
    {


        $param = json_decode($request->getContent());

        $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($id);
        $pos = var_export($param, true);
        $entity->setEntityPos($param[1] . "," . $param[0]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return new View("Entity pos update Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/role/{id}")
     */

    public function updateRoleAction($id, Request $request)
    {


        $param = json_decode($request->getContent());

        $menu = $this->getDoctrine()->getRepository('AppBundle:GestRole')->find($id);

        foreach ($param as $key => $prm) {
            $functionName = "set" . ucfirst($key);
            if (method_exists($menu, $functionName)) {
                $menu->$functionName($prm);
            };
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($menu);
        $em->flush();

        return new View("role update Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Delete("/role/{id}")
     */

    public function deleteRoleAction($id)
    {

        $sn = $this->getDoctrine()->getManager();
        $role = $this->getDoctrine()->getRepository('AppBundle:GestRole')->find($id);

        if (empty($role)) {
            return new View("role not found", Response::HTTP_NOT_FOUND);
        } else {

//            $menuchilds = $this->getDoctrine()->getRepository('AppBundle:GestRole')->findBy(array("menuParent"=>$id));
//
//            foreach ($menuchilds as $menuchild){
//                $menuchild->setMenuParent(null);
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($menuchild);
//                $em->flush();
//            }

            $sn->remove($role);
            $sn->flush();

        }

        return new View("role deleted successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/roleadduser/")
     */

    public function postRoleAddUserAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();

        $role = $param->role;

        $user = $param->user;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->addUser(
            $this->getDoctrine()->getRepository('AppBundle:User')->find($user)
        );

        $usr = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);

        $rolname = $role->getRoleLibelle();

        $usr->addRole($rolname);

        $em->persist($usr);
        $em->flush();

        $em->persist($role);
        $em->flush();


        return new View("user Added from role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/roleremoveuser/")
     */

    public function postRoleRemoveUserAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $user = $param->user;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->removeUser(
            $this->getDoctrine()->getRepository('AppBundle:User')->find($user)
        );

        $usr = $this->getDoctrine()->getRepository('AppBundle:User')->find($user);

        $rolname = $role->getRoleLibelle();

        $usr->removeRole($rolname);

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("user removed from role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/roleaddcontroller/")
     */

    public function postRoleAddControllerAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $ap = $param->ap;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->addRap(
            $this->getDoctrine()->getRepository('AppBundle:GestAccessPath')->find($ap)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Controller Added to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/roleremovecontroller/")
     */

    public function postRoleRemoveControllerAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $ap = $param->ap;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->removeRap(
            $this->getDoctrine()->getRepository('AppBundle:GestAccessPath')->find($ap)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Controller removed from role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/roleaddlink/")
     */

    public function postRoleAddLinkAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $link = $param->link;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->addMenu(
            $this->getDoctrine()->getRepository('AppBundle:GestMenu')->find($link)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Link Added to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/roleremovelink/")
     */

    public function postRoleRemoveLinkAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $link = $param->link;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->removeMenu(
            $this->getDoctrine()->getRepository('AppBundle:GestMenu')->find($link)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Link removed to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/roleaddstep/")
     */

    public function postRoleAddStepAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $id = $param->id;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->addStep(
            $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($id)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Step Added to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/roleremovestep/")
     */

    public function postRoleRemoveStepAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $id = $param->id;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->removeStep(
            $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($id)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Step removed to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/roleaddaction/")
     */

    public function postRoleAddAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $id = $param->id;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->addAction(
            $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($id)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Action Added to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/roleremoveaction/")
     */

    public function postRoleRemoveAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $id = $param->id;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->removeAction(
            $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($id)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("Action removed to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/roleaddlist/")
     */

    public function postRoleAddListAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $id = $param->id;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->addList(
            $this->getDoctrine()->getRepository('AppBundle:GestList')->find($id)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("List Added to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/roleremovelist/")
     */

    public function postRoleRemoveListAction(Request $request)
    {
        $data = new GestRole();

        $param = json_decode($request->getContent());

        $role = $param->role;

        $id = $param->id;

        $role = $this->getDoctrine()->getRepository('AppBundle:Gestrole')->find($role)->removeList(
            $this->getDoctrine()->getRepository('AppBundle:GestList')->find($id)
        );

        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();


        return new View("List removed to role Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Get("/menu")
     */

    public function getMenuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('u', 'r', 'y', 'i')
            ->from('AppBundle:Gestmenu', 'u')->leftJoin("u.link", 'r')->leftJoin('r.role', 'i')->leftJoin('r.menuParent', 'y')->where("u.menuTag = 'm'");

        $restresult = $qb->getQuery()->getArrayResult();


        if ($restresult === null) {
            return new View("there are no menus exist", Response::HTTP_NOT_FOUND);
        }

        /*   foreach ($restresult as $key => $item) {
               $lik = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->findBy(array("menuParent" => $item->getMenuId()));
               die(var_dump($lik[0]->getMenuId()));
               $restresult[$key]->link = $lik;
           } */

        return $restresult;

    }

    /**
     * @Rest\Get("/link")
     */

    public function getLnikAction()
    {
//        $restresult = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->findBy(array("menuTag" => "i","menuTag" => "p", "menuParent" => null));
//        if ($restresult === null) {
//            return new View("there are no link exist", Response::HTTP_NOT_FOUND);
//        }

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('u', 't', 'i')
            ->from('AppBundle:Gestmenu', 'u')->leftJoin('u.menuParent', 't')->leftJoin('u.role', 'i')->where("u.menuTag like 'i' or u.menuTag like 'p'")->where("u.menuParent is null")->andWhere("u.menuTag !='m'");
        $restresult = $qb->getQuery()->getArrayResult();

        return $restresult;
    }


    /**
     * @Rest\Get("/menu/{id}")
     */

    public function idMenuAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->find($id);

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('AppBundle:Gestmenu', 'u')->where("u.menuId = $id");
        $singleresult = $qb->getQuery()->getArrayResult();

        if ($singleresult === null) {
            return new View("menu not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/menu/")
     */

    public function postMenuAction(Request $request)
    {

        $data = new Gestmenu();

        $param = json_decode($request->getContent());

        foreach ($param as $key => $prm) {
            $functionName = "set" . ucfirst($key);
            if (method_exists($data, $functionName)) {
                $data->$functionName($prm);
            }
            $data->setMenuTag("m");
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Menu Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Patch("/menu/{id}")
     */

    public function updateMenuAction($id, Request $request)
    {


        $param = json_decode($request->getContent());

        $menu = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->find($id);

        foreach ($param as $key => $prm) {
            $functionName = "set" . ucfirst($key);
            if (method_exists($menu, $functionName)) {
                $menu->$functionName($prm);
            };
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($menu);
        $em->flush();

        return new View("Menu update Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/linkmenu/")
     */

    public function linkMenuAction(Request $request)
    {


        $param = json_decode($request->getContent());

        $menu = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->find($param->childid);

        $menuparent = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->find($param->parentid);

        $menu->setMenuParent($menuparent);

        $em = $this->getDoctrine()->getManager();

        $em->persist($menu);

        $em->flush();

        return new View("Link saved under menu Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/unlinkmenu/")
     */

    public function unlinkMenuAction(Request $request)
    {


        $param = json_decode($request->getContent());

        $menu = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->find($param->childid);

        $menu->setMenuParent(null);

        $em = $this->getDoctrine()->getManager();

        $em->persist($menu);

        $em->flush();

        return new View("Link saved under menu Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Delete("/menu/{id}")
     */

    public function deleteMenuAction($id)
    {

        $sn = $this->getDoctrine()->getManager();
        $menu = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->find($id);
        if (empty($menu)) {
            return new View("menu not found", Response::HTTP_NOT_FOUND);
        } else {

            $menuchilds = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->findBy(array("menuParent" => $id));

            foreach ($menuchilds as $menuchild) {
                $menuchild->setMenuParent(null);
                $em = $this->getDoctrine()->getManager();
                $em->persist($menuchild);
                $em->flush();
            }

            $sn->remove($menu);
            $sn->flush();
        }
        return new View("menu eleted successfully", Response::HTTP_OK);
    }


    /**
     * @Rest\Post("/manager/")
     */

    public function postRouteAction(Request $request)
    {
        $suffixUrl = "/pages";
        $param = json_decode($request->getContent());
        foreach ($param[0]->children as $route) {
            $parent = $route->path;
            foreach ($route->children as $child) {
                $lnik = $suffixUrl . "/" . $parent . "/" . $child->path;
                $rs = $this->getDoctrine()->getRepository('AppBundle:Gestmenu')->findBy(array("menuInterface" => $lnik));
                if (empty($rs)) {
                    $menu = new GestMenu();
                    $menu->setMenuLibelle("Lnik:" . $lnik);
                    $menu->setMenuInterface($lnik);
                    $menu->setMenuTag("i");
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($menu);
                    $em->flush();
                }
            }

        }

        return new View("menu deleted successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/process/")
     */

    public function postAddProcessAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();


        $param = json_decode($request->getContent());


        $process = new GestProcess();


        $process->setProcessDesignation($param->processName);


        $step = new GestSteps();
        $step->setStepName("Création");
        $step->setStepSequence(1);

        $action = new GestActions();
        $action->setActionBtnName("Création " . $param->processEntity->entityEntity);
        $action->setActionName("Création " . $param->processEntity->entityEntity);
        $action->setActionEntity($this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->processEntity->entityId));
        $action->setActionType(1);
        $action->setActionIsmainLevel(1);
        $action->setActionLevelDepth(1);

        $step->addAction($action);

        $process->addAction($action);

        $em->persist($action);

        $list = new GestList();
        $list->setListName("Lies des " . $param->processEntity->entityEntity);
        $list->setListEntityName($param->processEntity->entityId);
        $list->setListIsMain(1);

        $step->addList($list);

        $process->addList($list);

        $em->persist($list);

        $process->addGestEntity($this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->processEntity->entityId));


        $process->addStep($step);


        $em->persist($process);
        $em->flush();

        $menu = new Gestmenu();
        $menu->setMenuTag("p");
        $menu->setMenuLibelle($param->processName);
        $menu->setMenuProcess($process->getProcessId());
        $em->persist($menu);
        $em->flush();


        return new View("Process Added Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Delete("/process/{id}")
     */

    public function deleteProcessAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($id);

        $acts = $process->getActions();

        foreach ($acts as $act) {
            $em->remove($act);
        }

        $lists = $process->getList();

        foreach ($lists as $list) {
            $em->remove($list);
        }

        $steps = $process->getSteps();

        foreach ($steps as $step) {
            $em->remove($step);
        }

        $entitys = $process->getGestEntity();

        foreach ($entitys as $ent) {
            $ent->removeGestProcess($process);
            $em->persist($ent);
        }

        $mnprocess = $this->getDoctrine()->getRepository('AppBundle:GestMenu')->findBy(array("menuProcess" => $process->getProcessId()));

        foreach ($mnprocess as $mnpr) {
            $em->remove($mnpr);
        }

        $em->remove($process);


        $em->flush();

        return new View("Process deleted Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Get("/process")
     */

    public function getProcessAction()
    {

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $pr = $qb->select('a')->from('AppBundle:GestProcess', 'a')->getQuery()->getArrayResult();

        $process = array();

        foreach ($pr as $proc) {

            $pr = $this->getSignleProcessAction($proc["processId"], false);

            array_push($process, $pr[0]);

        }

//        $em = $this->getDoctrine()->getManager();
//
//        $qb = $em->createQueryBuilder();
//        $qb->select('u', 'p', 'o', 'r', 'h', 'j', 'k', 'm', 'g', 'f', 't', 's', 'l', 'y', 'z', 'ha', 'yu', 'ra', 'rb', 'oa', 'ao', 'al', 'yp', 'it', 'pi', 'oai', 'ri', 'mi')
//            ->from('AppBundle:GestProcess', 'u')
//
//            ->leftJoin('u.gestEntity', 'p')
//
//            ->leftJoin('u.gestEntityDimention', 't')
//
//            ->leftJoin('u.gestFieldDimention', 's')
//
//            ->leftJoin('u.steps', 'o')
//            ->leftJoin('o.role', 'oa')
//            ->leftJoin('o.action', 'r')
//            ->leftJoin('o.list', 'm')
//
//            ->leftJoin('u.fromsteps', 'pi')
//            ->leftJoin('pi.role', 'oai')
//            ->leftJoin('pi.action', 'ri')
//            ->leftJoin('pi.list', 'mi')
//
//            ->leftJoin('u.list', 'g')
//            ->leftJoin('g.listReg', 'it')
//            ->leftJoin('g.role', 'al')
//            ->leftJoin('g.field', 'f')
//
//            ->leftJoin('u.actions', 'k')
//            ->leftJoin('k.role', 'ao')
//            ->leftJoin('k.actionAcreg', 'yp')
//            ->leftJoin('k.actionNextStep', 'ra')
//            ->leftJoin('k.actionFromStep', 'rb')
//            ->leftJoin('k.actionEntity', 'l')
//            ->leftJoin('k.actionSubEntity', 'y')
//            ->leftJoin('k.actionSubProcess', 'z')
//            ->leftJoin('z.steps', 'yu')
//            ->leftJoin('k.viewField', 'j')
//            ->leftJoin('k.updateField', 'h')
//            ->leftJoin('h.updateFieldId', 'ha');
//
//
//        $process = $qb->getQuery()->getArrayResult();


        return $process;

    }


    /**
     * @Rest\Get("/process/{id}")
     */

    public function getSignleProcessAction($id, $exrastep = true)
    {


        $user = $this->getCurrentUser();

        $iduser = $user->getId();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $process = $qb->select('a', 'b', 'c', 'd')->from('AppBundle:GestProcess', 'a')->leftJoin('a.gestEntity', 'b')->leftJoin('a.gestEntityDimention', 'c')->leftJoin('a.gestFieldDimention', 'd')->andWhere('a.processId =:proc')->setParameter('proc', $id)->getQuery()->getArrayResult();


        $qb = $em->createQueryBuilder();
        $stp = $qb->select('o', 'r', 'xi', 'ra', 'm', 'rt', 'na', 'ta', 'xe')->from('AppBundle:GestSteps', 'o')
            ->leftJoin('o.role', 'xe')
            ->leftJoin('o.action', 'r')
            ->leftJoin('r.role', 'xi')
            ->leftJoin('r.actionNextStep', 'ra')
            ->leftJoin('o.list', 'm')
            ->leftJoin('m.role', 'rt')
            ->leftJoin('m.field', 'na')
            ->leftJoin('na.fieldTargetEntityId', 'ta')
            ->andWhere('o.stepProcess =:proc')->setParameter('proc', $id)->orderBy("na.fieldOrder")->getQuery()->getArrayResult();

        $qb = $em->createQueryBuilder();

        if ($exrastep) {

            $stpfrom = $qb->select('o', 'r', 'xi', 'ra', 'm', 'rt', 'na', 'ta', 'xe')->from('AppBundle:GestSteps', 'o')
                ->leftJoin('o.role', 'xe')
                ->leftJoin('o.action', 'r')
                ->leftJoin('r.role', 'xi')
                ->leftJoin('r.actionNextStep', 'ra')
                ->leftJoin('o.list', 'm')
                ->leftJoin('m.role', 'rt')
                ->leftJoin('m.field', 'na')
                ->leftJoin('na.fieldTargetEntityId', 'ta')
                ->andWhere('o.stepFromProcess =:proc')->setParameter('proc', $id)->orderBy("na.fieldOrder")->getQuery()->getArrayResult();


            $process[0]["steps"] = array_merge($stp, $stpfrom);

        } else {

            $process[0]["steps"] = $stp;

        }

        $qb = $em->createQueryBuilder();
        $process[0]["fromsteps"] = $qb->select('x ', 'oai', 'ri', 'mi')->from('AppBundle:GestSteps', 'x')
            ->leftJoin('x.role', 'oai')
            ->leftJoin('x.action', 'ri')
            ->leftJoin('x.list', 'mi')
            ->andWhere('x.stepFromProcess =:proc')->setParameter('proc', $id)->getQuery()->getArrayResult();

        $qb = $em->createQueryBuilder();
        $process[0]["actions"] = $qb->select('k', 'yp', 'xa', 'ry', 'l', 'y', 'z', 'h', 'ha', 'n', 'j', 'b', 'ba', 'ri')->from('AppBundle:GestActions', 'k')
            ->leftJoin('k.actionAcreg', 'yp')
            ->leftJoin('k.role', 'xa')
            ->leftJoin('k.actionNextStep', 'ri')
            ->leftJoin('k.actionFromStep', 'ry')
            ->leftJoin('k.actionEntity', 'l')
            ->leftJoin('k.actionSubEntity', 'y')
            ->leftJoin('k.actionSubProcess', 'z')
            ->leftJoin('k.updateField', 'h')
            ->leftJoin('h.updateFieldId', 'ha')
            ->leftJoin('ha.fieldEntity', 'n')
            ->leftJoin('k.viewField', 'j')
            ->leftJoin('j.fieldEntity', 'b')
            ->leftJoin('j.fieldTargetEntityId', 'ba')
            ->andWhere('k.actionProcess =:proc')->setParameter('proc', $id)->orderBy("ha.fieldOrder")->getQuery()->getArrayResult();

        $qb = $em->createQueryBuilder();
        $process[0]["list"] = $qb->select('g', 'it', 'f', 'ya', 'q', 'al')->from('AppBundle:GestList', 'g')
            ->leftJoin('g.listReg', 'it')
            ->leftJoin('g.field', 'f')
            ->leftJoin('g.role', 'al')
            ->leftJoin('f.fieldTargetEntityId', 'ya')
            ->leftJoin('f.fieldEntity', 'q')
            ->andWhere('g.listProcess =:proc')->setParameter('proc', $id)->orderBy("f.fieldOrder")->getQuery()->getArrayResult();

        return $process;

    }


    /**
     * @Rest\Get("/step/{id}")
     */

    public function getSignleStepAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('AppBundle:GestSteps', 'u')
            ->where('u.stepId =:stpid')->setParameter('stpid', $id);
        $step = $qb->getQuery()->getArrayResult();
        return $step;

    }


    /**
     * @Rest\Post("/stepfromprocess/")
     */

    public function postStepfromprocessAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $param = json_decode($request->getContent());


        $process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process->processId);

        $step = $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->step);


        if (!$process->getFromsteps()->contains($step)) {
            $step->setStepFromProcess($process);
        } else {
            $process->removeFromstep($step);
        }

        $em->persist($step);

        $em->flush();

        return new View("step Added from process Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Post("/step/")
     */

    public function postStepAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $param = json_decode($request->getContent());


        $process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process->processId);

        $step = new GestSteps();
        $step->setStepName($param->name);

        $em = $this->getDoctrine()->getManager();
        $max = $em->createQueryBuilder()
            ->select('MAX(s.stepSequence) AS max_step')
            ->from('AppBundle:GestSteps', 's')
            ->where('s.stepProcess = :stepProcess')->setParameter('stepProcess', $process)
            ->getQuery()->getArrayResult();


        $step->setStepSequence((int)$max[0]["max_step"] + 1);

        $process->addStep($step);

        $em->persist($process);
        $em->flush();

        return new View("Process Added Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Delete("/step/{id}")
     */

    public function deleteStepAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $step = $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($id);

        $lists = $step->getList();

        foreach ($lists as $list) {
            $list->removeStep($step);
            $em->persist($list);
        }

        $actions = $step->getAction();

        foreach ($actions as $act) {
            $act->removeStep($step);
            $em->persist($act);
        }

        $em->remove($step);

        $em->flush();


        return new View("Steps removed Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/stepactions/")
     */

    public function patchStepactionsAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $step = $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->step->stepId);

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $action->addStep($step);

        $em = $this->getDoctrine()->getManager();

        $em->persist($step);

        $em->flush();

        return new View("Action saved under step Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/actionfromstep/")
     */

    public function patchActionfromstepAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $step = $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->step->stepId);

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $action->removeStep($step);

        $em = $this->getDoctrine()->getManager();

        $em->persist($step);

        $em->flush();

        return new View("action removed from step Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/action/")
     */

    public function postActionAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $param = json_decode($request->getContent());


        if (isset($param->action->actionId)) {
            $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);
        } else {
            $action = new GestActions();
        }

        $process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process->processId);


        $action->setActionName($param->action->actionName);
        $action->setActionBtnName($param->action->actionName);
        $action->setActionType($param->action->actionType);
        $action->setActionEntity($this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->action->actionEntity));
        if ($param->action->actionType !== 4) {
            $action->setActionIsmainLevel($param->action->actionIsmainLevel);
            $action->setActionLevelDepth($param->action->actionLevelDepth);
            $action->setActionNextStep($this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->action->actionNextStep));
        }
        if ((($param->action->actionLevelDepth == 2 || $param->action->actionIsmainLevel == 0) && $param->action->actionExistingSubEntity == 0) || $param->action->actionIsmainLevel == 0) {
            $action->setActionSubEntity($this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->action->actionSubEntity));
            $action->setActionExistingSubEntity($param->action->actionExistingSubEntity);
        }

        if (($param->action->actionLevelDepth == 2 || $param->action->actionIsmainLevel == 0) && $param->action->actionExistingSubEntity == 1) {
            $action->setActionSubProcess($this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->action->actionSubProcess));
            $action->setActionExistingSubEntity($param->action->actionExistingSubEntity);
        }

        if ($param->action->actionLevelDepth == 2 || $param->action->actionIsmainLevel == 0) {
            $action->setActionAddSubEntity($param->action->actionAddSubEntity);
            $action->setActionExistingSubEntity($param->action->actionExistingSubEntity);
        }

        if ($param->action->actionExistingSubEntity == 1) {
            $action->setActionFromStep($this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->action->actionFromStep));
        }

        $process->addAction($action);

        $em->persist($process);

        $em->flush();

        return new View("Action Added Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Delete("/action/{id}")
     */

    public function deleteActionAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($id);

        $em->remove($action);

        $em->flush();

        return new View("List removed Successfully", Response::HTTP_OK);


    }


    /**
     * @Rest\Patch("/fieldlagexp/")
     */

    public function patchFieldagexpAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();


        if (!empty($param->fieldAg)) {
            $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->fieldAg->fieldId);
        } else {
            $field = new GestFields();
        }

        $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->entity->entityId);

        $field->setFieldNature(2);
        $field->setFieldType($param->form->fieldType);
        $field->setFieldEntity($entity);
        $field->setFieldEntityName($param->form->fieldAlias);
        $field->setFieldInterfaceName($param->form->fieldName);
        $field->setFieldExpression(json_encode($param->exp));
        $field->setChecks('2');


        $em->persist($field);

        $em->flush();


        return new View("update Field expression succefuly", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/acregexp/")
     */

    public function patchAcregexpAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();


        if (!empty($param->acreg)) {
            $acreg = $this->getDoctrine()->getRepository('AppBundle:GestActionsRegle')->find($param->acreg->acregId);
        } else {
            $acreg = new GestActionsRegle();
        }

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $acreg->setAcregAction($action);
        $acreg->setAcregAlias($param->form->acregAlias);
        $acreg->setAcregErrormessage($param->form->acregErrormessage);
        $acreg->setAcregName($param->form->acregName);
        $acreg->setAcregExpression(json_encode($param->exp));

        $em->persist($acreg);

        $em->flush();


        return new View("Action Regle expression update succefuly ", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/listregexp/")
     */

    public function patchListregexpAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();


        if (!empty($param->listreg)) {
            $listreg = $this->getDoctrine()->getRepository('AppBundle:GestListRegle')->find($param->listreg->listregId);
        } else {
            $listreg = new GestListRegle();
        }

        $list = $this->getDoctrine()->getRepository('AppBundle:GestList')->find($param->list->listId);

        $listreg->setRegList($list);
        $listreg->setListregAlias($param->form->listregAlias);
        $listreg->setListregName($param->form->listregName);
        $listreg->setListregExpression(json_encode($param->exp));

        $em->persist($listreg);

        $em->flush();


        return new View("List regle expression update succefuly ", Response::HTTP_OK);

    }

    /**
     * @Rest\Patch("/fieldupdateaction/")
     */

    public function patchFieldupdateactionAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->field->fieldId);

        $exist = false;
        foreach ($field->getUpdateAction() as $item) {
            if ($item->getUpdateActionId()->getActionId() == $action->getActionId()) {
                $exist = true;
            }
        }

        if (!$exist) {

            $upform = new UpdateForm();

            $upform->setUpdateActionId($action);

            $upform->setUpdateFieldId($field);

            if ($param->mode == "exp") {
                $upform->setUpdateExpression(json_encode($param->exp));
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($upform);

            $em->flush();

        } else {

            if ($param->mode == "exp") {

                $em = $this->getDoctrine()->getManager();

                $upform = $this->getDoctrine()->getRepository('AppBundle:UpdateForm')->findOneBy(array(
                    "updateActionId" => $action,
                    "updateFieldId" => $field
                ));


                $upform->setUpdateExpression(json_encode($param->exp));

                $em->persist($upform);

                $em->flush();

            } else {

                $upform = $this->getDoctrine()->getRepository('AppBundle:UpdateForm')->findBy(array(
                    "updateActionId" => $action,
                    "updateFieldId" => $field
                ));

                $em = $this->getDoctrine()->getManager();

                foreach ($upform as $upformitem) {
                    $em->remove($upformitem);
                }

                $em->flush();
            }

        }


        return new View("update Field association updated under action Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Patch("/fieldrequireaction/")
     */

    public function patchFieldrequireactionAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->field->fieldId);


        $upform = $this->getDoctrine()->getRepository('AppBundle:UpdateForm')->findOneBy(array(
            "updateActionId" => $action,
            "updateFieldId" => $field
        ));

        if ($upform->getUpdateRequire() == 1) {
            $upform->setUpdateRequire(0);
        } else if ($upform->getUpdateRequire() == 0) {
            $upform->setUpdateRequire(1);
        } else {
            $upform->setUpdateRequire(1);
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($upform);

        $em->flush();


        return new View("update Field association updated under action Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/fieldviewaction/")
     */

    public function patchFieldviewactionAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->field->fieldId);

        if (!$field->getViewAction()->contains($action)) {
            $field->addViewAction($action);
        } else {
            $field->removeViewAction($action);

            $upform = $this->getDoctrine()->getRepository('AppBundle:UpdateForm')->findBy(array(
                "updateActionId" => $action,
                "updateFieldId" => $field
            ));

            $em = $this->getDoctrine()->getManager();

            foreach ($upform as $upformitem) {
                $em->remove($upformitem);
            }

            $em->flush();

        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($action);

        $em->flush();

        return new View("update Field association updated under action Successfully", Response::HTTP_OK);

    }



    /*************** LIST *****************/


    /**
     * @Rest\Patch("/steplist/")
     */

    public function patchSteplistAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $step = $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->step->stepId);

        $list = $this->getDoctrine()->getRepository('AppBundle:GestList')->find($param->list->listId);

        $list->addStep($step);

        $em = $this->getDoctrine()->getManager();

        $em->persist($step);

        $em->flush();

        return new View("List saved under step Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/listfromstep/")
     */

    public function patchListfromstepAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $step = $this->getDoctrine()->getRepository('AppBundle:GestSteps')->find($param->step->stepId);

        $list = $this->getDoctrine()->getRepository('AppBundle:GestList')->find($param->list->listId);

        $list->removeStep($step);

        $em = $this->getDoctrine()->getManager();

        $em->persist($step);

        $em->flush();

        return new View("List removed from step Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/list/")
     */

    public function postListAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $param = json_decode($request->getContent());


        $process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process->processId);

        $list = new GestList();
        $list->setListName($param->list->listName);
        $list->setListEntityName($param->list->listEntityName);
        $process->addList($list);

        $em->persist($process);
        $em->flush();

        return new View("List Added Successfully", Response::HTTP_OK);

    }

    /**
     * @Rest\Delete("/list/{id}")
     */

    public function deleteListAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $list = $this->getDoctrine()->getRepository('AppBundle:GestList')->find($id);

        $em->remove($list);

        $em->flush();

        return new View("List removed Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/fieldlistaction/")
     */

    public function patchLieldlistactionAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $list = $this->getDoctrine()->getRepository('AppBundle:Gestlist')->find($param->list->listId);

        $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->field->fieldId);

        if (!$field->getList()->contains($list)) {
            $field->addList($list);
        } else {
            $field->removeList($list);
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($list);

        $em->flush();

        return new View("field association updated under list Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Post("/dimention/")
     */

    public function postDimentionAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $param = json_decode($request->getContent());

        $process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process->processId);

        if ((int)$param->dim->type == 1) {

            $code = $param->dim->type . "." . $param->dim->entityId;
            $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->dim->entityId);
            $entity->addGestProcessDimention($process);


        } else if ((int)$param->dim->type == 2) {

            $code = $param->dim->type . "." . $param->dim->fieldId;
            $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->dim->fieldId);
            $field->addGestProcessDimention($process);

        }


        if ($param->dim->require == 1) {

            $dim = $process->getProcessRequiredim();

            if ($dim !== NULL) {

                $dimjson = json_decode($dim);

                $exist = false;

                foreach ($dimjson as $item) {

                    if ($code == $item) {
                        $exist = true;
                    }

                    if (!$exist) {
                        array_push($dimjson, $code);
                    }

                }

                $process->setProcessRequiredim(json_encode($dimjson));

            } else {
                $dimjson = array();
                array_push($dimjson, $code);
                $process->setProcessRequiredim(json_encode($dimjson));
            }
        }


        $em->persist($process);

        $em->flush();

        return new View("Dimention Added Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/dimention/")
     */

    public function deleteDimentionentAction(Request $request)
    {


        $param = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();

        if ($param->type == 'ent') {

            $code = "1" . "." . $param->id;

            $ent = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->id);

            $Process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process);

            $ent->removeGestProcessDimention($Process);

            $em->persist($ent);

            $em->flush();

        } else if ($param->type == 'fld') {

            $code = "2" . "." . $param->id;

            $fld = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($param->id);

            $Process = $this->getDoctrine()->getRepository('AppBundle:GestProcess')->find($param->process);

            $fld->removeGestProcessDimention($Process);

            $em->persist($fld);

            $em->flush();

        };

        $dim = $Process->getProcessRequiredim();


        if ($dim !== NULL) {

            $dimjson = json_decode($dim);

            $arr = array();
            foreach ($dimjson as $key => $item) {
                if ($code != $item) {
                    array_push($arr, $item);
                }
            }

            $rr = json_encode($arr);

            if ($arr != NULL && !empty($arr) && $arr != "") {
                $Process->setProcessRequiredim($rr);
            } else {
                $Process->setProcessRequiredim(NULL);
            }

        }

        $em->persist($Process);

        $em->flush();

        return new View("Dimention removed Successfully", Response::HTTP_OK);

    }









    /************* Front App Generator *******************/


    /**
     * @Rest\Patch("/datalist/")
     */

    public function getsatalistAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $id = $param->id;

        $list = $this->getDoctrine()->getRepository('AppBundle:Gestlist')->find($id);

        $process = $list->getListProcess();

        $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($list->getListEntityName());

        $entEntityName = $entity->getEntityEntity();

        $fullentityName = "AppBundle:" . $entEntityName;

        $field = $list->getField();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb = $qb->select('a');

        $qb = $qb->from($fullentityName, 'a');

        $alias = "b";


        foreach ($field as $fld) {
            if ($fld->getFieldNature() == 0) {
                $qb = $qb->addSelect('a.' . $fld->getFieldEntityName());
            } else if ($fld->getFieldNature() == 1) {
                $alias++;
                $qb = $qb->addSelect($alias);
                $qb = $qb->leftJoin("a." . $fld->getFieldEntityName(), $alias);
            }
        }


        $rslistregs = $list->getListReg();
        $nofilterArray = array();
        foreach ($rslistregs as $itemreglists) {

            $exp = json_decode($itemreglists->getListregExpression());

            preg_match_all("/nofilter(\(((?>[^()]+|(?1))*)\))/", $exp->expression, $matchnofilter);

            foreach ($matchnofilter[2] as $key => $conf) {

                preg_match_all("/\[([^\]]+)]/", $conf, $matchfld);

                $fld = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($matchfld[1][0]);

                array_push($nofilterArray, $fld->getFieldEntityName());

            }

        }

        $whereArray = array();

        if (property_exists($param, "dimfilter")) {

            $rel = array();
            if ($param->dimfilter->ent !== NULL) {
                foreach ($param->dimfilter->ent as $entdim) {
                    $dimentity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($entdim->param->entityId);
                    $relconfig = $this->getRelationEntityConfig($entity, $dimentity);
                    $prevalias = "";

                    foreach ($relconfig as $key => $relroute) {


                        if ($key != 1) {
                            $qb = $qb->leftJoin($prevalias . "." . $relroute["key"], $relroute["al"]);
                        } else {
                            $qb = $qb->leftJoin("a." . $relroute["key"], $relroute["al"]);
                        }
                        $prevalias = $relroute["al"];
                    }

                    if (!in_array($entdim->param->entityKey, $nofilterArray)) {

                        array_push($whereArray, array($prevalias . "." . $entdim->param->entityKey . " = :val" . $prevalias, 'val' . $prevalias, $entdim->data, "interger", "1." . $dimentity->getEntityId()));

                        array_push($rel, array($dimentity->getEntityEntity(), $relconfig));

                    }
                }
            }


            if ($param->dimfilter->fld !== NULL) {
                foreach ($param->dimfilter->fld as $flddim) {
                    $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($flddim->param->fieldId);
                    $dimentity = $field->getFieldEntity();

                    //die(var_dump($dimentity->getEntityEntity()));
                    if ($dimentity->getEntityEntity() !== $entity->getEntityEntity()) {
                        $relconfig = $this->getRelationEntityConfig($entity, $dimentity);
                        $prevalias = "";

                        foreach ($relconfig as $key => $relroute) {

                            $qb = $qb->addSelect($relroute["al"]);
                            if ($key != 1) {
                                $qb = $qb->leftJoin($prevalias . "." . $relroute["key"], $relroute["al"]);

                            } else {
                                $qb = $qb->leftJoin("a." . $relroute["key"], $relroute["al"]);

                            }

                            $prevalias = $relroute["al"];
                        }
                        if (!in_array($field->getFieldEntityName(), $nofilterArray)) {
                            array_push($rel, array($dimentity->getEntityEntity(), $relconfig));

                            array_push($whereArray, array($prevalias . "." . $field->getFieldEntityName() . " like :val" . $prevalias, 'val' . $prevalias, $flddim->data, $flddim->param->fieldType, "1." . $field->getFieldId()));
                        }
                    } else {
                        if (!in_array($field->getFieldEntityName(), $nofilterArray)) {
                            array_push($rel, array($dimentity->getEntityEntity(), "same"));

                            $id = uniqid();

                            array_push($whereArray, array("a" . "." . $field->getFieldEntityName() . " like :val" . $id, 'val' . $id, $flddim->data, $flddim->param->fieldType, "1." . $field->getFieldId()));
                        }
                    }
                }
            }

        }


        if (empty($whereArray)) {

        }


        foreach ($whereArray as $warr) {
            if ($warr[2] == "") {
                if ($this->field_is_required_in_process($process, $warr[4])) {
                    $roceed = true;
                } else {
                    $roceed = false;
                }
            } else {
                $roceed = true;
            }

            if ($warr[3] !== "datetime" && $roceed) {
                if ($warr[3] == "string") {
                    $qb = $qb->andWhere($warr[0])->setParameter($warr[1], "%" . $warr[2] . "%");
                } else {
                    $qb = $qb->andWhere($warr[0])->setParameter($warr[1], $warr[2]);
                }
            } else if ($roceed) {
                $default = false;
                if (strpos($warr[2], ':') !== false) {
                    $dates = explode(":", $warr[2]);
                    if ($dates[0] !== "" && $dates[1] !== "") {
                        $fieldvals = explode("=", $warr[0]);
                        $fieldval = $fieldvals[0];
                        $alias1 = $this->uniq_char();
                        $alias2 = $this->uniq_char();
                        $qb = $qb->andWhere($fieldval . "> :" . $alias1)->setParameter($alias1, new \DateTime($dates[0]));
                        $qb = $qb->andWhere($fieldval . "< :" . $alias2)->setParameter($alias2, new \DateTime($dates[1]));
                    }
                } else if ($warr[2][0] == ">") {
                    $fieldvals = explode("=", $warr[0]);
                    $fieldval = $fieldvals[0];
                    $alias = $this->uniq_char();
                    $dateval = str_replace(">", "");
                    $qb = $qb->andWhere($fieldval . "> :" . $alias)->setParameter($alias, new \DateTime($dateval));
                } else if ($warr[2][0] == "<") {
                    $fieldvals = explode("=", $warr[0]);
                    $fieldval = $fieldvals[0];
                    $alias = $this->uniq_char();
                    $dateval = str_replace("<", "");
                    $qb = $qb->andWhere($fieldval . "< :" . $alias)->setParameter($alias, new \DateTime($dateval));
                } else {
                    $qb = $qb->andWhere($warr[0])->setParameter($warr[1], new \DateTime($warr[2]));
                }


                if ($default) {
                    $qb = $qb->andWhere($warr[0])->setParameter($warr[1], new \DateTime($warr[2]));
                }

            }
        }

        $steps = $list->getListProcess()->getSteps();

        $user = $this->getCurrentUser();

        $iduser = $user->getId();

        $steps = $em->createQueryBuilder()
            ->select('s')
            ->from('AppBundle:GestSteps', 's')
            ->join('s.role', 'a')
            ->join('a.user', 'o')
            ->where("o.id = $iduser")
            ->andWhere('s.stepProcess = :stepProcess')->setParameter('stepProcess', $list->getListProcess()->getProcessId())
            ->getQuery()->getArrayResult();

        $stepfromprocesss = $em->createQueryBuilder()
            ->select('s')
            ->from('AppBundle:GestSteps', 's')
            ->join('s.role', 'a')
            ->join('a.user', 'o')
            ->where("o.id = $iduser")
            ->andWhere('s.stepFromProcess = :stepProcess')->setParameter('stepProcess', $list->getListProcess()->getProcessId())
            ->getQuery()->getArrayResult();

        $stepsids = array();

        foreach ($steps as $step) {
            array_push($stepsids, $step["stepId"]);
        }

        foreach ($stepfromprocesss as $stepf) {
            array_push($stepsids, $stepf["stepId"]);
        }


        if ($entity->getEntityStepperField() != NULL) {

            $stepper = $entity->getEntityStepperField();

            $qb = $qb->andWhere($qb->expr()->in('a.' . $entity->getEntityStepperField(), '?1'))->setParameter(1, $stepsids);

            if (isset($param->step)) {
                if ($param->step !== null) {

                    $qb = $qb->andWhere("a." . $stepper . " = :step")->setParameter("step", $param->step->stepId);
                }
            }

        }

        $qb = $qb->distinct("a");

        // die(var_dump( $qb->getQuery()->getSql()));
        $result = $qb->getQuery()->getArrayResult();


        foreach ($result as $key => $rs) {

            $id = $rs[0][$entity->getEntityKey()];
            $prm = new \stdClass();
            $prm->data = $rs[0];

            $rslistreg = $list->getListReg();

            $passed = true;

            foreach ($rslistreg as $itemreglist) {
                $params = new \stdClass();
                $params->type = "boolean";
                $params->entity = $entity;
                $params->expression = $itemreglist->getListregExpression();

                if (strpos($params->expression, "nofilter") == false) {
                    $rs = $this->_getExpressionRestult($params, $prm, $param->dimfilter, $id);
                    if (!$rs) {
                        unset($result[$key]);
                        $passed = false;
                        break;
                    }
                }
            }


            if ($passed) {

                foreach ($field as $fld) {

                    if ($fld->getFieldNature() == 2) {
                        $expression = $fld->getFieldExpression();
                        $params = new \stdClass();
                        $params->expression = $expression;
                        $params->type = $fld->getFieldType();
                        $params->entity = $entity;
                        $id = $rs[0][$entity->getEntityKey()];
                        $rs = $this->_getExpressionRestult($params, $request, $param->dimfilter, $id);
                        $result[$key][0][$fld->getFieldEntityName()] = $rs;
                        $result[$key][$fld->getFieldEntityName()] = $rs;
                    }

                }

            }

        }

        return $result;

    }

    private function field_is_required_in_process($proccess, $code)
    {

        $reqs = $proccess->getProcessRequiredim();

        $dim = json_decode($reqs);

        $exist = false;
        foreach ($dim as $item) {
            if ($code == $item) {
                $exist = true;
            }
        }
        return $exist;

    }

    private function uniq_char()
    {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
        return $rand;
    }


    private function getRelationEntityConfig($mainent, $searchent)
    {

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $rels = $qb->select('p', 'a', 'b')
            ->from('AppBundle:GestRelations', 'p')
            ->join('p.relationsTable', 'a')
            ->join('p.relationEntitie', 'b')
            ->getQuery()->getArrayResult();

        $relconfig = array();

        $this->routecount = 0;

        array_push($relconfig, array(
            "rel" => "main",
            "key" => "",
            "ent" => $mainent->getEntityEntity()
        ));

        $this->traceRoute($relconfig, $mainent->getEntityId(), $searchent->getEntityId(), $rels);

        unset($this->foundedRoute[0]);
        return $this->foundedRoute;

    }

    private function traceRoute($relconfig, $mainent, $searchent, $rels)
    {


        foreach ($rels as $rel) {


            if (($rel["relationEntitie"]["entityId"] == $mainent) && ($rel["relationsTable"]["entityId"] == $searchent)) {

                array_push($relconfig, array(
                    "rel" => "manyToOne",
                    "key" => $rel['relationKey'],
                    "ent" => $rel["relationsTable"]["entityEntity"],
                    "al" => $this->uniq_char(),
                    "found" => "true"
                ));

                $this->foundedRoute = $relconfig;
                break;

            } else if (($rel["relationEntitie"]["entityId"] == $searchent) && ($rel["relationsTable"]["entityId"] == $mainent)) {

                array_push($relconfig, array(
                    "rel" => "oneToMay",
                    "key" => $rel['relationInverseKey'],
                    "ent" => $rel["relationEntitie"]["entityEntity"],
                    "al" => $this->uniq_char(),
                    "found" => "true"
                ));

                $this->foundedRoute = $relconfig;
                break;

            } else if (($rel["relationEntitie"]["entityId"] == $mainent) && !$this->entity_in_array($relconfig, $rel["relationsTable"])) {

                $relok = $relconfig;
                array_push($relok, array(
                    "rel" => "manyToOne",
                    "key" => $rel['relationKey'],
                    "ent" => $rel["relationsTable"]["entityEntity"],
                    "al" => $this->uniq_char()
                ));

                $this->traceRoute($relok, $rel["relationsTable"]["entityId"], $searchent, $rels);

            } else if (($rel["relationsTable"]["entityId"] == $mainent) && !$this->entity_in_array($relconfig, $rel["relationEntitie"])) {

                $relok = $relconfig;
                array_push($relok, array(
                    "rel" => "oneToMay",
                    "key" => $rel['relationInverseKey'],
                    "ent" => $rel["relationEntitie"]["entityEntity"],
                    "al" => $this->uniq_char()
                ));

                $this->traceRoute($relok, $rel["relationEntitie"]["entityId"], $searchent, $rels);

            }
        }


    }


    private function entity_in_array($relconfig, $ent)
    {
        foreach ($relconfig as $conf) {
            if ($ent["entityEntity"] == $conf["ent"]) {

                return true;
            }
        }
        return false;
    }


    /**
     * @Rest\Patch("/datalistaction/")
     */

    public function getDatalistActionAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $id = $param->id;

        $action = $this->getDoctrine()->getRepository('AppBundle:GestActions')->find($param->action->actionId);

        $fullentityName = "AppBundle:" . $action->getActionEntity()->getEntityEntity();

        $field = $action->getViewField();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb = $qb->select('a');

        $qb = $qb->from($fullentityName, 'a');

        $alias = "b";

        $fields = array();

        foreach ($field as $fld) {

            if ($fld->getFieldEntity()->getEntityId() == $param->action->actionEntity->entityId) {
                array_push($fields, $fld);
                if ($fld->getFieldNature() == 0) {
                    $qb = $qb->addSelect('a.' . $fld->getFieldEntityName());
                } else if ($fld->getFieldNature() == 1) {
                    $alias++;
                    $qb = $qb->addSelect($alias);
                    $qb = $qb->leftJoin("a." . $fld->getFieldEntityName(), $alias);
                }
            }
        }

        $qb = $qb->where('a.' . $param->action->actionEntity->entityKey . ' = :id')->setParameter('id', $id);


        $result = $qb->getQuery()->getArrayResult();


        foreach ($result as $key => $rs) {

            foreach ($fields as $fld) {

                if ($fld->getFieldNature() == 2) {
                    $expression = $fld->getFieldExpression();
                    $params = new \stdClass();
                    $params->expression = $expression;
                    $params->type = $fld->getFieldType();
                    $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->action->actionEntity->entityId);
                    $params->entity = $entity;
                    $id = $rs[0][$entity->getEntityKey()];
                    $rs = $this->_getExpressionRestult($params, $request, $param->dimfilter, $id);
                    $result[$key][0][$fld->getFieldEntityName()] = $rs;
                    $result[$key][$fld->getFieldEntityName()] = $rs;
                }

            }

        }

        if (isset($param->action->actionSubEntity)) {

            $relation = $this->getDoctrine()->getRepository('AppBundle:GestRelations')->findBy(
                array(
                    "relationEntitie" => $param->action->actionSubEntity->entityId,
                    "relationsTable" => $param->action->actionEntity->entityId
                )
            );

            $relationKeyName = $relation[0]->getRelationKey();

            $fullsubentityName = "AppBundle:" . $param->action->actionSubEntity->entityEntity;

            $em = $this->getDoctrine()->getManager();

            $qb = $em->createQueryBuilder();

            $qb = $qb->select('a');

            $qb = $qb->from($fullsubentityName, 'a');

            $alias = "b";

            $subfields = array();

            foreach ($field as $fld) {

                array_push($subfields, $fld);

                if ($fld->getFieldEntity()->getEntityId() == $param->action->actionSubEntity->entityId) {
                    if ($fld->getFieldNature() == 0) {
                        $qb = $qb->addSelect('a.' . $fld->getFieldEntityName());
                    } else if ($fld->getFieldNature() == 1) {
                        $alias++;
                        $qb = $qb->addSelect($alias);
                        $qb = $qb->leftJoin("a." . $fld->getFieldEntityName(), $alias);
                    }
                }
            }

            $qb = $qb->where('a.' . $relationKeyName . ' = :id')->setParameter('id', $id);

            $resultsub = $qb->getQuery()->getArrayResult();

            foreach ($resultsub as $key => $rss) {

                foreach ($subfields as $fld) {

                    if ($fld->getFieldNature() == 2) {
                        $expression = $fld->getFieldExpression();
                        $params = new \stdClass();
                        $params->expression = $expression;
                        $params->type = $fld->getFieldType();
                        $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->action->actionSubEntity->entityId);
                        $params->entity = $entity;
                        $id = $rss[0][$entity->getEntityKey()];
                        $rss = $this->_getExpressionRestult($params, $request, $param->dimfilter, $id);
                        $resultsub[$key][0][$fld->getFieldEntityName()] = $rss;
                        $resultsub[$key][$fld->getFieldEntityName()] = $rss;
                    }

                }

            }

        } else {
            $resultsub = array();
        }


        foreach ($resultsub as $key => $rs) {

            $id = $rs[0][$entity->getEntityKey()];
            $prm = new \stdClass();
            $prm->data = $rs[0];

            $rslistreg = $list->getListReg();

            $passed = true;

            foreach ($rslistreg as $itemreglist) {
                $params = new \stdClass();
                $params->type = "boolean";
                $params->entity = $entity;
                $params->expression = $itemreglist->getListregExpression();

                if (strpos($params->expression, "nofilter") == false) {
                    $rs = $this->_getExpressionRestult($params, $prm, $param->dimfilter, $id);
                    if (!$rs) {
                        unset($resultsub[$key]);
                        $passed = false;
                        break;
                    }
                }
            }


            if ($passed) {

                foreach ($field as $fld) {

                    if ($fld->getFieldNature() == 2) {
                        $expression = $fld->getFieldExpression();
                        $params = new \stdClass();
                        $params->expression = $expression;
                        $params->type = $fld->getFieldType();
                        $params->entity = $entity;
                        $id = $rs[0][$entity->getEntityKey()];
                        $rs = $this->_getExpressionRestult($params, $request, $param->dimfilter, $id);
                        $resultsub[$key][0][$fld->getFieldEntityName()] = $rs;
                        $resultsub[$key][$fld->getFieldEntityName()] = $rs;
                    }

                }

            }

        }

        $res = array("entityData" => $result, "subEntityData" => $resultsub);

        return $res;

    }


    /**
     * @Rest\Post("/doaction/")
     */

    public function postDoactionAction(Request $request)
    {


        $param = json_decode($request->getContent());

        $entity = $param->entity->entityEntity;

        $class = "\AppBundle\Entity\\" . $entity;

        if (property_exists($param, "dimfilter")) {
            $dimfilter = $param->dimfilter;
        } else {
            $dimfilter = array();
        }

        foreach ($param->action->actionAcreg as $regle) {

            $acexp = $regle->acregExpression;
            $message = $regle->acregErrormessage;
            $params = new \stdClass();
            $params->expression = $acexp;
            $params->type = "boolean";
            $params->entity = $param->entity;
            $rs = $this->_getExpressionRestult($params, $param, $dimfilter);
            if (!$rs) {
                $res = json_encode(array("error" => true, "message" => $message));
                return new View($res, Response::HTTP_OK);
            }

        }


        if ($param->action->actionType == 1) {
            $entityAction = new $class;
        } else {
            $arr = (array)$param->data;
            $entityAction = $this->getDoctrine()->getRepository('AppBundle:' . $entity)->find($arr[$param->entity->entityKey]);
        }

        if ($param->action->actionIsmainLevel == 1) {

            foreach ($param->data as $key => $prm) {

                $functionName = "set" . ucfirst($key);

                if (method_exists($entityAction, $functionName)) {

                    $field = $this->_get_field_nature($param->action->viewField, $key);

                    if ($field->fieldNature !== 1) {
                        $params = $this->_field_update_param($param->action->updateField, $key);
                        if (!empty($prm) || $params->updateExpression !== "") {

                            if (($this->_get_field_type($param->action->viewField, $key) !== "datetime") && $this->_field_updateble($param->action->updateField, $key)) {
                                if (isset($params->updateExpression)) {
                                    if ($params->updateExpression !== "") {
                                        $rs = $this->_getExpressionRestult($params, $param, $dimfilter);
                                        $entityAction->$functionName($rs);
                                    } else {
                                        $entityAction->$functionName($prm);
                                    }
                                } else {
                                    $entityAction->$functionName($prm);
                                }

                            } else if (($this->_get_field_type($param->action->viewField, $key) == "datetime") && $this->_field_updateble($param->action->updateField, $key)) {

                                if ($params->updateExpression !== null) {
                                    $rs = $this->_getExpressionRestult($params, $param, $dimfilter);
                                    $entityAction->$functionName($rs);
                                } else {
                                    $entityAction->$functionName(new \DateTime($prm));
                                }

                            }
                        }

                    } else {

                        if (!empty($prm->value)) {
                            if (($this->_get_field_type($param->action->viewField, $key) !== "datetime") && $this->_field_updateble($param->action->updateField, $key)) {
                                $entityAction->$functionName($this->getDoctrine()->getRepository('AppBundle:' . $field->fieldTargetEntity)->find($prm->value));
                            }
                        }
                    }
                }
            }

        }

        if ($param->action->actionNextStep->stepId !== null) {
            if ($param->entity->entityStepperField !== null || $param->entity->entityStepperField !== "") {
                $functionName = "set" . ucfirst($param->entity->entityStepperField);
                if (method_exists($entityAction, $functionName)) {
                    $entityAction->$functionName($param->action->actionNextStep->stepId);
                }

            }
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($entityAction);

        $subentity = $param->subentity->entityEntity;

        $subentityprocess = $param->subprocess[0]->gestEntity[0]->entityEntity;

        if ($subentity !== null) {

            $relation = $this->getDoctrine()->getRepository('AppBundle:GestRelations')->findBy(
                array(
                    "relationEntitie" => $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->subentity->entityId),
                    "relationsTable" => $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->entity->entityId)
                )
            );

            $relationKeyName = $relation[0]->getRelationKey();

            $mainEntityIdName = $param->entity->entityKey;

            $subclass = "\AppBundle\Entity\\" . $subentity;


            foreach ($param->subdata as $subdatas) {

                if ($param->action->actionType == 1) {
                    $subEentityAction = new $subclass;
                } else {
                    $arrsub = (array)$subdatas;

                    if ($arrsub[$param->subentity->entityKey] !== null && $arrsub[$param->subentity->entityKey] !== "") {
                        $subEentityAction = $this->getDoctrine()->getRepository('AppBundle:' . $subentity)->find($arrsub[$param->subentity->entityKey]);
                    } else {
                        $subEentityAction = new $subclass;
                    }
                }

                $functionName = "set" . ucfirst($relationKeyName);


                if (method_exists($subEentityAction, $functionName)) {
                    $subEentityAction->$functionName($entityAction);
                }

                foreach ($subdatas as $key => $subdata) {
                    $functionName = "set" . ucfirst($key);
                    if (method_exists($subEentityAction, $functionName)) {
                        $field = $this->_get_field_nature($param->action->viewField, $key);
                        if ($field->fieldNature !== 1) {
                            if (!empty($subdata)) {
                                if (($this->_get_field_type($param->action->viewField, $key) !== "datetime") && $this->_field_updateble($param->action->updateField, $key)) {
                                    $subEentityAction->$functionName($subdata);
                                } else if (($this->_get_field_type($param->action->viewField, $key) == "datetime") && $this->_field_updateble($param->action->updateField, $key)) {
                                    $subEentityAction->$functionName(new \DateTime($subdata));
                                }
                            }
                        } else {

                            if (!empty($subdata->value)) {
                                if (($this->_get_field_type($param->action->viewField, $key) !== "datetime") && $this->_field_updateble($param->action->updateField, $key)) {
                                    $subEentityAction->$functionName($this->getDoctrine()->getRepository('AppBundle:' . $field->fieldTargetEntity)->find($subdata->value));
                                }
                            }
                        }
                    }
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($subEentityAction);

            }

            $em->flush();

        } else if ($subentityprocess !== null) {

            $em->flush();

            $ent = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->subprocess[0]->gestEntity[0]->entityId);

            $entKey = $ent->getEntityKey();

            $relation = $this->getDoctrine()->getRepository('AppBundle:GestRelations')->findBy(
                array(
                    "relationEntitie" => $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->subprocess[0]->gestEntity[0]->entityId),
                    "relationsTable" => $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($param->entity->entityId)
                )
            );

            $relationKeyName = $relation[0]->getRelationKey();
            //$relationInverseKeyName = $relation[0]->getRelationInverseKey();

            foreach ($param->subdata as $subdatas) {

                $subdataarray = (array)$subdatas;
                $subdataarray_a = (array)$subdataarray[0];
                $id = $subdataarray_a[$entKey];

                $subentdat = $this->getDoctrine()->getRepository('AppBundle:' . $ent->getEntityEntity())->find($id);
                $functionName = "set" . ucfirst($relationKeyName);

                if (method_exists($subentdat, $functionName)) {
                    $subentdat->$functionName($entityAction);
                }

            }

            $em->flush();

        } else {
            $em->flush();
        }

        $res = json_encode(array("error" => false, "message" => "entity updated Successfully"));
        return new View($res, Response::HTTP_OK);

    }

    private function _getExpressionRestult($param, $req, $dim, $id = null)
    {

        if (isset($param->updateExpression)) {
            $expression = json_decode($param->updateExpression);
            $type = $param->updateFieldId->fieldType;
            $entity = $param->updateFieldId->fieldEntity;
        } else {
            $expression = json_decode($param->expression);
            $type = $param->type;
            $entity = $param->entity;
        }


        $expression->expression = $this->resolve_inp_expression($expression->expression, $req);

        $expression->expression = $this->resolve_dim_expression($expression->expression, $dim);

        $expression->expression = $this->resolve_get_expression($expression->expression, $entity, $type, $dim, $id);


        $expression->expression = $this->resolve_get_where_expression($expression->expression, $entity, $type, $dim, $id);

        $expression->expression = $this->resolve_php_expression($expression->expression, $entity, $type, $dim, $id);


        if ($type == "float") {

            $arrstr = explode(".", $expression->expression);

            $rs = "";

            foreach ($arrstr as $str) {
                eval("\$streval =" . $str . ";");
                $rs .= ($streval);
            }
            $rs = (float)$rs;
        }
        if ($type == "integer") {

            $arrstr = explode(".", $expression->expression);

            $rs = "";

            foreach ($arrstr as $str) {
                eval("\$streval =" . $str . ";");
                $rs .= $streval;
            }

            $rs = (integer)$rs;

        } else if ($type == "string") {

            $arrstr = explode(".", $expression->expression);

            $rs = "";

            foreach ($arrstr as $str) {
                eval("\$streval =" . $str . ";");
                $rs .= $streval;
            }

        } else if ($type == "datetime") {

            $arrstr = explode(".", $expression->expression);

            $rs = "";

            foreach ($arrstr as $str) {
                eval("\$streval =" . $str . ";");
                $rs .= $streval;
            }

            $timestamp = $rs;
            $datetimeFormat = 'Y-m-d H:i:s';
            $date = new \DateTime();
            $date->setTimestamp($timestamp);
            $rs = $date;

        } else if ($type == "boolean") {

            $arrstr = explode(".", $expression->expression);

            $rs = "";

            foreach ($arrstr as $str) {
                eval("\$streval =" . $str . ";");
                $rs .= $streval;
            }

            $rs = (boolean)$rs;

        }


        return $rs;

    }

    private function resolve_inp_expression($expr, $req)
    {


        preg_match_all("/input(\(((?>[^()]+|(?1))*)\))/", $expr, $matchinps);

        foreach ($matchinps[2] as $key => $conf) {

            $inprs = array();

            $inprs["patern"] = $matchinps[0][$key];

            $result = $this->_get_inp_result($conf, $req);

            if ($result !== null) {
                $inprs["result"] = $result;
                $expr = str_replace($inprs["patern"], $inprs["result"], $expr);
            } else {
                $expr = str_replace($inprs["patern"], null, $expr);
            }

        }

        return $expr;
    }

    private function _get_inp_result($conf, $rq)
    {

        preg_match_all("/\[([^\]]+)]/", $conf, $matchfld);

        $fld = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($matchfld[1][0]);

        $data = (array)$rq->data;

        if (isset($data[$fld->getFieldEntityName()])) {
            if ($fld->getFieldType() == 'datetime') {
                return strtotime($data[$fld->getFieldEntityName()]);
            } else {
                if ($fld->getFieldNature() == 1) {
                    return $data[$fld->getFieldEntityName()]->value;
                } else {
                    return $data[$fld->getFieldEntityName()];
                }


            }
        }
        return null;
    }


    private function resolve_dim_expression($expr, $dim)
    {
        preg_match_all("/dim(\(((?>[^()]+|(?1))*)\))/", $expr, $matchdims);

        foreach ($matchdims[2] as $key => $conf) {

            $dimrs = array();

            $dimrs["patern"] = $matchdims[0][$key];

            $result = $this->_get_dim_result($conf, $dim);

            if ($result !== null) {
                $dimrs["result"] = $result;
                $expr = str_replace($dimrs["patern"], $dimrs["result"], $expr);
            } else {
                $expr = str_replace($dimrs["patern"], null, $expr);
            }

        }

        return $expr;
    }

    private function _get_dim_result($conf, $dim)
    {
        preg_match_all("/\[([^\]]+)]/", $conf, $matchfld);
        $fld = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($matchfld[1][0]);

        foreach ($dim->ent as $diment) {
            if ($diment->param->entityKey == $fld->getFieldEntityName()) {
                return $diment->data;
            }
        }

        foreach ($dim->fld as $dimfld) {
            if ($dimfld->param->fieldEntityName == $fld->getFieldEntityName()) {
                return $dimfld->data;
            };
        }

        return null;
    }

    private function resolve_php_expression($expr, $entity, $type, $dim, $id)
    {

        preg_match_all("/php(\(((?>[^()]+|(?1))*)\))/", $expr, $matchs);

        foreach ($matchs[2] as $key => $conf) {
            $get = array();

            $get["patern"] = $matchs[0][$key];

            $result = $this->_get_php_result($entity, $conf, $dim, $id);

            if ($result !== null) {
                $get["result"] = $result;
            } else {
                $get["result"] = 0;
            }
            if ($type == "string") {
                $expr = str_replace($get["patern"], "(string)'" . $get["result"] . "'", $expr);
            } else {
                $expr = str_replace($get["patern"], $get["result"], $expr);
            }
        }

        return $expr;

    }


    private function resolve_get_expression($expr, $entity, $type, $dim, $id)
    {


        preg_match_all("/get(\(((?>[^()]+|(?1))*)\))(?!\s*.where(\(((?>[^()]+|(?1))*)\)))/", $expr, $match);

        foreach ($match[2] as $key => $conf) {
            $get = array();
            $get["patern"] = $match[0][$key];
            $where = $match[5][$key];

            $result = $this->_get_result($entity, $conf, $type, $dim, $id);
            //if($expr !="get([20])")
            //die(var_dump($result));
            if ($result !== null) {
                $get["result"] = $result;
            } else {
                $get["result"] = 0;
            }

            if ($type == "string") {
                $expr = str_replace($get["patern"], $get["result"], $expr);
            } else {
                $expr = str_replace($get["patern"], $get["result"], $expr);
            }
        }

        return $expr;
    }

    private function resolve_get_where_expression($expr, $entity, $type, $dim, $id)
    {


        preg_match_all("/get(\(((?>[^()]+|(?1))*)\))(\s*.where(\(((?>[^()]+|(?1))*)\)))/", $expr, $match);

        foreach ($match[2] as $key => $conf) {
            $get = array();
            $get["patern"] = $match[0][$key];
            $where = $match[5][$key];

            $result = $this->_get_where_result($entity, $conf, $where, $type, $dim, $id);
            if ($result !== null) {
                $get["result"] = $result;
            } else {
                $get["result"] = 0;
            }
            if ($type == "string") {
                $expr = str_replace($get["patern"], "(string)'" . $get["result"] . "'", $expr);
            } else {
                $expr = str_replace($get["patern"], $get["result"], $expr);
            }
        }

        return $expr;
    }


    private function _get_php_result($ent, $field, $dim, $id)
    {


        $ex = str_replace('"', "", $field);
        $arrstr = explode(".", $ex);
        $rsex = "";
        foreach ($arrstr as $str) {
            $rsex .= $str;
        }
        return eval($rsex);
    }


    private
    function _get_where_result($ent, $field, $where, $type, $dim, $id)
    {

        $field = $this->resolve_dim_expression($field, $dim);

        $field = $this->resolve_get_expression($field, $ent, $type, $dim, $id);

        $field = $this->resolve_get_where_expression($field, $ent, $type, $dim, $id);

        $field = $this->resolve_php_expression($field, $ent, $type, $dim, $id);


        $where = $this->resolve_dim_expression($where, $dim);

        $where = $this->resolve_get_expression($where, $ent, $type, $dim, $id);

        $where = $this->resolve_get_where_expression($where, $ent, $type, $dim, $id);

        $where = $this->resolve_php_expression($where, $ent, $type, $dim, $id);


        if (isset($ent->entityId)) {
            $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($ent->entityId);
        } else {
            $entity = $ent;
        }

        preg_match_all("/\[([^\]]+)]/", $field, $matchfld);

        $fldlist = array();

        $em = $this->getDoctrine()->getManager();


        $qb = $em->createQueryBuilder();

        $qb = $qb->select('a');

        $qb = $qb->from("AppBundle:" . $entity->getEntityEntity(), 'a');

        $allroute = array();

        foreach ($matchfld[0] as $key => $conffld) {

            $fieldconf = array();

            $fieldconf["fieldReplacementPhrase"] = $conffld;

            $fieldId = $matchfld[1][$key];

            $fld = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($fieldId);


            if ($entity->getentityId() != $fld->getFieldEntity()->getentityId()) {

                $relconf = $this->getRelationEntityConfig($entity, $fld->getFieldEntity());

                $fieldconf["fieldJoinConf"] = $relconf;

                if (!$this->_route_conf_exist($allroute, $relconf)) {

                    array_push($allroute, $relconf);

                    foreach ($relconf as $key => $relroute) {


                        if ($key != 1) {
                            $qb = $qb->leftJoin($prevalias . "." . $relroute["key"], $relroute["al"]);

                        } else {
                            $qb = $qb->leftJoin("a." . $relroute["key"], $relroute["al"]);

                        }

                        $prevalias = $relroute["al"];

                    }

                }

                if ($fld->getFieldNature() == 1) {
                    $fieldconf["fieldName"] = "IDENTITY(" . $prevalias . "." . $fld->getFieldEntityName() . ")";
                } else {
                    $fieldconf["fieldName"] = $prevalias . "." . $fld->getFieldEntityName();
                }


            } else {
                $fieldconf["fieldJoinConf"] = "same";
            }

            array_push($fldlist, $fieldconf);

        }


        $wherarray = array();

        preg_match_all("/\[([^\]]+)]/", $where, $matchwhere);

        foreach ($matchwhere[0] as $key => $confwhere) {

            $wfieldconf = array();

            $wfieldconf["wfieldReplacementPhrase"] = $confwhere;

            $fieldId = $matchwhere[1][$key];

            $flde = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($fieldId);

            $entwhere = $flde->getFieldEntity()->getEntityEntity();

            $wfieldconf["wfieldEntity"] = $entwhere;

            $wfieldconf["wfieldalias"] = "";

            $wfieldconf["wfieldEntityName"] = $flde->getFieldEntityName();

            foreach ($fldlist as $fld) {
                if ($fld["fieldJoinConf"] !== "same") {
                    foreach ($fld["fieldJoinConf"] as $fieldConf) {
                        if ($fieldConf["ent"] == $entwhere) {
                            $wfieldconf["wfieldalias"] = $fieldConf["al"];
                        };
                    };
                }
            }


            if ($entity->getEntityEntity() == $entwhere) {
                $wfieldconf["wfieldalias"] = "a";
            }

            if ($wfieldconf["wfieldalias"] == "") {

                $relconf = $this->getRelationEntityConfig($entity, $flde->getFieldEntity());

                $relconffiltred = $this->_route_filter_conf($allroute, $relconf);

                if (!$this->_route_conf_exist($allroute, $relconffiltred[1])) {

                    if (!empty($relconffiltred[1])) {

                        array_push($allroute, $relconffiltred[1]);

                        foreach ($relconffiltred[1] as $key => $relroute) {

                            if ($key != 1) {
                                $qb = $qb->leftJoin($prevalias . "." . $relroute["key"], $relroute["al"]);
                            } else {
                                if ($relconffiltred[0] == "") {
                                    $qb = $qb->leftJoin("a." . $relroute["key"], $relroute["al"]);
                                } else {
                                    $qb = $qb->leftJoin($relconffiltred[0] . "." . $relroute["key"], $relroute["al"]);
                                }
                            }

                            $prevalias = $relroute["al"];

                        }


                        $wfieldconf["wfieldalias"] = $prevalias;
                        //die(var_dump($relconffiltred[0]));
                    } else {
                        $wfieldconf["wfieldalias"] = $relconffiltred[0];
                    }

                } else {
                    $wfieldconf["wfieldalias"] = $relconffiltred[0];
                }
            }


            array_push($wherarray, $wfieldconf);


        }


        foreach ($fldlist as $fld) {
            $field = str_replace($fld["fieldReplacementPhrase"], $fld["fieldName"], $field);
        }

        foreach ($wherarray as $wherfld) {
            $rep = $wherfld["wfieldalias"] . "." . $wherfld["wfieldEntityName"];
            $where = str_replace($wherfld["wfieldReplacementPhrase"], $rep, $where);
        }

        $where = str_replace("&&", " AND ", $where);

        $where = str_replace("||", " OR ", $where);

        $where = str_replace("==", "=", $where);


        $qb = $qb->addSelect($field . " as rs");

        $qb = $qb->distinct("a");

        if ($id !== null) {
            $qb = $qb->where('a.' . $entity->getEntityKey() . "=:prms")->setParameter("prms", $id);
            $qb = $qb->andWhere($where);
        } else {
            $qb = $qb->where($where);
        }


        $rs = $qb->getQuery()->getArrayResult();
        // die($rs);

        return $rs[0]["rs"];

    }


    private
    function _get_result($ent, $field, $type, $dim, $id)
    {


        $field = $this->resolve_dim_expression($field, $dim);

        $field = $this->resolve_get_expression($field, $ent, $type, $dim, $id);

        $field = $this->resolve_get_where_expression($field, $ent, $type, $dim, $id);

        $field = $this->resolve_php_expression($field, $ent, $type, $dim, $id);

        //if($expr !="get([20])")


        if (isset($ent->entityId)) {
            $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($ent->entityId);
        } else {
            $entity = $ent;
        }

        preg_match_all("/\[([^\]]+)]/", $field, $matchfld);


        $fldlist = array();

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb = $qb->select('a');

        $qb = $qb->from("AppBundle:" . $entity->getEntityEntity(), 'a');

        $allroute = array();

        foreach ($matchfld[0] as $key => $conffld) {

            $fieldconf = array();

            $fieldconf["fieldReplacementPhrase"] = $conffld;

            $fieldId = $matchfld[1][$key];

            $fld = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($fieldId);


            if ($entity->getentityId() != $fld->getFieldEntity()->getentityId()) {

                $relconf = $this->getRelationEntityConfig($entity, $fld->getFieldEntity());

                $fieldconf["fieldJoinConf"] = $relconf;

                if (!$this->_route_conf_exist($allroute, $relconf)) {

                    array_push($allroute, $relconf);

                    foreach ($relconf as $key => $relroute) {

                        //$qb = $qb->addSelect($relroute["al"]);
                        if ($key != 1) {
                            $qb = $qb->leftJoin($prevalias . "." . $relroute["key"], $relroute["al"]);
                        } else {
                            $qb = $qb->leftJoin("a." . $relroute["key"], $relroute["al"]);

                        }

                        $prevalias = $relroute["al"];

                    }

                }

                if ($fld->getFieldNature() == 1) {
                    $fieldconf["fieldName"] = "IDENTITY(" . $prevalias . "." . $fld->getFieldEntityName() . ")";
                } else {
                    $fieldconf["fieldName"] = $prevalias . "." . $fld->getFieldEntityName();
                }


            } else {
                $fieldconf["fieldJoinConf"] = "same";
                if ($fld->getFieldNature() == 1) {
                    $fieldconf["fieldName"] = "IDENTITY(a." . $fld->getFieldEntityName() . ")";
                } else {
                    $fieldconf["fieldName"] = "a." . $fld->getFieldEntityName();
                }
            }

            array_push($fldlist, $fieldconf);

        }


        foreach ($fldlist as $fld) {
            $field = str_replace($fld["fieldReplacementPhrase"], $fld["fieldName"], $field);
        }

        $qb = $qb->addSelect($field . " as rs");

        if ($id !== null) {
            $qb = $qb->where('a.' . $entity->getEntityKey() . "=:prms")->setParameter("prms", $id);
        }

        $qb = $qb->distinct("a");

        $rs = $qb->getQuery()->getArrayResult();

        return $rs[0]["rs"];

    }

    private function _route_conf_exist($routearray, $route)
    {


        if (!empty($routearray)) {

            $exist = true;

            foreach ($routearray as $reoutref) {
                foreach ($route as $key => $relroute) {
                    if (isset($reoutref[$key])) {
                        if (!($reoutref[$key]["rel"] == $relroute["rel"] && $reoutref[$key]["key"] == $relroute["key"] && $reoutref[$key]["ent"] == $relroute["ent"])) {
                            $exist = false;
                        }
                    } else {
                        $exist = false;
                    }
                }
            }

            return $exist;

        } else {
            return false;
        }
    }


    private function _route_filter_conf($routearray, $route)
    {

        $lastAlias = "";

        if (!empty($routearray)) {

            $continue = true;

            foreach ($routearray as $reoutref) {

                foreach ($route as $key => $relroute) {
                    if (isset($reoutref[$key])) {
                        if (!($reoutref[$key]["rel"] == $relroute["rel"] && $reoutref[$key]["key"] == $relroute["key"] && $reoutref[$key]["ent"] == $relroute["ent"])) {

                        } else {
                            $lastAlias = $reoutref[$key]["al"];
                            unset($route[$key]);
                        }
                    }
                }

            }

            return array($lastAlias, $route);

        } else {

            return array($lastAlias, $route);

        }
    }


    private
    function _get_field_type($fields, $fieldName)
    {
        foreach ($fields as $fld) {
            if ($fld->fieldEntityName == $fieldName) {
                return $fld->fieldType;
            }
        }
        return 'string';
    }

    private
    function _get_field_nature($fields, $fieldName)
    {
        foreach ($fields as $fld) {
            if ($fld->fieldEntityName == $fieldName) {
                return $fld;
            }
        }
        return 'string';
    }

    private
    function _field_updateble($fields, $fieldName)
    {
        foreach ($fields as $fld) {
            if ($fld->updateFieldId->fieldEntityName == $fieldName) {
                return true;
            }
        }
        return false;
    }

    private
    function _field_update_param($fields, $fieldName)
    {
        foreach ($fields as $fld) {
            if ($fld->updateFieldId->fieldEntityName == $fieldName) {
                return $fld;
            }
        }
        return false;
    }


    /**
     * @Rest\Patch("/field/{id}")
     */

    public
    function updateFieldAction($id, Request $request)
    {


        $param = json_decode($request->getContent());

        $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($id);
        $field->setFieldInterfaceName($param->fieldInterfaceName);
        $em = $this->getDoctrine()->getManager();
        $em->persist($field);
        $em->flush();

        return new View("field updated Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/entity/{id}")
     */

    public
    function updateEntityAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $param = json_decode($request->getContent());

        $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->find($id);
        $entity->setEntityInterfaceName($param->entityInterfaceName);
        $entity->setEntityDisplayField($param->entityDisplayField);
        $entity->setEntityStepperField($param->entityStepperField);

        foreach ($param->fields as $fld) {
            $flds = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($fld->fieldId);
            $flds->setFieldOrder($fld->fieldOrder);
            $em->persist($flds);
            $em->flush();
        }


        $em->persist($entity);
        $em->flush();

        return new View("Entity  updated Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Patch("/combo")
     */

    public
    function getComboAction(Request $request)
    {

        $param = json_decode($request->getContent());


        $entity = $this->getDoctrine()->getRepository('AppBundle:GestEntity')->findBy(array(
            "entityEntity" => $param->entity
        ));

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb->select(
            array('u.' . $entity[0]->getEntityKey() . '  id'
            , 'u.' . $entity[0]->getEntityDisplayField() . '  text')
        )
            ->from('AppBundle:' . $param->entity, 'u');

        $data = $qb->getQuery()->getArrayResult();

        $blank = array(array("id" => "", "text" => "--"));

        $data = array_merge($blank, $data);

        return array("data" => $data);

    }


    /**
     * @Rest\Patch("/deleteentitydata")
     */

    public
    function deletEentitydataAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $entity = $param->action->actionEntity->entityEntity;

        $class = "\AppBundle\Entity\\" . $entity;

        $arr = (array)$param->data;

        $stepperField = $param->action->actionEntity->entityStepperField;

        $entityAction = $this->getDoctrine()->getRepository('AppBundle:' . $entity)->find($arr[$param->action->actionEntity->entityKey]);

        $functionName = "set" . ucfirst($stepperField);

        if (method_exists($entityAction, $functionName)) {
            $entityAction->$functionName(null);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entityAction);
        $em->flush();

        return new View("Entity Data Deleted Successfully", Response::HTTP_OK);

    }


    /**
     * @Rest\Delete("/agfield/{id}")
     */

    public function idAgfieldAction($id)
    {
        $sn = $this->getDoctrine()->getManager();
        $field = $this->getDoctrine()->getRepository('AppBundle:GestFields')->find($id);

        if (empty($field)) {
            return new View("field not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($field);
            $sn->flush();
        }
    }


    /**
     * @Rest\Delete("/acreg/{id}")
     */

    public function idAcregAction($id)
    {
        $sn = $this->getDoctrine()->getManager();
        $field = $this->getDoctrine()->getRepository('AppBundle:GestActionsRegle')->find($id);

        if (empty($field)) {
            return new View("Action regle not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($field);
            $sn->flush();
        }
    }


    /**
     * @Rest\Delete("/listreg/{id}")
     */

    public function idListregAction($id)
    {
        $sn = $this->getDoctrine()->getManager();
        $listreg = $this->getDoctrine()->getRepository('AppBundle:GestListRegle')->find($id);

        if (empty($listreg)) {
            return new View("List regle not found", Response::HTTP_NOT_FOUND);
        } else {
            $sn->remove($listreg);
            $sn->flush();
        }
    }



    /**
     * @Rest\Patch("/getdata/")
     */

    public function PatchGetDataAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb->select('u')->from('AppBundle:' . $param->entity->entityEntity, 'u');

        $data = $qb->getQuery()->getArrayResult();

        return $data;

    }

    /**
     * @Rest\Patch("/accessdata/")
     */

    public function PatchAccessDataAction(Request $request)
    {

        $param = json_decode($request->getContent());

        $entity = $param->action->actionEntity->entityEntity;

        $class = "\AppBundle\Entity\\" . $entity;

        $arr = (array)$param->data;

        $stepperField = $param->action->actionEntity->entityStepperField;

        $entityAction = $this->getDoctrine()->getRepository('AppBundle:' . $entity)->find($arr[$param->action->actionEntity->entityKey]);

        $functionName = "set" . ucfirst($stepperField);

        if (method_exists($entityAction, $functionName)) {
            $entityAction->$functionName(null);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entityAction);
        $em->flush();

        return new View("Entity Data Deleted Successfully", Response::HTTP_OK);

    }


}