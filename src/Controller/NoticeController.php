<?php


namespace App\Controller;


use App\Entity\Notice;
use App\Form\NoticeType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Maker\MakeForm;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Routing\Annotation\Route;

class NoticeController extends AbstractController
{
    /**
     * @Route("/new", name="notice_new")
     */
    public function newNotice(Request $request) :Response
    {
        $notice = new Notice();
        $form = $this->createForm(NoticeType::class, $notice);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        $entityManager= $this->getDoctrine()->getManager();
        $entityManager->persist($notice);
        $entityManager->flush();
        }
        return $this->render('notice/new.html.twig',[
            'form'=>$form->createView(),
            'notice' => $notice,
        ]);
    }


    /**
     * @Route("/show/{id}", name="notice_show")
     */
    public function showNotice(Request $request, $id) :Response
    {
        $entityManager= $this->getDoctrine()->getRepository();
        return $this->render('notice/show.html.twig',[
            'notice' => $entityManager-> find($id),
        ]);

    }

}