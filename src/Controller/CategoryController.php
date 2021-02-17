<?php


namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{

    /**
     * @var CategoryRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CategoryRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/", name="category.index")
     */
    public function index()
    {

        // Afficher toutes les catégories que l'on trouve sur la plateforme.
        $categories = $this->repository->findAll();

        return $this->render('category/index.html.twig',[
            'categories'=>$categories
        ]);
    }

    /**
     * @Route("/add", name="category.add", methods={"GET", "POST"}))
     */
    public function add(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($category);
            $this->em->flush();
            $this->addFlash('success','La catégorie à bien été créée !');
            return $this->redirectToRoute('category.index');
        }

        return $this->render('category/add.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category.edit", methods={"GET|POST"})
     */
    public function edit(Category $category, Request $request){

        $form = $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','La catégorie à bien été modifiée');
            return $this->redirectToRoute('category.index');
        }
        return $this->render('category/edit.html.twig',[
            'category'=>$category,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category.delete", methods={"DELETE"})
     */
    public function delete(Category $category, Request $request){

        if ($this->isCsrfTokenValid('delete'.$category->getId(),$request->get('_token'))){
            $this->em->remove($category);
            $this->em->flush();
            $this->addFlash('success','Catégorie supprimée avec succès');
        }

        return $this->redirectToRoute('category.index');
    }


}