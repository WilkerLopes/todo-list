<?php
  $server = "127.0.0.1";
  $username = "root";
  $password = "";
  $db = "todo";

  try {
    $handle = new PDO("mysql:host=$server;dbname=$db", "$username", "$password");
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected";
  } catch(PDOException $e) {
    die("Oops. Something went wrong in the database.");
  }
