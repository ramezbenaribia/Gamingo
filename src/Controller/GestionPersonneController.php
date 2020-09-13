<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/gestion/personne")
 */
class GestionPersonneController extends AbstractController
{
    /**
     * @Route("", name="gestion_personne")
     */
    public function index(Request $request)
    {
        $page = $request->query->get('page') ?? 1;
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $nbEnregistrements = $repository->count(array());
        $nbpage = ($nbEnregistrements % 10) ? (intdiv($nbEnregistrements, 10)) + 1 : (intdiv($nbEnregistrements, 10));
        $personnes = $repository->findBy(array(), ['id' => 'asc'], 10, ($page - 1) * 10);
        return $this->render('Admin/gestion_personne.html.twig', [
            'personnes' => $personnes,
            'nbpage' => $nbpage
        ]);

    }
        /**
         * @param $id
         * @Route("/delete/{id}", name="personne.delete")
         */
        public function deletePersonne($id)
    {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personne = $repository->find($id);
        if (!$personne) {
            $this->addFlash('error', 'Suppression échouée, personne inexistant');
        } else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($personne);
            $manager->flush();
            $this->addFlash('success', 'personne supprimé avec succés');
        }
        return $this->redirectToRoute('gestion_personne');
    }


}
