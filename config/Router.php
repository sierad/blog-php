<?php

namespace App\config;
use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

class Router
{
    private $frontController;
    private $errorController;
    private $backController;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {
        $route = $this->request->getGet()->get('route');
        try{
            if(isset($route))
            {
                if($route === 'article'){
                    $this->frontController->article($this->request->getGet()->get('articleId'));
                }
                elseif($route === 'commentaire'){
                    $this->frontController->commentaire($this->request->getGet()->get('commentId'));
                }
                elseif ($route === 'addArticle'){
                    $this->backController->addArticle($this->request->getPost(), $this->request->getGet()->get('articleId'));
                }
                elseif ($route === 'editArticle'){
                    $this->backController->editArticle($this->request->getPost(), $this->request->getGet()->get('articleId'));
                }
                elseif ($route === 'editComment'){
                    $this->backController->editComment($this->request->getPost(), $this->request->getGet()->get('commentId'));
                }
                elseif($route === 'deleteArticle'){
                    $this->backController->deleteArticle($this->request->getGet()->get('articleId'));
                }
                elseif($route === 'deleteCommentSingle'){
                    $this->backController->deleteCommentSingle($this->request->getGet()->get('commentId'));
                }
                elseif($route === 'addComment'){
                    $this->frontController->addComment($this->request->getPost());
                }
                elseif($route ==='inscription'){
                    $this->frontController->inscription($this->request->getPost());
                }
                elseif($route === 'connexion'){
                    $this->frontController->connexion($this->request->getPost());
                }
                elseif($route === 'deconnexion'){
                    $this->backController->deconnexion();
                }
                elseif ($route === 'deleteAccount'){
                    $this->backController->deleteAccount();
                }
                else{
                    $this->errorController->errorNotFound();
                }
            }
            else{
                $this->frontController->home();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}