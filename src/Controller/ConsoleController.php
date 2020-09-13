<?php

namespace App\Controller;

use App\Entity\Console;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConsoleController extends AbstractController
{
    /**
     * @Route("/console/{id?0}", name="console")
     */
    public function index( Request $request , Console $console )
    {
        $page = $request->query->get('page') ?? 1 ;
        $repository1 = $this->getDoctrine()->getRepository(Game::class);
//        $repository2 = $this->getDoctrine()->getRepository(Console::class);
//        $console_id=$console->getId();
        $nbreEnregistrements = $repository1->count(array());
        $nbpage=($nbreEnregistrements%10)?(intdiv($nbreEnregistrements,10))+1:(intdiv($nbreEnregistrements,10));

//        $games = $repository1->findBy (array('console' => $console_id ),array('id'=>'ASC'),10, ($page -1 ) * 10 );
        $games = $console->getGames() ;
        return $this->render('console/console.html.twig',[
            'games' => $games,
            'nbpage'=> $nbpage,
            'console'=>$console
        ]);
    }
}
