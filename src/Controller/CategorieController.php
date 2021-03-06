<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Riff;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Categorie::class)->findby(['superCategorie'=> null]);
        /*$categoriesArray = [];
        foreach ($categories as $category){
            dd($category->getSuperCategorie()->getName());
           if($category->getSuperCategorie() == null){
               array_push($categoriesArray, [ $category->getName(), $category]);
           }
           else{
               array_push($categoriesArray[$category->getSuperCategorie()->getName()], $category);
           }
        }*/
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController', 'categories'=>$categories
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="categorie_show")
     */
    public function show(EntityManagerInterface $entityManager, $id): Response
    {
        $categorie = $entityManager->getRepository(Categorie::class)->findOneBy(['id'=> $id]);
//        if ( $categorie != null ){
//            Categorie::$categorie
//        }

        $riffs = $entityManager->getRepository(Riff::class)->findBy( ['categorie'=> $id ]);
        return $this->render('categorie/show.html.twig', ['controller_name' => 'CategorieController',"riffs"=>$riffs,"categorie"=>$categorie]);
    }





}
