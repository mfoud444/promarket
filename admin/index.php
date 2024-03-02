<?php
include("app/Controllers/View.php");
$view = new View;
$request = isset($_GET['request']) ? $_GET['request'] : '';
$request = trim($request, '/');
$segments = explode('/', $request);
switch ($segments[0]) {
    case '':
    case 'login':
        $view->loadContent("content", "login");
        break;

    case 'dashboard':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("content", "dashboard");
        $view->loadContent("include", "tail");
        break;

    case 'create-admin':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("admin", "create-admin");
        $view->loadContent("include", "tail");
        break;
    case 'create-category':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("category", "create-category");
        $view->loadContent("include", "tail");
        break;
    case 'create-product':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("product", "create-product");
        $view->loadContent("include", "tail");
        break;
    case 'create-subcategory':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("subcategory", "create-subcategory");
        $view->loadContent("include", "tail");
        break;


    case 'edit-admin':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("admin", "edit-admin");
        $view->loadContent("include", "tail");
        break;
    case 'edit-category':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("category", "edit-category");
        $view->loadContent("include", "tail");
        break;
    case 'edit-product':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("product", "edit-product");
        $view->loadContent("include", "tail");
        break;
    case 'edit-subcategory':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("subcategory", "edit-subcategory");
        $view->loadContent("include", "tail");
        break;



    case 'list-admin':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("admin", "list-admin");
        $view->loadContent("include", "tail");
        break;
    case 'list-category':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("category", "list-category");
        $view->loadContent("include", "tail");
        break;
    case 'list-product':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("product", "list-product");
        $view->loadContent("include", "tail");
        break;
    case 'list-subcategory':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("subcategory", "list-subcategory");
        $view->loadContent("include", "tail");
        break;
    case 'list-customer':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("customer", "list-customer");
        $view->loadContent("include", "tail");
        break;
    case 'list-order':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("order", "list-order");
        $view->loadContent("include", "tail");
        break;

    case 'detail-order':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("order", "detail-order");
        $view->loadContent("include", "tail");
        break;

    case 'review':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("customer", "review");
        $view->loadContent("include", "tail");
        break;



    case 'invoice-list':
        $view->loadContent("include", "session");
        $view->loadContent("include", "top");
        $view->loadContent("invoice", "invoice-list");
        $view->loadContent("include", "tail");
        break;
        
    case 'ajax':
        $view->loadContent("content", "ajax");
        break;


    default:
        http_response_code(404);
        break;
}
