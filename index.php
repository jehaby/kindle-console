<?php

require 'Client.php';
require 'db.php';

error_reporting(E_ALL);
ini_set('max_execution_time', 300);


$client = new Client();
$client->doStuff();
