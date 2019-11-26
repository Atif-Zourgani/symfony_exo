<?php


namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
//use phpDocumentor\Reflection\DocBlock\Tags\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class authorController extends AbstractController
{
    /**
     * //annotation qui donne la route de ma fonction a mon twig ( crée une page web )
     * @Route("/authors", name="authors")
     */
    public function allAuthors(AuthorRepository $authorRepository)
    {
        $author = $authorRepository->findAll();

        return $this->render('authors.html.twig', ['authors' => $author]);

    }

    /**
     * @Route("/author/{id}", name="author_id")
     */
    public function getAuthor(AuthorRepository $authorRepository, $id)
    {

        $author = $authorRepository->find($id);

        return $this->render('author.html.twig', ['author' => $author]);
    }

    /**
     * //
     * @Route("/biography/{word}", name="biography")
     */
    public function  getAuthorsByBiography (AuthorRepository $authorRepository, $word)
    {

        $biography = $authorRepository->getByBiography($word);

        return $this->render('author.html.twig', ['biography' => $biography]);
    }

    /**
     * @Route("/authors/insert", name="authors_insert")
     */
    public function insertAuthors ()
    {
        return $this->render('authors_insert.html.twig');
    }

    /**
     * @Route("/authors/insert_ok", name="authors_insert_ok")
     */
    public function insertAuthorsOk (EntityManagerInterface $entityManager, Request $request)
    {
        $name = $request->query->get('name');
        $firstname = $request->query->get('firstname');
        $birhtDate = $request->query->get('birhtDate');
        $DeathDate = $request->query->get('DeathDate');
        $biography = $request->query->get('biography');

        // inserer dans la table book un nouveau bouquin
        $author = new Author();

        $author->setName($name);
        $author->setFirstname($firstname);
        $author->setBirhtDate( new \DateTime($birhtDate));
        $author->setDeathDate( new \DateTime($DeathDate));
        $author->setBiography($biography);

        $entityManager->persist ($author);
        $entityManager->flush();

        return $this->render('authors_insert_ok.html.twig');

        /** ( new \DateTime('NOW')) **/
    }

    /**
     * @Route("/authors/delete/{id}", name="authors_delete_id")
     */
    public function deleteAuthors (authorRepository $authorRepository, EntityManagerInterface $entityManager, $id)
    {
        $author = $authorRepository->find($id);

        //remove sert a effacer
        $entityManager->remove($author);

        $entityManager->flush();

        return $this->redirectToRoute('authors');
    }


}