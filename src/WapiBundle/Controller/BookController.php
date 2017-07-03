<?php

namespace WapiBundle\Controller;

use DateTimeZone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use WapiBundle\Entity\Book;
use WapiBundle\Entity\Format;
use WapiBundle\Form\BookType;

class BookController extends Controller
{
    /**
     * @Route("/",name ="upload_book")
     * @Method({"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $formats = $this->getDoctrine()->getRepository(Format::class)->findAll();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $book->setDateAdded(new \DateTime());
                /**
                 * @var \Symfony\Component\HttpFoundation\File\UploadedFile $file
                 */
                $file = $book->getCover();
                // Generate a unique name for the file before saving it
                $coverName = md5(uniqid()) . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('covers_directory'),
                    $coverName
                );

                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $book->setCover($coverName);
                // ... persist the $product variable or any other work

                $em = $this->getDoctrine()->getManager();
                $em->persist($book);
                $em->flush();
                return $this->redirectToRoute("homepage");
            }

            return $this->render("default/index.html.twig", ['form' => $form->createView(), 'formats' => $formats]);
        }

        return $this->render('default/index.html.twig', ['form' => $form->createView(), 'formats' => $formats]);
    }

    /**
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/books",name ="books")
     */
    public function viewAction(Request $request)
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findBy([], ['dateAdded' => 'DESC']);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $books,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('book/allBooks.html.twig',['pagination'=>$pagination]);
    }
}
