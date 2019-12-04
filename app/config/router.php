<?php

$router = $di->getRouter();

// Default route
$router->add('/', ['controller' => 'index', 'action' => 'index']);

// Define your routes here
$router->add('/user/login', ['controller' => 'user', 'action' => 'login']);
$router->add('/user/login/submit', ['controller' => 'user', 'action' => 'loginSubmit']);
$router->add('/user/register', ['controller' => 'user', 'action' => 'register']);
$router->add('/user/register/submit', ['controller' => 'user', 'action' => 'registerSubmit']);
$router->add('/user/profile', ['controller' => 'user', 'action' => 'profile']);
$router->add('/user/logout', ['controller' => 'user', 'action' => 'logout']);

// Article Routes
$router->add('/article/create', ['controller' => 'article', 'action' => 'create']);
$router->add('/article/create/submit', ['controller' => 'article', 'action' => 'createSubmit']);
$router->add('/article/manage', ['controller' => 'article', 'action' => 'manage']);
$router->add('/article/edit', ['controller' => 'article', 'action' => 'edit']);
$router->add('/article/edit/submit', ['controller' => 'article', 'action' => 'editSubmit']);
$router->add('/article/delete', ['controller' => 'article', 'action' => 'delete']);

// Tower Routes
$router->add('/tower/create', ['controller' => 'tower', 'action' => 'create']);
$router->add('/tower/create/submit', ['controller' => 'tower', 'action' => 'createSubmit']);
$router->add('/tower/manage', ['controller' => 'tower', 'action' => 'manage']);
$router->add('/tower/edit', ['controller' => 'tower', 'action' => 'edit']);
$router->add('/tower/edit/submit', ['controller' => 'tower', 'action' => 'editSubmit']);
$router->add('/tower/delete', ['controller' => 'tower', 'action' => 'delete']);

// Project Routes
$router->add('/project/create', ['controller' => 'project', 'action' => 'create']);
$router->add('/project/create/submit', ['controller' => 'project', 'action' => 'createSubmit']);
$router->add('/project/manage', ['controller' => 'project', 'action' => 'manage']);
$router->add('/project/edit', ['controller' => 'project', 'action' => 'edit']);
$router->add('/project/edit/submit', ['controller' => 'project', 'action' => 'editSubmit']);
$router->add('/project/delete', ['controller' => 'project', 'action' => 'delete']);

// Space Routes
$router->add('/space/create', ['controller' => 'space', 'action' => 'create']);
$router->add('/space/create/submit', ['controller' => 'space', 'action' => 'createSubmit']);
$router->add('/space/manage', ['controller' => 'space', 'action' => 'manage']);
$router->add('/space/edit', ['controller' => 'space', 'action' => 'edit']);
$router->add('/space/edit/submit', ['controller' => 'space', 'action' => 'editSubmit']);
$router->add('/space/delete', ['controller' => 'space', 'action' => 'delete']);

$router->handle();
