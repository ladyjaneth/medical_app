
<?php

class RoleMiddleware
{
    public static function handle(
        array $roles
    ) {
        if (
            !isset($_SESSION['user'])
        ) {
            header('Location:/login');
            exit;
        }

        $userRole = $_SESSION['user']['role'];
        if (
            !in_array(
                $userRole,
                $roles
            )
        ) {
            http_response_code(403);
            echo '403 FORBIDDEN';
            exit;
        }
    }
}
