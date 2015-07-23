<?php

require 'Client.php';
require 'db.php';

error_reporting(E_ALL);


$client = new Client();
$client->doStuff();
