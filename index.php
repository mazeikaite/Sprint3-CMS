<?php
require_once 'bootstrap.php';
$request = $_SERVER['REQUEST_URI'];


$rout_prefix = '/cms';

switch ($request) {
    case $rout_prefix . '/':
        require __DIR__ . '/src/views/page.php';
        break;
    case $rout_prefix . '':
        require __DIR__ . '/src/views/page.php';
        break;
    case $rout_prefix . '/page':
        require __DIR__ . '/src/views/page.php';
        break;
    case isset($_GET['delete']):
        require __DIR__ . '/src/views/page.php';
        break;
    case isset($_GET['updatable']):
        require __DIR__ . '/src/views/page.php';
        break;
    case isset($_GET['name']):
        require __DIR__ . '/src/views/page.php';
        break;
    case $rout_prefix . '/projectsPage':
        require __DIR__ . '/src/views/projectsPage.php';
        break;
    case isset($_GET['deleteProj']):
        require __DIR__ . '/src/views/projectsPage.php';
        break;
    case isset($_GET['updatableProj']):
        require __DIR__ . '/src/views/projectsPage.php';
        break;
    case isset($_GET['nameProj']):
        require __DIR__ . '/src/views/projectsPage.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/src/views/404.php';
        break;
}
