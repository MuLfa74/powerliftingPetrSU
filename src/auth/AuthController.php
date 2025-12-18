<?php
namespace App\Auth;

class AuthController
{
    private AuthRepository $repo;

    /**
     * Конструктор контроллера аутентификации.
     *
     * @param mixed $db Экземпляр подключения к БД (PDO).
     */
    public function __construct($db)
    {
        $this->repo = new AuthRepository($db);
    }

    /**
     * Обрабатывает вход пользователя.
     *
     * При POST — проверяет email и пароль, устанавливает сессию и
     * перенаправляет на главную страницу. При GET — отображает форму входа.
     *
     * @return void
     */
    public function login(): void
    {   
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->repo->findByEmail($email);

            if (!$user || !password_verify($password, $user['password_hash'])) {
                $error = 'Неверный логин или пароль';
                require __DIR__ . '/views/login.php';
                return;
            }

            // УСПЕШНАЯ АВТОРИЗАЦИЯ
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];

            header('Location: /');
            exit;
        }

        require __DIR__ . '/views/login.php';
    }

    /**
     * Разлогинивает пользователя.
     *
     * Очищает сессию и перенаправляет на главную страницу.
     *
     * @return void
     */
    public function logout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /');
        exit;
    }

    /**
     * Отображает профиль пользователя.
     *
     * @param int $userId Идентификатор пользователя.
     * @return void
     */
    public function profile(int $userId): void
    {   
        $profile = $this->repo->getProfileByUserId($userId);

        if (!$profile) {
            http_response_code(404);
            echo 'Пользователь не найден';
            return;
        }

        require __DIR__ . '/views/profile.php';
    }
}
