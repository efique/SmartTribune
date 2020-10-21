<?php

namespace App\Controller;

use App\Entity\QuestionAnswer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QAController extends AbstractController
{
    /**
     * @Route("/qa", name="create_qa")
     */
    public function createQA(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $qa = new QuestionAnswer();
        $qa->setTitle();
        $qa->setPromoted();
        $qa->setStatus();
        $qa->setAnswers();
        $qa->setCreatedAt();

        $entityManager->persist($qa);

        $entityManager->flush();

        return new Response('Saved new question answer with id '.$qa->getId());
    }
}
