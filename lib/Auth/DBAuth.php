<?php

namespace Lib\Auth;

use Lib\Models\Model;

class DBAuth extends Model {

    public function auth($username, $password) {
        $user = $this->db->query('SELECT * FROM users WHERE username = ?', '', [$username]);

        if($user) { // not safe, just for test purposes
            return $user['password'] === $password;
        }

        return false;
    }

    public function logged() {
        return isset($_SESSION['auth']);
    }

}