<?php
require_once 'functions.php';

$config = [
  'host' => 'mysql-8.2:3306',
  'database' => 'intensa',
  'charset' => 'utf8',
  'username' => 'root',
  'password' => '',
  'options' => [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]
];

try {
  $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
  $pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);

} catch (PDOException $e) {
  setFlashMessage('danger', "Ошибка подключения к базе данных: " . $e->getMessage());
}


