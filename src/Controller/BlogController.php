<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $repo): Response
    {
        $articles=$repo->findAll('Titre de l\'article');
        Return $this->render('blog/index.html.twig', ['controller_name' =>
        'BlogController','articles'=>$articles,]);
    }
        

    #[Route('/blog/{id}', name: 'blog_show')]
    public function show($id, ArticleRepository $repo)
    {
       $article = $repo->find($id);
       return $this->render('blog/show.html.twig',['article'=>$article]);
    }

   
}
