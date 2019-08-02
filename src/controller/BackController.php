<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    private function checkLoggedIn()
    {
        if(!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if(!($this->session->get('role') ==1)) {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        } else {
            return true;
        }
    }

    public function addArticle(Parameter $post)
    {
        if($this->checkAdmin()){
            if($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if(!$errors) {
                    $this->articleDAO->addArticle($post, $this->session->get('id'));
                    $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                    header('Location: ../public/index.php?route=administration');
                }
                echo $this->twig->render('add_article.html.twig', [
                    'post' => $post,
                    'errors' => $errors
                ]);
            }
            echo $this->twig->render('add_article.html.twig');
        }
    }


    public function editArticle(Parameter $post, $articleId)
    {
        if($this->checkAdmin()){
            $article = $this->articleDAO->getArticle($articleId);
            if($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if(!$errors) {
                    $this->articleDAO->editArticle($post, $articleId, $this->session->get('id'));
                    $this->session->set('edit_article', 'L\' article a bien été modifié');
                    header('Location: ../public/index.php?route=administration');
                }
                echo $this->twig->render('edit_article.html.twig', [
                    'post' => $post,
                    'errors' => $errors
                ]);

            }
            $post->set('id', $article->getId());
            $post->set('title', $article->getTitle());
            $post->set('content', $article->getContent());
            $post->set('author', $article->getAuthor());

            echo $this->twig->render('edit_article.html.twig', [
                'post' => $post
            ]);
        }
    }


    public function editComment(Parameter $post, $id)
    {
        if($this->checkAdmin()){
            $comment=$this->commentDAO->getComment($id);
            if($post->get('submit')){
                var_dump('soumis');
                $this->commentDAO->editComment($post, $id);
                $this->session->set('edit_comment', 'Le commentaire a bien été modifié');
                header('Location: ../public/index.php?route=article&articleId='.$comment->getArticleId());
            }
            $post->set('id',$comment->getId());
            $post->set('pseudo',$comment->getPseudo());
            $post->set('content',$comment->getContent());
            $post->set('articleId',$comment->getArticleId());
            echo $this->twig->render('edit_comment.html.twig', [
                'post' => $post
            ]);
        }

        //$this->session->set('comment_not_found', 'Pas trouvé');
        //header('Location: ../public/index.php');
    }

    public function deleteArticle($id)
    {
        if($this->checkAdmin()){
            $article = $this->articleDAO->getArticle($id);
            if ($article->getId()) {
                $this->articleDAO->deleteComment($id);
                $this->articleDAO->deleteArticle($id);
                $this->session->set('article_delete', 'L\'article a été supprimé');
            } else{
                $this->session->set('article_not_found', 'L\'article demandé n\'existe pas');
            }
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function deleteCommentSingle($id){
        if($this->checkAdmin()){
            $commente = $this->commentDAO->getComment($id);
            if ($commente->getId()){
                $this->commentDAO->deleteCommentSingle($id);
                $this->session->set('comment_delete', 'Commentaire supprimé');
            }
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function deconnexion($param = null){
        if($this->checkAdmin()){
            $this->session->get('pseudo');
            $this->session->reset();
            if (!$param){
                $this->session->set('deconnexion', 'Vous etes déconnecté !');
            } else {
                $this->session->set($param, 'Le compte a bien été supprimé');
            }
            header('Location:../public/index.php');
        }

    }

    public function deleteAccount(){
        if($this->checkAdmin()){
            $ids=$this->session->get('pseudo');
            $this->userDAO->deleteAccount($ids);
            $this->deconnexion('delete_account');
        }
    }

    public function editPassword(Parameter $post, $id){
        if ($post->get('submit')){
            $this->userDAO->editPassword($post, $id);
            header('Location:../public/index.php');
        }
        echo $this->twig->render('edit_password.html.twig');
    }

    public function profile(){
        echo $this->twig->render('profile.html.twig');
    }

    public function administration()
    {
        if($this->checkAdmin()){
            $articles=$this->articleDAO->getArticles();
            $comments=$this->commentDAO->getFlagComments();
            $users=$this->userDAO->getUsers();
            echo $this->twig->render('administration.html.twig',[
                'articles' => $articles,
                'comments'=>$comments,
                'users'=>$users
            ]);
        }
    }

    public function unflagComment($commentId){
        if($this->checkAdmin()){
            $this->commentDAO->unflagComment($commentId);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé.');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function deleteUser(){
        if($this->checkAdmin()){
            $this->userDAO->deleteAccount($userId);
            $this->session->set('delete_user', 'L\'utilisateur a bien été supprimé');
            header('Location:../public/index.php,route=administration;');
        }
    }

}