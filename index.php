<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$route = $_GET['route'] ?? '';
if ($route == '' || $route === '/') {
  require_once 'main.php';
} else if ($route === 'lead-form') {
  require_once 'lead.php';
} else {
  require_once '404.php';
}