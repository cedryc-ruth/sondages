<?php
namespace App\Views;

class TwigView extends View {
    private $loader;
    private $twig;

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader('/Views/templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '/cache',
        ]);
    }
}