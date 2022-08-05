<?php

require 'db.class.php';
require 'panier.class.php';
require 'user.class.php';
$DB     = new DB();
$panier = new panier($DB);
$user   = new user($DB);

