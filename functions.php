<?php

function formatPhoneBack($phoneNumber): array|string|null
{
  #Удаляем все символы, кроме цифр
  return preg_replace('/[^0-9]/', '', $phoneNumber);
}

function formatPhoneTpl($phoneNumber): string
{
  #Форматируем номер телефона
  return '+7(' . substr($phoneNumber, 1, 3) . ')' . substr($phoneNumber, 4, 3) . '-' . substr($phoneNumber, 7, 2) . '-' . substr($phoneNumber, 9, 2);
}

function validateForm($fullName, $email, $phone, $city): array
{
  $errors = [];

  if (empty($fullName)) {
    $errors[] = "Необходимо ввести полное имя";
  }

  if (empty($email)) {
    $errors[] = "Необходимо ввести email";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Неверный формат email";
  }

  if (empty($phone) || $phone === '+7') {
    $errors[] = "Необходимо ввести номер телефона";
  }

  $cities = ['Москва', 'Санкт-Петербург', 'Тула'];
  if (empty($city)) {
    $errors[] = "Необходимо выбрать город";
  } elseif (!in_array($city, $cities, true)) {
    $errors[] = "Выбран недопустимый город";
  }
  return $errors;
}


function setFlashMessage($type, $message): void
{
  if (!isset($_SESSION['flash_messages'])) {
    $_SESSION['flash_messages'] = [];
  }
  $_SESSION['flash_messages'][] = [
    'type' => $type,
    'message' => $message,
  ];
}

function getFlashMessages()
{
  if (isset($_SESSION['flash_messages'])) {
    $messages = $_SESSION['flash_messages'];
    unset($_SESSION['flash_messages']); #Удаляем сообщения после их отображения
    return $messages;
  }
  return [];
}

function isFormSubmissionAllowed(): bool
{
  #Получаем текущий IP
  $ip = $_SERVER['REMOTE_ADDR'];

  $maxSubmissions = 5;
  $submissionWindow = 3600; // 1 час в секундах
  $blockDuration = 7200; // 2 часа в секундах

  $_SESSION['submission_tracking'] ??= [];
  $_SESSION['submission_tracking'][$ip] ??= [
    'count' => 0,
    'first_submission_time' => null,
    'block_time' => null
  ];

  $tracking = &$_SESSION['submission_tracking'][$ip];
  $currentTime = time();

  #Проверяем, не истекло ли время блокировки
  if ($tracking['block_time'] && ($currentTime - $tracking['block_time'] < $blockDuration)) {
    $_SESSION['form_blocked'] = true;
    $_SESSION['unblock_time'] = $tracking['block_time'] + $blockDuration;
    return false;
  }

  if ($tracking['block_time'] && ($currentTime - $tracking['block_time'] >= $blockDuration)) {
    #Сбрасываем блокировку, счетчик и время первой отправки
    $tracking['block_time'] = null;
    $tracking['count'] = 0;
    $tracking['first_submission_time'] = null;
    unset($_SESSION['form_blocked']);
    unset($_SESSION['unblock_time']);
  }

  #Проверяем, не истекло ли время отправки
  if ($tracking['first_submission_time'] && ($currentTime - $tracking['first_submission_time'] >= $submissionWindow)) {
    $tracking['count'] = 0;
    $tracking['first_submission_time'] = null;
  }

  #Обновляем время первой отправки, если счетчик сброшен
  if ($tracking['count'] == 0) {
    $tracking['first_submission_time'] = $currentTime;
  }

  #Проверяем количество отправок
  if ($tracking['count'] < $maxSubmissions) {
    $tracking['count']++;
    $_SESSION['form_blocked'] = false;
    return true;
  }

  #Если достигли лимита, блокируем форму
  $tracking['block_time'] = $currentTime;
  $_SESSION['form_blocked'] = true;
  $_SESSION['unblock_time'] = $tracking['block_time'] + $blockDuration;
  return false;
}

function exportCSV($leads)
{
  # Формирование CSV файла
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=leads.csv');

  $output = fopen('php://output', 'w');

  # Заголовки CSV файла
  fputcsv($output, array('Ф.И.О', 'Email', 'Телефон', 'Город'));
  fwrite($output, "\xEF\xBB\xBF");
  # Данные из базы данных
  foreach ($leads as $lead) {
    $name = htmlspecialchars($lead['name']);
    $email = htmlspecialchars($lead['email']);
    $phone = htmlspecialchars(formatPhoneTpl($lead['phone']));
    $city = htmlspecialchars($lead['city']);

    fputcsv($output, [$name, $email, $phone, $city]);
  }
  fclose($output);

  # Останавливаем выполнение скрипта, чтобы предотвратить отображение страницы после экспорта CSV
  exit;
}

