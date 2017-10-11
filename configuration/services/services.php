<?php
// DIC configuration

/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();

// view renderer

$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Graze\PhpLayoutRenderer('layout.phtml', $settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// ItemRepository
$container['itemRepository'] = function ($container) {
    return new Graze\ItemRepository($container['db']->table('products'));
};
