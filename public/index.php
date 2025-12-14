<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../database.php';

use App\MainPage\MainPageController;
use App\News\NewsController;

session_start();

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

// / → главная
if ($uri === '') {
    (new MainPageController($db))->index();
    exit;
}

switch ($parts[0]) {

    // ====== НОВОСТИ ========
    case 'newslist':
        $controller = new NewsController($db);

        // /newslist
        if (!isset($parts[1])) {
            $_GET['page'] = 1;
            $controller->list('news');
            break;
        }

        // /newslist/page/2
        if ($parts[1] === 'page' && isset($parts[2])) {
            $_GET['page'] = (int)$parts[2];
            $controller->list('news');
            break;
        }

        http_response_code(404);
        echo 'Страница новостей не найдена';
        break;

    case 'news':
        $controller = new NewsController($db);

        // /news/5
        if (isset($parts[1]) && is_numeric($parts[1])) {
            $_GET['id'] = (int)$parts[1];
            $controller->view('newslist');
            break;
        }

        http_response_code(404);
        echo 'Новость не найдена';
        break;

    // ====== ИНТЕРВЬЮ ========
    case 'interviewlist':
        $controller = new NewsController($db);

        // /interviewlist
        if (!isset($parts[1])) {
            $_GET['page'] = 1;
            $controller->list('interview');
            break;
        }

        // /interviewlist/page/2
        if ($parts[1] === 'page' && isset($parts[2])) {
            $_GET['page'] = (int)$parts[2];
            $controller->list('interview');
            break;
        }

        http_response_code(404);
        echo 'Страница интервью не найдена';
        break;
    
    default:
        http_response_code(404);
        echo 'Страница не найдена';
}
