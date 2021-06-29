<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repoCategory;
    private $repoArticle;

    public function __construct(CategoryRepository $repoCategory, ArticleRepository $repoArticle)
    {
        $this->repoCategory = $repoCategory;
        $this->repoArticle = $repoArticle;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles =  $this->repoArticle->findAll();
        $categories =  $this->repoCategory->findAll();

        return $this->render('home/index.html.twig', [
            "articles" => $articles,
            "categories" => $categories
        ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Article $article): Response
    {
        // dd($article);
        if (!$article) {
            return $this->redirectToRoute('home');
        }

        return $this->render('home/showArticle.html.twig', [
            "article" => $article
        ]);
    }


    /**
     * @Route("/bycategory/{id}", name="bycategory")
     */
    public function index2(Category $category): Response
    {
        $articles = $category->getArticles()->getValues();


        return $this->render('home/index.html.twig', [
            "articles" => $articles,
            "categories" => $this->repoCategory->findAll(),
        ]);
    }
}
