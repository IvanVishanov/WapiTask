<?php

namespace WapiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WapiBundle\Entity\Book;
use WapiBundle\Entity\Format;
use WapiBundle\Form\BookType;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $book = new Book();
        $form = $this->createForm(BookType::class,$book);
        $formats = $this->getDoctrine()->getRepository(Format::class)->findAll();

        return $this->render('default/index.html.twig', ['form' => $form->createView(), 'formats' => $formats]);
    }
}
