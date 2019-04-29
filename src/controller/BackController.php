<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{
    public function addArticle(Parameter $post)
    {
        if($post->get('submit')) {
            $this->articleDAO->addArticle($post);
            $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
            header('Location: ../public/index.php');
        }
        return $this->view->render('add_article', [
            'post' => $post
        ]);
    }


    public function editArticle(Parameter $post, $id)
    {
        var_dump($post, $id);
        $article = $this->articleDAO->getArticle($id);
        if($article->getId()) {
            return $this->view->render('edit_article', [
                'article' => $article
            ]);
        }
        $this->session->set('article_not_found', 'L\'article demandé n\'existe pas');
        header('Location: ../public/index.php');
    }

    public function editComment(Parameter $post, $id)
    {
        $commente=$this->commentDAO->getComment($id);
        var_dump($commente);
        if($post->get('submit')){
            var_dump('soumis');
            $this->commentDAO->editComment($post);

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
        $commente=$this->commentDAO->getComment($id);
        if ($commente->getId()){
            $this->commentDAO->deleteCommentSingle($id);
            $this->session->set('comment_delete', 'Commentaire supprimé');
        }
        header('Location: ../public/index.php');
    }
}