<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public function addArticle(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if(!$errors) {
                $this->articleDAO->addArticle($post, $this->session);
                $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php');
            }
            return $this->view->render('add_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('add_article');
    }


    public function editArticle(Parameter $post, $articleId)
    {
        $article = $this->articleDAO->getArticle($articleId);
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if(!$errors) {
                $this->articleDAO->editArticle($post, $articleId);
                $this->session->set('edit_article', 'L\' article a bien été modifié');
                header('Location: ../public/index.php');
            }
            return $this->view->render('edit_article', [
                'post' => $post,
                'errors' => $errors
            ]);

        }
        $post->set('id', $article->getId());
        $post->set('title', $article->getTitle());
        $post->set('content', $article->getContent());
        $post->set('author', $article->getAuthor());

        return $this->view->render('edit_article', [
            'post' => $post
        ]);
    }


    public function editComment(Parameter $post, $id)
    {
        $commente=$this->commentDAO->getComment($id);
        if($post->get('submit')){
            var_dump('soumis');
            $this->commentDAO->editComment($post);
            $this->session->set('edit_comment', 'Le commentaire a bien été modifié');
            header('Location: ../public/index.php?route=article&articleId='.$commente->getArticleId());
        }
        return $this->view->render('edit_comment', [
            'comment' => $commente
        ]);
        //$this->session->set('comment_not_found', 'Pas trouvé');
        //header('Location: ../public/index.php');
    }

    public function deleteArticle($id)
    {
        $article = $this->articleDAO->getArticle($id);
        if ($article->getId()) {
            $this->articleDAO->deleteComment($id);
            $this->articleDAO->deleteArticle($id);
            $this->session->set('article_delete', 'L\'article a été supprimé');
        } else{
            $this->session->set('article_not_found', 'L\'article demandé n\'existe pas');
        }
        header('Location: ../public/index.php');
    }

    public function deleteCommentSingle($id){
        $commente = $this->commentDAO->getComment($id);
        if ($commente->getId()){
            $this->commentDAO->deleteCommentSingle($id);
            $this->session->set('comment_delete', 'Commentaire supprimé');
        }
        header('Location: ../public/index.php?route=article&articleId='. $commente->getArticleId());
    }

    public function deconnexion($param = null){
        $this->session->get('pseudo');
        $this->session->reset();
        if (!$param){
            $this->session->set('deconnexion', 'Vous etes déconnecté !');
        } else {
            $this->session->set($param, 'Le compte a bien été supprimé');
        }
        header('Location:../public/index.php');
    }

    public function deleteAccount(){
        $ids=$this->session->get('pseudo');
        $this->userDAO->deleteAccount($ids);
        $this->deconnexion('delete_account');
    }

    public function editPassword(Parameter $post, $id){
        var_dump($post);
        var_dump($id);
        if ($post->get('submit')){
            $this->userDAO->editPassword($post, $id);
            header('Location:../public/index.php');
        }
        return $this->view->render('edit_password');
    }
}