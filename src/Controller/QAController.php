<?php

namespace App\Controller;

use App\Entity\QuestionAnswer;
use App\Entity\QuestionHistoric;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        
        $qa = new QuestionAnswer();
        $qa->setTitle(json_decode($request->getContent(),true)['title']);
        $qa->setPromoted(json_decode($request->getContent(),true)['promoted']);
        $qa->setStatus(json_decode($request->getContent(),true)['status']);
        if (!in_array($channel, array(self::STATUS_FAQ, self::STATUS_BOT))) {
            throw new \InvalidArgumentException("Invalid status");
        }else{
            $qa->setAnswers(json_decode($request->getContent(),true)['answers']);
        }
        $qa->setCreatedAt($date);

        $entityManager->persist($qa);

        $entityManager->flush();

        return new Response('Saved new question answer with id '.$qa->getId());
    }

    /**
     * @Route("/qa/{id}", name="update_qa")
     */
    public function updateQA($id, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $qa = $entityManager->getRepository(QuestionAnswer::class)->find($id);

        $date = new \DateTime('now');
    
        if (!$qa) {
            throw $this->createNotFoundException(
                'No Question&Answer found for id '.$id
            );
        }
    
        $qa->setTitle(json_decode($request->getContent(),true)['title']);
        $qa->setStatus(json_decode($request->getContent(),true)['status']);
        $qa->setUpdatedAt($date);

        $qh = new QuestionHistoric();
        $qh->setTitle(json_decode($request->getContent(),true)['title']);
        $qh->setStatus(json_decode($request->getContent(),true)['status']);
        $qh->setUpdatedAt($date);
        $qh->setQAId($id);

        $entityManager->persist($qh);

        $entityManager->flush();
    
        return new Response('Updated Question&Answer with id '.$qa->getId());
    }

    /**
     * @Route("/csv", name="csv")
     */
    public function exportCSV()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $qh = $entityManager->getConnection()->executeQuery(
            "SELECT * FROM public.question_historic"
        )->fetchAll();

        $fileName = "export_historic" . date("d_m_Y") . ".csv";
        $response = new StreamedResponse();

        $response->setCallback(function() use ($qh){
            $handle = fopen('php://output', 'w+');
 
            fputcsv($handle, array('title',
                'status',
                'updatedAt',
                'QuestionAnswerId'
            ), ';');
 
            foreach ($qh as $i => $qhi)
            {
                fputcsv($handle,array(
                    $qhi['title'],
                    $qhi['status'],
                    $qhi['updated_at'],
                    $qhi['qa_id'],
                ),';');
            }
            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8', 'application/force-download');
        $response->headers->set('Content-Disposition','attachment; filename='.$fileName);
 
        return $response;
    }
}
