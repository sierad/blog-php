<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\config\Session;
use App\src\model\Article;

class ArticleDAO extends DAO
{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedAt($row['createdAt']);
        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo , article.createdAt FROM article INNER JOIN user ON article.user_id=user.id ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleId = $row['id'];
            $articles[$articleId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    public function getArticle($articleId)
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id=user.id WHERE article.id = ? ';
        $result = $this->createQuery($sql, [$articleId]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    public function addArticle(Parameter $post, $userId)
    {
        var_dump($session);
        //Permet de récupérer les variables $title, $content et $author
        $sql = 'INSERT INTO article (title, content, user_id, createdAt) VALUES (?, ?, ?, NOW())';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'),$userId]);
    }

    public function editArticle(Parameter $post, $articleId, $userId)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, user_id=:user_id WHERE id=:articleId';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'user_id' => $userId,
            'articleId' => $articleId
        ]);
    }

    public function deleteArticle($id)
    {
        $sql = 'DELETE FROM article  WHERE id=? ';
        $this->createQuery($sql, [$id]);
    }

    public function deleteComment($id){
        $sql ='DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$id]);
    }
}