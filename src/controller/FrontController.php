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

    public function addComment(Parameter $post){
        if($post->get('submit') ){
            $this->commentDAO->addComment($post);
            $this->session->set('add_comment', 'Le commentaire est bien ajouté');
            header('Location: ../public/index.php?route=article&articleId='. $post->get('articleId'));
        }
    }
}