<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Vote;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * @Route("/", name="post_index")
     */
    public function index()
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * Create new post
     *
     * @Route("/create", name="post_create")
     * @Security("has_role('ROLE_USER')")
     */
    public function create(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            $post->setUser($user);

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('index_index');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Vote up for post
     *
     * @Route("/{post}/vote-up", name="post_vote_up")
     * @Security("has_role('ROLE_USER')")
     */
    public function voteUp(Request $request, Post $post)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $vote = new Vote();
        $vote->setUser($user);
        $vote->setPost($post);
        $vote->setValue(1);

        $em->persist($vote);
        $em->flush();

        return $this->redirectToRoute('index_index');
    }

    /**
     * Vote down for post
     *
     * @Route("/{post}/vote-down", name="post_vote_down")
     * @Security("has_role('ROLE_USER')")
     */
    public function voteDown(Request $request, Post $post)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $vote = new Vote();
        $vote->setUser($user);
        $vote->setPost($post);
        $vote->setValue(-1);

        $em->persist($vote);
        $em->flush();

        return $this->redirectToRoute('index_index');
    }
}
