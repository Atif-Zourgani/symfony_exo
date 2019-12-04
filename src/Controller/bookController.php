<?php


namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @return Response
     */
    public function getBooksByGenre(BookRepository $bookRepository, Request $request)
    {
        $style = $request->query->get('style');

        $books = $bookRepository->getByGenre($style);

        return $this->render('books.html.twig', ['books' => $books]);

    }

    /**
     * @Route("/books_get_by", name="get_book_by_style_or_by_title")
     * @param BookRepository $bookRepository
     * @param Request $request
     * @return Response
     */
    public function getBookByStyleOrByTitle(BookRepository $bookRepository, Request $request)
    {
        $title = $request->query->get('title');
        $style = $request->query->get('style');


        $books = $bookRepository->getBookByStyleOrByTitle($style, $title);

        return $this->render('books.html.twig', ['books' => $books]);
    }

    /**
     * @Route("/admin/books/insert", name="admin_books_insert")
     */
    public function insertBook()
    {
        return $this->render('admin_books_insert.html.twig');
    }

    /**
     * @Route("/admin/books/insert_ok", name="admin_books_insert_ok")
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

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('admin_books_insert_ok.html.twig');
    }

    /**
     * @Route("/admin/books/delete/{id}", name="admin_books_delete_id")
     */
    public function deleteBook(BookRepository $bookRepository, EntityManagerInterface $entityManager, $id)
    {//but supprimer un livre dans SQL

        $book = $bookRepository->find($id);

        // remove = efface
        $entityManager->remove($book);

        $entityManager->flush();

        //redirectToRoute= redirige vers la page de pages pour que l'on vois directemeent la suppression et qu'on puissent continuer a bosser
        return $this->redirectToRoute('books');
    }

    /**
     * @Route("/admin/books/Update/{id}", name="admin_books_update_id")
     */
    public function updateBook(bookRepository $bookRepository, EntityManagerInterface $entityManager, $id)
    {// but = recuperer book / modifier book / savegarder book.

        // J'utilise le Repository de book pour recuperer un livre en fonction de son id
        $book = $bookRepository->find($id);

        // modifie le titre du livre
        $book->setTitle('test réussis');

        // persist = Zone de stockage temporaire (unité de travail)
        $entityManager->persist($book);
        //flush -> Enregistre dans la base de données les modif
        $entityManager->flush();

        return $this->redirectToRoute('books');
    }

    /**
     * @Route("/admin/books/insert_form", name="admin_books_insert_form")
     */
    public function insertBookForm(Request $request, EntityManagerInterface $entityManager)
    {
        //Je crée un nouveaubook
        //J'utilise la gabarit de formulaire pour créer mon formulaire
        //J'envoie mon formulaire a un fichier twig
        //et je l'affiche

        //je crée un nouveau book/ en creant une nouvelle instance de l'entité book
        $book = new book();

        //J'utilise la methode createform pour créer le gabarit de formulaire pour le book: Booktype ( que j'ai generer ne ligne de commande
        //) et je lui associe mon entité book vide.
        $bookForm = $this->createForm(BookType::class, $book);

        //si je suis sur une methode post donc qu'un formulaire a été envoyé
        if ($request->isMethod('post')) {

            //je récupere les données de la method (post) et je les associes a mon formulaire
            $bookForm->handleRequest($request);

            //Si les données de mon formulaires sont valide ( que les types dans les input sont bon, que tout les champs obligatoire sont remplis etc)
            if ($bookForm->isValid()) {

                //j'enregistre en BDD ma variable $book qui n'est plus vide car elle as été remplie avec les données du formulaire
                $entityManager->persist($book);
                $entityManager->flush();
                return $this->redirectToRoute('books');
            }
        }

        $bookformView = $bookForm->createView();

        return $this->render('admin_book_insert_form.html.twig', [
            'bookFormView' => $bookformView]);
    }


    /**
     * @Route("/admin/books/update_form/{id}", name="admin_books_update_form_id")
     *///----------MODIFIER DANS LA BASE DE DONNEE
    public function updateBookForm(BookRepository $bookRepository, Request $request, EntityManagerInterface $entityManager, $id)
    {
        //recuperer l'enregistrement / l'entité en BDD
        //créer le gabarit formulaire
        //on recupere les données envoyés par le formulaire
        //On re-enregistre l'entité dans la bdd

        //recupere les données
        $book = $bookRepository->find($id);

        $bookForm = $this->createForm(BookType::class, $book);

        //= Si une methode post est passé
        if ($request->isMethod('post')) {
            //handlerequest = traite la requete
            $bookForm->handleRequest($request);

            //isSubmitted = si un form est envoyé / isValid = si il est valide
            if ($bookForm->isSubmitted() && $bookForm->isValid()) {
                //persist=stocké
                $entityManager->persist($book);
                //flush=envoyé en BDD
                $entityManager->flush();
                return $this->redirectToRoute('books');
            }
        }


        // à partir de mon gabarit, je crée la vue de mon formulaire
        $bookFormView = $bookForm->createView();

        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('admin_book_insert_form.html.twig', [
            'bookFormView' => $bookFormView
        ]);
    }

}