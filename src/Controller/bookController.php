<?php


namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param BookRepository $bookRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getBooksByGenre(BookRepository $bookRepository, Request $request)
    {
        $style = $request->query->get('style');

        $books = $bookRepository->getByGenre($style);

        return $this->render('books.html.twig', ['books' => $books]);

    }

    /**
     * @Route("/books/insert", name="books_insert")
     */
    public function insertBook ()
    {
        return $this->render('books_insert.html.twig');
    }

    /**
     * @Route("/books/insert_ok", name="books_insert_ok")
     */
    public function insertBookOk(EntityManagerInterface $entityManager, Request $request)
    {
        $title = $request->query->get('title');
        $style = $request->query->get('style');
        $inStock = $request->query->get('InStock');
        $NBpages = $request->query->get('NBpages');

        // inserer dans la table book un nouveau bouquin
        $book = new Book();

        $book->setTitle($title);
        $book->setStyle($style);
        $book->setInstock($inStock);
        $book->setNBpages($NBpages);

        $entityManager->persist ($book);
        $entityManager->flush();

        return $this->render('books_insert_ok.html.twig');
    }

    /**
     * @Route("/books/delete/{id}", name="books_delete_id")
     */
    public function deleteBook (BookRepository $bookRepository, EntityManagerInterface $entityManager, $id)
    {
        $book = $bookRepository->find($id);

        //remove sert a effacer
        $entityManager->remove($book);

        $entityManager->flush();

        return $this->redirectToRoute('books');
    }


}