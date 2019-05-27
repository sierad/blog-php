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

}