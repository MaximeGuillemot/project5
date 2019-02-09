<?php

namespace Lib\Auth;

use Lib\Models\Model;

class DBAuth extends Model {

    public function auth($username, $password, $class) {
        $user = $this->db->query('SELECT * FROM users WHERE username = ?', $class, [$username]);
  
        if($user) {
            if(password_verify($password, $user->password)) {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }

        return false;
    }

    public function logged() {
        return isset($_SESSION['auth']);
    }

    public function getUserId() {
        if($this->logged()) {
            return $_SESSION['auth'];
        }

        return null;
    }
}