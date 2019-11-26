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
        dump($books);


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

    /**
     * @Route("/books_by_genre", name="books_by_genre")
     */
    public function getBooksByGenre(BookRepository $bookRepository)
    {
        //commencer par appeler le bookrepository (en le passent dans les parenthese en parametre de la methode)
        $books = $bookRepository->getByGenre();
        dump($books);

        return $this->render('books.html.twig', ['books' => $books]);
        //ensuite on appelle la methode qu'on as créée dans le bookrepository ( "getbygenre()")
        //cette methode est sencé nous retourner tous les livres en fonction d'un genre
        // elle va donc executer une requete SELECT en base de données
    }

}