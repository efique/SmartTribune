<?php

namespace App\Controller;

use App\Entity\QuestionAnswer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class QAController extends AbstractController
{
    const STATUS_FAQ = 'faq';
    const STATUS_BOT = 'bot';

    /**
     * @Route("/qa", name="create_qa")
     */
    public function createQA(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $date = new \DateTime('now');
        settype($body, "string");
        settype($channel, "string");
        $body = "test";
        $channel = self::STATUS_FAQ;
        
        // echo $request->request->all();
        // echo $request->get("title");
        // echo $request->getContent();

        $qa = new QuestionAnswer();
        // $qa->setTitle($request->get("title"));
        // $qa->setPromoted($request->get('promoted'));
        // $qa->setStatus($request->get('status'));
        // if (!in_array($channel, array(self::STATUS_FAQ, self::STATUS_BOT))) {
        //     throw new \InvalidArgumentException("Invalid status");
        // }else{
        //     // $qa->setAnswers([$channel,$body]);
        //     $qa->setAnswers($request->get('answers'));
        // }
        // $qa->setCreatedAt($date);

        $qa->setTitle("test");
        $qa->setPromoted(false);
        $qa->setStatus("projet");
        if (!in_array($channel, array(self::STATUS_FAQ, self::STATUS_BOT))) {
            throw new \InvalidArgumentException("Invalid status");
        }else{
            $qa->setAnswers([$channel,$body]);
        }
        $qa->setCreatedAt($date);

        $entityManager->persist($qa);

        $entityManager->flush();

        return new Response('Saved new question answer with id '.$qa->getId());
    }
}
