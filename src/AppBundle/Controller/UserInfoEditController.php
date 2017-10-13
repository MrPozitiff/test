<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 013 13.10.17
 * Time: 3:16
 */

namespace AppBundle\Controller;


use AppBundle\Form\EditUserProfileForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class UserInfoEditController
 * @package AppBundle\Controller
 *
 */
class UserInfoEditController extends Controller
{

    /**
     * @Route("/edit/{id}", name="edit_profile")
     * @var Request $request
     * @var integer $id
     */

    public function editAction(Request $request, $id){
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            $this->addFlash('error', 'Доступ запрещен, пожалуйста, авторизируйтесь!');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($id != $user->getId()){

            $this->addFlash('error', 'Ая-яй, читер! Вы пытаетесь отредактировать чужой профиль!');
            return $this->redirectToRoute('homepage');
        }
        $form = $this->createForm(EditUserProfileForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            dump($user);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Cпасибо, данные сохранены, вы можете их отредактировать или просмотреть список абитуриентов');

            return $this->redirectToRoute('homepage');
        }

        return $this->render(':default:edit_profile.html.twig',[
           'userForm' => $form->createView()
        ]);
    }
}