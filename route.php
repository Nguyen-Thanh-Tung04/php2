<?php

use App\Controllers\Admin\AccountController;
use App\Controllers\Admin\CategoryController;
use Phroute\Phroute\RouteCollector;
use App\Controllers\Admin\ProductController;
use App\Controllers\User\HomeController;
use App\Controllers\User\LoginController;
use App\Controllers\User\ProductUserController;

$url = isset($_GET['url']) ? $_GET['url'] : '/';
$router = new RouteCollector();

$router->filter('auth', function () {
    if (!isset($_SESSION['user'])) {
        header('Location:'. route("login"));

        return false;
    }
});

$router->get('/', [HomeController::class, 'renderHome']);
$router->get('product/{id}', [ProductUserController::class, 'renderProductDetail']);



$router->get('login', [LoginController::class, 'rendeLogin']);
$router->get('logout', [LoginController::class, 'logout']);
$router->get('register', [LoginController::class, 'rendeRegister']);
$router->get('forgot-password', [LoginController::class, 'renderForgotPassword']);

$router->post('login', [LoginController::class, 'checkLogin']);
$router->post('register', [LoginController::class, 'registerUser']);


$router->group(['before' => 'auth'], function ($router) {

    $router->get('admin/product', [ProductController::class, 'renderListProduct']);
    $router->get('admin/product/add', [ProductController::class, 'renderAddProduct']);
    $router->get('admin/product/delete/{id}', [ProductController::class, 'deleteProduct']);
    $router->get('admin/product/edit/{id}', [ProductController::class, 'renderEditproduct']);

    $router->post('admin/product/add', [ProductController::class, 'insertProduct']);
    $router->post('admin/product/edit/{id}', [ProductController::class, 'updateProduct']);

    $router->get('admin/account', [AccountController::class, 'getListAcounts']);

    $router->get('admin/category', [CategoryController::class, 'getListCategory']);
    $router->get('admin/category/add', [CategoryController::class, 'renderAddCategory']);
    $router->get('admin/category/delete/{id}', [CategoryController::class, 'deleteCategory']);
    $router->get('admin/category/edit/{id}', [CategoryController::class, 'renderEditCategory']);

    $router->post('admin/category/add', [CategoryController::class, 'insertCategory']);
    $router->post('admin/category/edit/{id}', [CategoryController::class, 'updateCategory']);
});




$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);