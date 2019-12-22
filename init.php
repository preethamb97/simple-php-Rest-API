<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  $basePath = dirname(__FILE__);
  include_once $basePath."/root/database.php";
  include_once $basePath."/settings/settings.php";
  include_once $basePath."/root/autoload.php";
  include_once $basePath."/global/global.php";

  $settings = array(
    'host'=>$host,
    'database_name'=>$databaseName,
    'user_name'=>$userName,
    'password'=>$password
  );
  Database::close();
  $connection = Database::dbConnect($settings);
?>