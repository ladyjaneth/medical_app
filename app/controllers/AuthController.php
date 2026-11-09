<?php

require_once __DIR__ .
    '/../services/AuthService.php';
require_once __DIR__ .
   '/BaseController.php';

class AuthController extends BaseController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function showLogin()
    {
        $this->render('login');
    }

    public function login()
    {
        $email = trim($_POST['email']);

        $password = trim($_POST['password']);

        $user = $this->authService
                ->login(
                    $email,
                    $password
                );

        if (!$user) {
            echo "Credenciales inválidas";
            return;
        }


         $_SESSION['user'] = [

            'id' => $user['user_id'],

            'username' => $user['username'],

            'role' => $user['role']
        ];

        header(
            'Location: /dashboard'
        );

        exit;
    }

    public function logout()
    {
        session_destroy();

        header(
            'Location: /login'
        );

        exit;
    }
}