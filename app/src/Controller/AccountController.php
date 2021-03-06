<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $userRepository;

    /**
     * AccountController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository('App:User');
    }

    /**
     * @Route("/update/profile", name="app_profile_update")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAccount(Request $request)
    {
        $user = $this->userRepository->find($this->getUser()->getId());

        $this->updateUser($request, $user);

        $this->addFlash('notice', 'Your account has been updated successfully');
        return $this->redirectToRoute('account');
    }

    /**
     * @Route("/account/password", name="app_change_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->userRepository->find($this->getUser()->getId());
        $encoded = $encoder->encodePassword($user, $request->get('password'));

        $user->setPassword($encoded);
        $this->persistObject($user);

        $this->addFlash('password', 'Your password has been changed successfully');
        return $this->redirectToRoute('account');
    }

    /**
     * @Route("/account/delete", name="app_delete_account")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAccount(Request $request)
    {
        $session = new Session();
        $session->invalidate();

        $user = $this->userRepository->find($this->getUser()->getId());
        $this->removeObject($user);

        return $this->redirect('/');
    }

    /**
     * Update users' profile
     * @param Request $request
     * @param User $user
     */
    public function updateUser(Request $request, User $user)
    {

        $user->setEmail($request->get('email'));
        $user->setFirstName($request->get('first_name'));
        $user->setLastName($request->get('last_name'));
        $user->setLocation($request->get('location'));
        $user->setWebsite($request->get('website'));
        $this->persistObject($user);
    }

    /**
     * Update the database
     * @param $object
     */
    public function persistObject($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    /**
     * Delete object from the database
     * @param $object
     */
    public function removeObject($object)
    {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
    }
}