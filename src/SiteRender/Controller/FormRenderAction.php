<?php

namespace App\SiteRenderer\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormRendererAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('Form/index.html.twig');
    }
}
