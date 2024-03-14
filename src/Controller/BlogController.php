<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $repo): Response
    {
        $articles=$repo->findAll('Titre de l\'article');
        Return $this->render('blog/index.html.twig', ['controller_name' =>
        'BlogController','articles'=>$articles,]);
    }

#[Route('/blog/new', name: 'new_form') ]
public function new(Request $request,EntityManagerInterface
$entityManager): Response
{
$article = new Article();
$article->setCreatedat(new
\DateTimeImmutable('tomorrow'));
$form = $this->createFormBuilder($article)
->add('title', TextType::class)
->add('image',TextType::class)
->add('content', TextType::class)
->add('save', SubmitType::class, ['label' => 'Create Article'])
->getForm();
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$article = $form->getData();
$entityManager->persist($article);
$entityManager->flush();
return $this->redirectToRoute('app_blog');
}
return $this->render('/blog/create.html.twig', ['form' => $form,]);}

#[Route('/blog/{id}',name:'blog_show')]
public function show($id,ArticleRepository $repo)
      {
       $article = $repo->find($id);
       return $this->render('blog show.html.twig'['article'=>$article]);          
      }
   }
