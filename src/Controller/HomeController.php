<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $repoArticle, CategoryRepository $repoCategory): Response
    {
        $articles= $repoArticle->findAll();
        $categories = $repoCategory->findAll();

        return $this->render('home/index.html.twig',[
            "articles"=>$articles,
            "categories" => $categories
        ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(ArticleRepository $repoArticle, $id): Response
    {
        $article = $repoArticle->find($id);
        // dd($article);
        if (!$article) {
            return $this->redirectToRoute('home');
        }

        return $this->render('home/showArticle.html.twig', [
            "article" => $article
        ]);
        
    }
}
