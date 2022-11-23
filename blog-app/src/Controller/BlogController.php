<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function blog(): Response
    {
        return $this->render('blog/blog.html.twig', []);
    }

    #[Route('/single', name: 'single')]
    public function single(): Response
    {
        return $this->render('blog/single.html.twig', []);
    }
}
