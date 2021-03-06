<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['createdAt']);
        $comment->setArticleId($row['article_id']);
        $comment->setFlag($row['flag']);
        return $comment;
    }

    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT id, pseudo, content, createdAt, article_id, flag FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$articleId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function editComment(Parameter $post, $id)
    {
        $sql = "UPDATE comment SET pseudo = :pseudo , content = :content , createdAt = NOW() WHERE id= :id";
        $this->createQuery($sql, [
            'pseudo'=> $post->get('pseudo'),
            'content'=> $post->get('content'),
            'id'=> $id
        ]);
    }

    public function getComment($commentId)
    {
        $sql = "SELECT id, pseudo, content, createdAt, article_id, flag FROM comment WHERE id = ?";
        $result = $this->createQuery($sql, [$commentId]);
        $commente = $result ->fetch();
        $result->closeCursor();
        return $this->buildObject($commente);
    }

    public function addComment(Parameter $post, $articleId)
    {
        $sql = 'INSERT INTO comment (pseudo, content,flag ,article_id, createdAt) VALUES (?, ?,?,?, NOW())';
        $this->createQuery($sql, [$post->get('pseudo'), $post->get('content'),0, $articleId]);
    }


    public function deleteCommentSingle($id){
        $sql ='DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql, [$id]);
    }

    public function flagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [1, $commentId]);
    }

    public function getFlagComments()
    {
        $sql = 'SELECT id, pseudo, content, createdAt, flag, article_id FROM comment WHERE flag = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [1]);
        $comments = [];
        foreach ($result as $row){
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function unflagComment($commentId){
        $sql = 'UPDATE comment SET flag =:flag  WHERE id =:commentId';
        $this->createQuery($sql, [
            'flag' => 0,
            'commentId' => $commentId
        ]);
    }

}