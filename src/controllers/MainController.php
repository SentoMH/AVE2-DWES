<?php

namespace AP\Controllers;

use AP\Core\AbstractController;


class MainController extends AbstractController
{

    public function main():void{
        $this->render("layout.html.twig",[
        ]);
        
    }
}