<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game/name", name="game")
     */
    public function index()
    {
        return $this->render('game/game.html.twig');
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/game/page/{id?0}" , name="game.page")
     */
    public function ProfilePersonne(Game $game ) {

        $repository1 = $this->getDoctrine()->getRepository(Game::class);

        $company = $game->getCompany() ;
        $category_id= $game->getCategorie()->getId() ;
        $games_category = $repository1->findBy(
            ['categorie'=>$category_id],array('id'=>'ASC'),6  );
        $games_company = $repository1->findBy(
            ['company'=>$company],array('id'=>'ASC'),4  );


        return $this->render('game/game.html.twig' , [
            'game'=> $game,
            'games_category' => $games_category ,
            'games_company' => $games_company
        ]);
    }

}
