<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;
use App\src\model\User;

class UserDAO extends DAO
{
    private function buildObject($row){
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setCreatedAt($row['createdAt']);
        $user->setRole($row['name']);
        return $user;
    }

    public function getUsers()
    {
        $sql = 'SELECT user.id, user.pseudo, user.createdAt, role.name FROM user INNER JOIN role on user.role_id = role.id ORDER BY user.id DESC';
        $result = $this->createQuery($sql);
        $users = [];
        foreach ($result as $row){
            $userId = $row['id'];
            $users[$userId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $users;
    }

    public function register(Parameter $post)
    {
        $password = password_hash($post->get('pseudo'), PASSWORD_BCRYPT);
        $sql = 'INSERT INTO user (pseudo, mail, password, createdAt, role_id) VALUES (?, ?,?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('pseudo'), $post->get('mail'), $password, 2]);
    }

    public function login(Parameter $post)
    {
        $sql = 'SELECT user.id, user.role_id, user.pseudo, user.mail, user.password FROM user INNER JOIN role ON role.id=user.role_id WHERE pseudo = ?';
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

    public function deleteUser($userId){
        $sql = 'DELETE FROM user WHERE id = ?';
        $this->createQuery($sql, [$userId]);
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