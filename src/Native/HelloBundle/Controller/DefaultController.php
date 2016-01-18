<?php

namespace Native\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Native\HelloBundle\Form\rechercheType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('HelloBundle:Default:index.html.twig', array('name' => $name));
    }

    public function testAction($ch = "") {
        $tab = array();


        $requete = $this->get('request');



        if ($requete->getMethod() == 'POST') {

            $pass = $_POST['adresse']; //////Comme PHP


            $pieces = explode(" ", $pass);

            foreach ($pieces as $value) {

                $ch.=" content LIKE '%$value%' OR";

            }

            $nbr = 2;
            $req = "SELECT nom,content FROM utilisateur WHERE";
            $last = $req . substr($ch, 0, -$nbr);


            $stmt = $this->getDoctrine()->getManager()
                    ->getConnection()
                    ->prepare("$last");


            $stmt->execute();
            $result = $stmt->fetchAll();
           
////            var_dump($result);
//            \Doctrine\Common\Util\Debug::dump($result);
////            die();
            
        }
        
        return $this->render('HelloBundle:Default:test.html.twig', array('form' => $this->createForm('form'),'result'=>$result));
    
         
            }

}
