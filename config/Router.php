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
                    $this->frontController->article($this->request->getGet()->get('articleId'), $this->request->getPost());
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
                elseif($route === 'deleteArticle'){
                    $this->backController->deleteArticle($this->request->getGet()->get('articleId'));
                }
                elseif($route === 'deleteCommentSingle'){
                    $this->backController->deleteCommentSingle($this->request->getGet()->get('commentId'));
                }
                elseif ($route === 'deleteUser'){
                    $this->backController->deleteUser($this->request->getGet()->get('userId'));
                }
                elseif($route === 'flagComment'){
                    $this->frontController->flagComment($this->request->getGet()->get('commentId'));
                }
                elseif($route === 'unflagComment'){
                    $this->backController->unflagComment($this->request->getGet()->get('commentId'));
                }
                elseif($route ==='register'){
                    $this->frontController->register($this->request->getPost());
                }
                elseif($route === 'login'){
                    $this->frontController->login($this->request->getPost());
                }
                elseif($route === 'logOut'){
                    $this->backController->logOut();
                }
                elseif ($route === 'deleteAccount'){
                    $this->backController->deleteAccount($this->request->getSession());
                }
                elseif ($route === 'editPassword'){
                    $this->backController->editPassword($this->request->getPost(), $this->request->getSession('pseudo'));
                }
                elseif ($route==='profile'){
                    $this->backController->profile();
                }
                elseif ($route === 'administration'){
                    $this->backController->administration();
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
            var_dump($e->getMessage());
            $this->errorController->errorServer();
        }
    }
}