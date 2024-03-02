<?php
include("app/Controllers/View.php");
$view = new View;
$request = isset($_GET['request']) ? $_GET['request'] : '';

$request = trim($request, '/');
$segments = explode('/', $request);

switch ($segments[0]) {
    case '':
    case 'index':
    case 'home':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("content", "home");
        $view->loadContent("include", "tail");
        break;

    case 'sub-catagory':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("sub-catagory", "sub-catagory");
        $view->loadContent("include", "tail");
        break;

    case 'category':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("catagory", "category");
        $view->loadContent("include", "tail");
        break;

    case 'product':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("product", "product");
        $view->loadContent("include", "tail");
        break;
    case 'login':
        $view->loadContent("include", "top");
        $view->loadContent("auth", "login");
        $view->loadContent("include", "tail");
        break;
    case 'register-account':
        $view->loadContent("include", "top");
        $view->loadContent("auth", "register-account");
        $view->loadContent("include", "tail");
        break;


    case 'user-password':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("auth", "user-password");
        $view->loadContent("include", "tail");

        break;
    case 'contact':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("contact", "contact");
        $view->loadContent("include", "tail");
        break;

    case 'search':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("content", "search");
        $view->loadContent("include", "tail");
        break;
    case 'cart':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("cart", "cart");
        $view->loadContent("include", "tail");
        break;


    case 'order':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("order", "order");
        $view->loadContent("include", "tail");
        break;


    case 'payments':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("payments", "payments");
        $view->loadContent("include", "tail");
        break;

    case 'dashboard':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("account", "dashboard");
        $view->loadContent("include", "tail");
        break;

    case 'edit-account':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("account", "edit-account");
        $view->loadContent("include", "tail");
        break;

    case 'cart':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("cart", "cart");
        $view->loadContent("include", "tail");
        break;

    default:
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("content", "page404");
        $view->loadContent("include", "tail");
        break;
}
