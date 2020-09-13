<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Console;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/search.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    public function search(){
        $form=$this->createFormBuilder(null)
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class)
            ->add('search', SubmitType::class)
            ->getForm();
        return $this->render('search/search.html.twig', [
            'form_search'=> $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @Route("/handleSearch", name="handleSearch")
     */
    public function handleRequest(Request $request){
        $repositoryGame=$this->getDoctrine()->getRepository(Game::class);
        $repositoryConsole=$this->getDoctrine()->getRepository(Console::class);
        $repositoryCategory=$this->getDoctrine()->getRepository(Categorie::class);
        $searchItem=$request->request->get("form")["query"];
        if ($searchItem){
            $gameExistant=$repositoryGame->findOneBy(['name'=>$searchItem]);
            if ($gameExistant){
                return $this->redirect('/games/'.$gameExistant->getId());
            }
            else{
                $categoryExistant=$repositoryCategory->findOneBy(['name'=>$searchItem]);
                if ($categoryExistant){
                    return $this->redirect('/category/'.$searchItem);
                }
                else{
                    $consoleExistant=$repositoryConsole->findOneBy(['name'=>$searchItem]);
                    if ($consoleExistant){
                        return $this->redirect('/console/'.$searchItem);
                    }
                    else{
                        $this->addFlash('error', 'Couldn\'t find searched item.');
                        return $this->redirect('/home');
                    }
                }
            }
        }


    }
}
