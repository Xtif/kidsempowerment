<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Member;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class MemberController extends Controller
{

  private $memberService;

  public function __construct($memberService) {
    $this->memberService = $memberService;
  }


    /**
     * @Route("/member/{id}", name="member")
     */
    public function showAction($id) {
      $member = $this->memberService->findById($id);
      return $this->render('default/member.html.twig', array('member' => $member)); 
    } //End showAction()

    /**
     * @Route("/member/add", name="add_member")
     */
    public function addAction(Request $request) {

      $member = new Member();

      $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $member);

      $formBuilder
        ->add('firstname', TextType::class,
          array(
            'label' => 'Firstname (required)',
            'attr' => array(
              'class' => 'form-control col-lg-10 m-auto',
              'placeholder' => 'Firstname of the new team member'
            )
          )
        )
        ->add('lastname', TextType::class,
          array(
            'label' => 'Lastname (required)',
            'attr' => array(
              'class' => 'form-control col-lg-10 m-auto',
              'placeholder' => 'Lastname of the new team member'
            )
          )
        )
        ->add('position', TextType::class,
          array(
            'label' => 'Position (not required)',
            'attr' => array(
              'class' => 'form-control col-lg-10 m-auto',
              'placeholder' => 'Position of the new team member (ex: Project Management)'
            )
          )
        )
        ->add('email', TextType::class,
          array(
            'label' => 'Email (not required)',
            'attr' => array(
              'class' => 'form-control col-lg-10 m-auto',
              'placeholder' => 'Email of the new team member'
            )
          )
        )
        ->add('team', ChoiceType::class,
          array(
            'choices'  => array(
              'Operational team' => 'Operational team',
              'Legal expert' => 'Legal expert',
              'Board member' => 'Board member'
            ),
            'expanded' => true,
            'multiple' => true,
            'label' => 'Team(s) associated (required)',
            'attr' => array(
              'class' => 'form-control col-lg-10 m-auto'
            )
          )
        )
        ->add('biography', TextAreaType::class,
          array(
            'label' => 'Biography (not required)',
            'attr' => array(
              'class' => 'form-control col-lg-10 m-auto',
              'placeholder' => 'Biography of the new team member'
            )
          )
        )
        ->add('submit', 
          SubmitType::class,
            array(
              'label' => 'Add new member',
              'attr' => array(
                'class' => 'btn btn-info'
              )
            )
        );

        $form = $formBuilder->getForm();

        if ($request->isMethod('POST')) {

          $form->handleRequest($request);

          if ($form->isValid()) { 

            $em = $this->getDoctrine()->getManager();

            $em->persist($member);
            $em->flush();
            
            return $this->redirectToRoute('member', array('id' => $member->getId()));
          } else { // Si les données ne sont pas valides
            return $this->render('default/add_member.html.twig', array('form' => $form->createView()));
          }

        } else { // Si on arrive sur la page pour la première fois
          return $this->render('default/add_member.html.twig', array('form' => $form->createView()));
        }
    } //End function add_member

    public function legalNoticeAction(Request $request) {
        return $this->render('default/legal_notice.html.twig');
    }

    public function tosAction(Request $request) {
        return $this->render('default/tos.html.twig');
    }

}
