<?php


namespace AppBundle\modelParser;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Fournisseur;
use Doctrine\Common\Annotations\AnnotationReader;

class modelParser extends FOSRestController
{

    /**
     * @Rest\Get("/entity")
     */
    public function getmodelParserAction()
    {


        $result = "";

        $entities = array();
        $em = $this->getDoctrine()->getManager();
        $meta = $em->getMetadataFactory()->getAllMetadata();
        $annotationReader = new AnnotationReader();
        foreach ($meta as $m) {

            $paths = explode("\\" ,  $m->getName());

            $result .= " export class ";
            $result .= end ($paths) . " { \n ";
            $class = new \ReflectionClass($m->getName());

            $proprity = $class->getProperties();

            foreach ($proprity as $p) {
                $nameslash = "\\";
                $reflectionProperty = new \ReflectionProperty($nameslash.$m->getName(), $p->name);

                $propertyAnnotations = $annotationReader->getPropertyAnnotations($reflectionProperty);

                foreach ($propertyAnnotations as $propertyAnnotation){
                    $nameclass= new \ReflectionClass($propertyAnnotation);

                    if($nameclass->name ==  'Doctrine\ORM\Mapping\Column'){
                       //$result .= $p->name." : ".$propertyAnnotation->type."; \n ";
                        $result .= $p->name." : "."string"."; \n ";
                    }
                }


            }

            $result .= " } \n";

        }



        echo  $result;die();

    }


}
