<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/personne/connected/{id?0}" , name="personne.connected")
     */
    public function ProfilePersonne(Personne $personne=null) {
        if (!$personne) {
            $personne=  new Personne();
        }
        return $this->render('personne/connected.html.twig' , [
            'personne'=> $personne
        ]);
    }


    /**
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @Route("/personne/login", name="personne.login")
     */
    public function login(Request $request){
        $personne= new Personne();
        $form=$this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);
        $repository=$this->getDoctrine()->getRepository(Personne::class);
        $personneExistant=$repository->findOneBy(['email'=>$personne->getEmail()]);
        if ($form->isSubmitted()) {
            if ($personneExistant && ($personneExistant->getEmail()!='admin@admin.com')) {

                if ($personneExistant->getPassword() == $personne->getPassword())
                    return $this->redirect('/personne/connected/'.$personneExistant->getId());
                else {
                    $this->addFlash('error', 'Email/Password combination don\'t match.');
                    return $this->redirectToRoute('personne.login');
                }
            }
            elseif ($personne->getEmail() == 'admin@admin.com'){
                if($personne->getPassword()=='admin'){
                    return $this->redirectToRoute("admin_profile");
                }
                else {
                    $this->addFlash('error', 'Email/Password combination don\'t match.');
                    return $this->redirectToRoute('personne.login');
                }
            }

            else {
                $this->addFlash('error', 'Personne inexistante.');
                return $this->redirectToRoute('personne.login');
            }
        }


        return $this->render('personne/login.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @Route("/personne/signup", name="personne.signup")
     */
    public function addPersonne(EntityManagerInterface $manager, Request $request){
        $personne= new Personne();
        $form=$this->createForm(PersonneType::class, $personne);
        $form->remove('image');
        $form->handleRequest($request) ;

        $repository=$this->getDoctrine()->getRepository(Personne::class);
        $personneExistant=$repository->findOneBy(['email'=>$personne->getEmail()]);

        if ($form->isSubmitted() ) {
            if (!$personneExistant) {
                $manager->persist($personne);
                $manager->flush();
                return $this->redirect('/personne/connected/'.$personne->getId());
            }
            else{
                $this->addFlash('error', 'Compte existant.');
                return $this->redirectToRoute('personne.signup');
            }

//            if($personne->getEmail()=="admin")
//                return $this->redirectToRoute("personne");
//            else
//            return $this->redirectToRoute("home");
        }

        return $this->render('personne/signup.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/personne/edit/{id?0}", name="personne.edit")
     */
    public function editPersonne(Request $request, Personne $personne = null, EntityManagerInterface $manager) {
        if (!$personne) {
            $personne=  new Personne();
        }
        $form=$this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request) ;


        if ($form->isSubmitted() ) {
            if($form['image']) {
                $image = $form['image']->getData();

                $imagePath = md5(uniqid()).$image->getClientOriginalName();
                $destination = __DIR__.'/../../public/assets/uploads';
                try {
                    $image->move($destination,$imagePath);
                    $personne->setImage('assets/uploads/'.$imagePath);
                } catch (FileException $fe) {
                    echo $fe;
                }
            }
            $manager->persist($personne);
            $manager->flush();
            return $this->redirect('/personne/connected/'.$personne->getId());
        }
        return $this->render('personne/edit.html.twig', array(
            'form' => $form->createView() ,
            'personne' => $personne ,
        ));
    }


}
