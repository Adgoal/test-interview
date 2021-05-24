<?php

namespace Api\Services;

use Api\Model\User;

class UserServices
{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * @param string $login
     * @param string $password
     * @return User|null
     */
    public function createUser(string $login, string $password): ?User
    {
        $query = "INSERT INTO `users`
                SET
                    email = :email,
                    password = :password";

        $query = $this->db->prepare($query);
        $login = htmlspecialchars($login);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query->bindParam(':email', $login);
        $query->bindParam(':password', $password);

        if($query->execute()) {
            return $query->fetch();
        }

        return false;
    }

    /**
     * @param $params
     * @return User|null
     */
    public function existEmail($params): ?User
    {
        $query = "SELECT id, email
            FROM `users`
            WHERE email = :email
            LIMIT 1";

        $query = $this->db->prepare($query);
        $params['email'] = htmlspecialchars($params['email']);

        $query->bindParam(':email', $params['email']);

        if($query->execute()) {
            return true;
        }

        return false;
    }
}
