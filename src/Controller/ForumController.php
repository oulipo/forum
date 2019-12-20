<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Entity\Message;
use App\Repository\ThreadRepository;
use App\Repository\MessageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ForumController extends AbstractController
{
    /**
     * @Route("/", name="liste-des-threads")
     */
    public function index(ThreadRepository $repo)
    {
        $threads = $repo->findAll();
        return $this->render('forum/index.html.twig', [
            'threads' => $threads
        ]);
    }

    /**
     * @Route("/messages/{id}", name="liste-des-messages")
     */
    public function messages(MessageRepository $repo, Thread $thread) {
        $messages = $repo->findBy([
            'thread' => $thread
        ]);
        return $this->render('forum/messages.html.twig', [
            'messages' => $messages,
            'thread' => $thread
        ]);
    }

    /**
     * @Route("/message/{id}", name="detail-message")
     */
    public function message(MessageRepository $repo, Message $message) {

        $message = $repo->find($message);
        return $this->render('forum/message.html.twig', [
            'message' => $message
        ]);
    }
}
