<?php
/** @var \Interop\Container\ContainerInterface $container */
$container = $app->getContainer();

$container['ShopController'] = function($container) {
    return new \App\Controller\ShopController(
        $container->get('logger'), 
        $container->get('view'), 
        $container->get('itemRepository')
    );
};
