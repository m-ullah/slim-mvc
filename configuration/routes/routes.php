<?php
// Routes

$app->get('/', 'ShopController:index');
$app->get('/basket', 'ShopController:basket');
$app->get('/basket/add/{item_id}', 'ShopController:addBasket');
$app->get('/basket/remove/{item_id}', 'ShopController:removeBasket');