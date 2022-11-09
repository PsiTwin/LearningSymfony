<?php

namespace App\Controller;

use App\DTO\Credentials\CredentialsRequest;
use App\Entity\Credentials;
use App\Entity\Identity;
use App\Service\Identity\GetIdentity;
use Doctrine\Persistence\ManagerRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AuthController extends ApiController
{
    private AuthenticationSuccessHandler $authenticationSuccessHandler;

    public function __construct(
        SerializerInterface          $serializer,
        AuthenticationSuccessHandler $authenticationSuccessHandler)
    {
        parent::__construct($serializer);
        $this->authenticationSuccessHandler = $authenticationSuccessHandler;
    }

    /**
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function register(
        Request                     $request,
        UserPasswordHasherInterface $passwordHasher,
        ManagerRegistry             $doctrine,
    ): JsonResponse
    {
        $em = $doctrine->getManager();
        $request = $this->transformJsonBody($request);
        $username = $request->get('username');
        $password = $request->get('password');

        if (empty($username) || empty($password)) {
            return $this->respondValidationError("Invalid Username or Password");
        }


        $user = new Credentials();
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $password
        );
        $identity = new Identity();
        $user->setPassword($hashedPassword);
        $identity->setUsername($username);
        $user->setUsername($username);
        $user->setIdentity($identity);
        $identity->setRoles(['ROLE_USER']);
        $em->persist($user);
        $em->flush();
        return $this->response(sprintf('User %s successfully created', $user->getUsername()));
    }

    /**
     * @param UserInterface $user
     * @param JWTTokenManagerInterface $JWTManager
     * @return JsonResponse
     */

    /**
     * @ParamConverter(name="credentialsRequest", converter="json_converter")
     */
    public function getToken(CredentialsRequest $credentialsRequest, GetIdentity $getIdentity): Response
    {
        $identity = $getIdentity->getIdentity($credentialsRequest);
//        dd($this->authenticationSuccessHandler->handleAuthenticationSuccess($identity));

        return $this->authenticationSuccessHandler->handleAuthenticationSuccess($identity);
    }

}