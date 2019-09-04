<?php

namespace App\src\controller;

use App\config\Request;
use App\src\constraint\Validation;
use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\UserDAO;
use App\src\model\Pagination;
use App\src\model\View;

abstract class Controller
{
    protected $articleDAO;
    protected $commentDAO;
    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $userDAO;
    protected $pagination;
    protected $validation;
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->validation = new Validation();
        $this->pagination = new Pagination();
        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->userDAO = new UserDAO();
        $this->loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig= new \Twig\Environment($this->loader, [
            'debug'=> true
        ]);
        $this->twig->addGlobal('session', $this->session);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }
}