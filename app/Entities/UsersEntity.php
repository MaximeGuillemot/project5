<?php

namespace App\Entities;

class UsersEntity {

    public  $id, // Properties written manually for clarity but otherwise created automatically by PDO fetch
            $username,
            $password,
            $date;
}
