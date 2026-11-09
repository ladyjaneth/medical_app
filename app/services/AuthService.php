<?php

require_once __DIR__ .
    '/../repositories/UserRepository.php';

class AuthService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(
        string $email,
        string $password
    ) {
        $user =
            $this->userRepository
            ->findByEmail($email);

        if (!$user) {

            return false;
        }

        $passwordValid =
            password_verify(
                $password,
                $user['password_hash']
            );

        if (!$passwordValid) {

            return false;
        }

        return $user;
    }
}
