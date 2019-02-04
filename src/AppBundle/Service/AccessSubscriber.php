<?php

namespace AppBundle\Service;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use AppBundle\Annotation\CheckRequest;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use AppBundle\Annotation\ActionName;

class AccessSubscriber implements EventSubscriberInterface {

    private $reader;

    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader) {
        $this->reader = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function onKernelController(FilterControllerEvent $event) {


    

        if (!is_array($controllers = $event->getController())) {
            return;
        }

        $request = $event->getRequest();
        $content = $request->getContent();
        $controllerfulluniqpath = $request->attributes->get('_controller');

        list($controller, $methodName) = $controllers;

//        $reflectionClass = new \ReflectionClass($controller);
//        $classAnnotation = $this->reader
//            ->getClassAnnotation($reflectionClass );

        $reflectionObject = new \ReflectionObject($controller);
        $reflectionMethod = $reflectionObject->getMethod($methodName);
        $methodAnnotation = $this->reader
                ->getMethodAnnotations($reflectionMethod, ActionName::class);

        foreach ($methodAnnotation as $annotation) {
            if (isset($annotation->nameOfAction)) {
             
            }
        }


    }

    public static function getSubscribedEvents() {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }

}
