<?php


namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class authorController extends AbstractController
{
    /**
     * @Route("/authors", name="authors")
     */
    public function allAuthors(AuthorRepository $authorRepository)
    {
        $author = $authorRepository->findAll();

        return $this->render('author.html.twig', ['authors' => $author]);

    }

    /**
     * @Route("/author/{id}", name="")
     */
    public function getAuthor(AuthorRepository $authorRepository, $id)
    {

        $author = $authorRepository->find($id);

        return $this->render('author.html.twig', ['author' => $author]);
    }
}