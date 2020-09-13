<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GestionCategoryController
 * @package App\Controller
 * @Route("admin/gestion/category")
 */

class GestionCategoryController extends AbstractController
{
    /**
     * @Route("", name="gestion_category")
     */
    public function index(Request $request)
    {

        $page = $request->query->get('page') ?? 1;
        $repository = $this->getDoctrine()->getRepository( Categorie::class );

        $nbEnregistrements = $repository->count(array());
        $nbpage = ($nbEnregistrements % 10) ? (intdiv($nbEnregistrements, 10)) + 1 : (intdiv($nbEnregistrements, 10));
        $categories = $repository->findBy(array(), ['id' => 'asc'], 10, ($page - 1) * 10);

        return $this->render('Admin/gestion_category.html.twig', [
            'categories' =>  $categories ,
            'nbpage' => $nbpage ,
        ]);

    }


    /**
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/edit/{id?0}", name="category.edit")
     */
    public function editCategory(Request $request, Categorie $categorie = null, EntityManagerInterface $manager) {
        if (!$categorie) {
            $categorie =  new Categorie();
        }
        $form=$this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request) ;


        if ($form->isSubmitted() ) {

            if($form['image']) {
                $image = $form['image']->getData();

                $imagePath = md5(uniqid()).$image->getClientOriginalName();
                $destination = __DIR__.'/../../public/assets/uploads';
                try {
                    $image->move($destination,$imagePath);
                    $categorie->setImage('assets/uploads/'.$imagePath);
                } catch (FileException $fe) {
                    echo $fe;
                }
            }
            $manager->persist($categorie);
            $manager->flush();
            return $this->redirect('admin/gestion/category');
        }

        return $this->render('Admin/form_catégorie.html.twig', array(
            'form' => $form->createView() ,
            'categorie' => $categorie ,
        ));
    }
    /**
     * @param $id
     * @Route("/delete/{id}", name="category.delete")
     */
    public function deleteCategory($id)
    {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $category = $repository->find($id);
        if (!$category) {
            $this->addFlash('error', 'Suppression échouée, catégorie inexistant');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($category);
            $manager->flush();
            $this->addFlash('success', 'Jeu supprimé avec succés');
        }
        return $this->redirectToRoute('gestion_category');
    }
}
