<?php

$page = (!empty($_GET['p'])) ? $_GET['p'] : 'home';
require '../app/Views/templates/default.php';