<?php


namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class bookController extends AbstractController
{
    /**
     * @Route("/books", name="books")
     */
    public function allBook(BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();

        return $this->render('books.html.twig', ['books' => $books]);
    }

    /**
     * @Route("/book/{id}", name="book_id")
     */
    public function getBook(BookRepository $bookRepository, $id)
    {
        $book = $bookRepository->find($id);

        return $this->render('book.html.twig', ['book' => $book]);
    }

}