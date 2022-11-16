<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function contact(): Response
    {
        return $this->render('blog/blog.html.twig', []);
    }

    #[Route('/single_post', name: 'single_post')]
    public function singlePost(): Response
    {
        return $this->render('blog/single_post.html.twig', []);
    }

    #[Route('/blog/new', name: 'new_post')]
public function newPost(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
{
    $post = new Post();
    $form = $this->createForm(PostFormType::class, $post);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $post = $form->getData();   
        $post->setSlug($slugger->slug($post->getTitle()));
        $post->setPostUser($this->getUser());
        $post->setNumLikes(0);
        $post->setNumComments(0);
        $entityManager = $doctrine->getManager();    
        $entityManager->persist($post);
        $entityManager->flush();
        return $this->render('blog/new_post.html.twig', array(
            'form' => $form->createView()    
        ));
    }
    return $this->render('blog/new_post.html.twig', array(
        'form' => $form->createView()    
    ));
}

}
