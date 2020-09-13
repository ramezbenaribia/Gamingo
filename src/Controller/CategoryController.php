<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{category?null}", name="category")
     */

    public function index(Request $request, $category)
    {
        $page = $request->query->get('page') ?? 1 ;
        $repository = $this->getDoctrine()->getRepository(Game::class);
        $repository2 = $this->getDoctrine()->getRepository(Categorie::class);
        $category_id=$repository2->findOneBy(['name'=>$category])->getId();
        $nbreEnregistrements = $repository->count(array());
        $nbpage=($nbreEnregistrements%10)?(intdiv($nbreEnregistrements,10))+1:(intdiv($nbreEnregistrements,10));
        $games = $repository->findBy(
            ['categorie'=>$category_id],array('id'=>'ASC'),10, ($page -1 ) * 10 );
        return $this->render('category/category.html.twig',[
            'games' => $games,
            'nbpage'=> $nbpage,
            'category'=>$category
        ]);
    }

}
