<?php

namespace Lib\Models;

use Lib\Database\Database;

class Model {

    protected $db;

    public function __construct(Database $db = null) {
        $this->db = $db;
    }
}