<?php

namespace App\Controller;

use App\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubjectController extends AbstractController
{

    private const POSTS = [
        [
            'id' => 1,
            'slug' => 'english',
            'name' => 'English'
        ],
        [
            'id' => 2,
            'slug' => 'french',
            'name' => 'French'
        ],
        [
            'id' => 3,
            'slug' => 'social',
            'name' => 'Social'
        ],
    ];
    /**
     * @Route("/subject/", name="subject_list", requirements={"page" = "\d+"}, defaults={"page": 5}, methods={"GET"})
     */
    public function list($page = 1, Request $request): Response
    {
        $limit = $request->get('limit', 10);
        $repository = $this->getDoctrine()->getRepository(Subject::class);
        $items = $repository->findAll();

        return $this->json($items);
        return $this->json(
            [
                'page' => $page,
                'limit' => $limit,
                'data' => array_map(function (Subject $item) {
                    return $this->generateUrl('subject_by_slug', ['slug' => $item->slug]);
                }, $items)
            ]
        );
    }


    /**
     * @Route("subject/{id}", name="subject_by_id", methods={"GET"}, requirements={"id" = "\d+"})
     */
    public function subject(Subject $subject): Response
    {
        return $this->json(
            $this->getDoctrine()->getRepository(Subject::class)->find($id)
        );
    }

    /**
     * @Route("subject/{slug}", name="subject_by_slug", methods={"GET"})
     */
    public function subjectBySlug($slug): Response
    {

        return $this->json(
            $this->getDoctrine()->getRepository(Subject::class)->findBy(['slug' => $slug])
        );
    }

    /**
     * @Route("subject/add", name="subject_post", methods={"POST"})
     */
    public function add(Request $request)
    {

        $serializer = $this->get('serializer');
        $subjectPost = $serializer->deserialize($request->getContent(), Subject::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($subjectPost);
        $em->flush();

        return $this->json($subjectPost);
    }
}
