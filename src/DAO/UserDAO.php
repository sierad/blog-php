<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class UserDAO extends DAO
{
    public function inscription(Parameter $post)
    {
        $password = password_hash($post->get('pseudo'), PASSWORD_DEFAULT);
        $sql = 'INSERT INTO user (pseudo, mail, password, createdAt) VALUES (?, ?,?, NOW())';
        $this->createQuery($sql, [$post->get('pseudo'), $post->get('mail'), $password]);
    }

    public function connexion(Parameter $post)
    {
        $sql = 'SELECT id, pseudo, mail, password FROM user WHERE pseudo = ?';
        $result = $this->createQuery($sql, [$post->get('pseudo')]);
        $resultat = $result->fetch();
        $passOk = password_verify($post->get('password'), $resultat['password']);

        return [
            'resultat'=>$resultat,
            'passOk'=>$passOk
        ];
    }
   public function deleteAccount($ids){
        $sql = 'DELETE FROM user WHERE pseudo = ?';
        $this->createQuery($sql, [$ids]);
    }

    public  function editPassword(Parameter $post, $id){
        $password = password_hash($post->get('password'), PASSWORD_DEFAULT);
        var_dump($post, $id);
        $sql = 'UPDATE user SET password = :password WHERE pseudo = :pseudo';
        $this->createQuery($sql, [
            'password' => $password,
            'pseudo' => $post->get('pseudo')]);
    }

}