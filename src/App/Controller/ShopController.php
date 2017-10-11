<?php
namespace App\Controller;

use Graze\Basket;
use Graze\ItemRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use RKA\Session;

class ShopController
{

    private $logger;
    private $view;
    private $itemRepository;

    public function __construct(LoggerInterface $logger, $view, ItemRepository $ir)
    {
        $this->logger = $logger;
        $this->view = $view;
        $this->itemRepository = $ir;
    }

    /**
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param type $args
     * @return type
     */
    public function index(RequestInterface $request, ResponseInterface $response, $args)
    {
        $items = $this->itemRepository->getItems();

        // Sample log message
        //$this->logger->info("Slim-Skeleton '/' route");
        
        // basket summary
        $summary = $this->getBasketSummary($this->getSessionItems());

        // pass summary data to header
        $this->view->addAttribute('summary', $summary);

        // Render index view
        return $this->view->render($response, 'index.phtml', ['items' => $items]);
    }

    /**
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param type $args
     * @return type
     */
    public function basket(RequestInterface $request, ResponseInterface $response, $args)
    {
        $items = $this->getSessionItems();

        // basket summary
        $summary = $this->getBasketSummary($this->getSessionItems());

        // pass summary data to header
        $this->view->addAttribute('summary', $summary);

        // Render index view
        return $this->view->render($response, 'basket.phtml', ['items' => $items]);
    }

    /**
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param type $args
     * @return type
     */
    public function addBasket(RequestInterface $request, ResponseInterface $response, $args)
    {
        $item = $this->itemRepository->getItem($args['item_id']);

        $basket = new Basket($this->getSessionItems());

        $basket->addItem($item);

        $basket->save();

        return $response->withHeader('Location', '/basket');
    }

    /**
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param type $args
     * @return type
     */
    public function removeBasket(RequestInterface $request, ResponseInterface $response, $args)
    {
        $item = $this->itemRepository->getItem($args['item_id']);

        $basket = new Basket($this->getSessionItems());

        $basket->removeItem($item);

        $basket->save();

        return $response->withHeader('Location', '/basket');
    }

    /**
     * 
     * @return type
     */
    private function getSessionItems()
    {
        $itemString = Session::get('basket');

        $itemIds = explode(',', $itemString);

        $items = [];

        foreach ($itemIds as $id) {
            if ($id != '') {
                $items[] = $this->itemRepository->getItem($id);
            }
        }

        return $items;
    }

    private function getBasketSummary($items)
    {
        $total = 0;

        foreach ($items as $item) {
            $total += $item->price;
        }

        $summary = array("count" => count($items), "total" => $total);

        return $summary;
    }
}
