<?php

namespace App\SiteRenderer\Controller;

use App\SiteRenderer\QueryHandler\TableRendererHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TableRendererAction extends AbstractController
{
    private TableRendererHandler $handler;

    public function __construct(TableRendererHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(): Response
    {

        $productCollection = $this->handler->handle();
        return $this->render('ProductTable/index.html.twig', ['products' => $productCollection->getCollection()]);
    }
}
