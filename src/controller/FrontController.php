<?php

namespace App\src\controller;

use App\config\Parameter;

class FrontController extends Controller
{
    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('home', [
           'articles' => $articles
        ]);
    }

    public function article($articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        return $this->view->render('single', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function commentaire($commentId)
    {
        $commente = $this->commentDAO->getComment($commentId);
        return $this->view->render('singleCom',[
            'comment'=>$commente
        ]);
    }

    public function addComment(Parameter $post, $articleId){
        if($post->get('submit') ){
            var_dump($post);
            var_dump($articleId);
            $errors=$this->validation->validate($post, 'Comment');
            if(!$errors){
                $this->commentDAO->addComment($post, $articleId);
                $this->session->set('add_comment', 'Le commentaire est bien ajouté');
                header('Location: ../public/index.php?route=article&articleId='. $articleId);
            }
            $article = $this->articleDAO->getArticle($post->get('articleId'));
            $comments=$this->commentDAO->getCommentsFromArticle($post->get('articleId'));
            return $this->view->render('single', [
                'article'=>$article,
                'comments'=>$comments,
                'post'=>$post,
                'errors'=>$errors
            ]);
        }
    }

    public function flagComment($commentId)
    {
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
        header('Location:../public/index.php');
    }

    public function inscription(Parameter $post){
        if ($post->get('submit')){
            $errors = $this->validation->validate($post,'User');
            if(!$errors){
                $values = $this->userDAO->connexion($post);
                if (!$values['resultat']['pseudo']){
                    $this->userDAO->inscription($post);
                    header('Location:../public/index.php?route=connexion');
                } else {
                    $this->session->set('badPass', 'Le pseudo existe deja ! ');
                }
            }
            return $this->view->render('inscription',[
                'post'=>$post,
                'errors'=>$errors
            ]);
        }
        return $this->view->render('inscription');
    }

    public function connexion(Parameter $post){
        if ($post->get('submit')){
            $values = $this->userDAO->connexion($post);
            if (!$values['passOk']){
                $this->session->set('bad_connexion', 'Mauvais identifiant ou mot de passe');
            }
            else {
                var_dump($values);
                $this->session->set('id', $values['resultat']['id']);
                $this->session->set('pseudo', $values['resultat']['pseudo']);
                $this->session->set('role', $values['resultat']['role_id']);
                $this->session->set('connexion', 'Vous etes bien connecté');
                header('Location:../public/index.php');
            }
        }
        return $this->view->render('connexion');
    }

}