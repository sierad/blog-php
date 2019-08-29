<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{
    public function home()
    {
        $pagination = $this->pagination->paginate(5, $this->get->get('page'), $this->articleDAO->total() );
        $articles = $this->articleDAO->getArticles($pagination->getLimit(), $this->pagination->getStart());
        $allArticles = $this->articleDAO->getArticles();
        echo $this->twig->render('home.html.twig',[
            'articles'=>$articles,
            'pagination' => $pagination,
            'allArticles' =>$allArticles
        ]);
    }

    public function article($articleId, Parameter $post)
    {
        $errors=$this->validation->validate($post, 'Comment');
        if ($post->get('submit')){
            $this->addComment($errors , $post ,$articleId);
        }
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        $allArticles = $this->articleDAO->getArticles();
        echo $this->twig->render('single.html.twig', [
            'article' => $article,
            'comments' => $comments,
            'allArticles' =>$allArticles,
            'errors' => $errors,
            'post'=>$post
        ]);
    }

    private function addComment($errors, $post ,$articleId){
        if(!$errors){
            $this->commentDAO->addComment($post, $articleId);
            $this->session->set('add_comment', 'Le commentaire est bien ajouté');
            header('Location: ../public/index.php?route=article&articleId='. $articleId);
        } else

        $this->session->set('errors', 'Pensez a bien remplir les champs');
    }

    public function commentaire($commentId)
    {
        $commente = $this->commentDAO->getComment($commentId);
        echo $this->twig->render('singleCom.html.twig',[
            'comment'=>$commente
        ]);
    }


    public function flagComment($commentId)
    {
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
        header('Location:../public/index.php');
    }

    public function register(Parameter $post){
        $errors = $this->validation->validate($post,'User');
        if ($post->get('submit')){
            if(!$errors){
                $values = $this->userDAO->login($post);
                if (!$values['resultat']['pseudo']){
                    $this->userDAO->register($post);
                    header('Location:../public/index.php?route=login');
                }
                else {
                    $this->session->set('bad_pass', 'Le pseudo existe deja ! ');
                }
            }
        }
        echo $this->twig->render('register.html.twig',[
            'post'=>$post,
            'errors'=>$errors
        ]);
    }

    public function login(Parameter $post){
        if ($post->get('submit')){
            $values = $this->userDAO->login($post);
            if (!$values['passOk']){
                $this->session->set('bad_login', 'Mauvais identifiant ou mot de passe');
            }
            else {
                $this->session->set('id', $values['resultat']['id']);
                $this->session->set('pseudo', $values['resultat']['pseudo']);
                $this->session->set('role', $values['resultat']['role_id']);
                $this->session->set('login', 'Vous etes bien connecté');
                header('Location:../public/index.php');
            }
        }
        echo $this->twig->render('login.html.twig');
    }

}