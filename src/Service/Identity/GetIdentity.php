<?php

namespace App\Service\Identity;

use App\DTO\Credentials\CredentialsRequest;
use App\Entity\Identity;
use App\Repository\CredentialsRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationFailureHandler;

class GetIdentity
{
    private CredentialsRepository $credentialsRepository;

    private AuthenticationFailureHandler $authenticationFailureHandler;

    public function __construct(
        CredentialsRepository        $credentialsRepository,
        AuthenticationFailureHandler $authenticationFailureHandler
    )
    {
        $this->credentialsRepository = $credentialsRepository;
        $this->authenticationFailureHandler = $authenticationFailureHandler;
    }

    public function getIdentity(CredentialsRequest $credentialsRequest): Identity|bool
    {
        $credentials = $this->credentialsRepository->findOneBy(['username' => $credentialsRequest->getUsername()]);

        if (!password_verify($credentialsRequest->getPassword(), $credentials->getPassword())) {
            //Подумай что возвращать
//            return $this->authenticationFailureHandler->onAuthenticationFailure();
            return false;
        }
        return $credentials->getIdentity();

    }
}