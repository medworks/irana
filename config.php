<?php
  error_reporting (E_ALL ^ E_NOTICE);
  
  define("_DB_NAME","irana");
  define("_DB_USER", "root");
  define("_DB_PASS", "");
  define("_DB_SERVER", "localhost");
  define("_DOMAIN", "http://localhost/irana");
  

 
  define("_USER_IP",$_SERVER['REMOTE_ADDR']);  
  define("_ADMIN", 1);
  define("_USER", 2);
  define("_ANONYMOUS", 3); 
/*
  define ('SITE_ROOT', '');
  define ('OS_ROOT', $_SERVER['DOCUMENT_ROOT']);
*/
  
  define ('SITE_ROOT', '/irana');
  define ('OS_ROOT', $_SERVER['DOCUMENT_ROOT']."/irana");
  
  
?>