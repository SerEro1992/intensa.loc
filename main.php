<?php
require_once 'config.php';
require_once 'functions.php';
require_once('tmp/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isFormSubmissionAllowed()) {
    setFlashMessage('danger', 'Форма временно заблокирована из-за многократной попытки отправки. Пожалуйста, попробуйте позже.');
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  }

#Проверка CSRF токена
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF токен недействителен');
  }

  #Получение данных из формы
  $fullName = trim($_POST['fullName']);
  $email = trim($_POST["email"]);
  $phone = formatPhoneBack(trim($_POST["phone"]));
  $city = $_POST['city'] ?? null;

#Валидация полей
  $errors = validateForm($fullName, $email, $phone, $city);

  #Отобразить ошибки, если они есть
  if (!empty($errors)) {
    foreach ($errors as $error) {
  #Устанавливаем ошибку в сессии
      setFlashMessage('danger', $error);
    }
  } else {
    try {
      #Отправляем данные в БД
      global $pdo;
      $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, city) VALUES (?, ?, ?, ?)");
      $stmt->execute([$fullName, $email, $phone, $city]);

      setFlashMessage('success', 'Форма успешно отправлена');
    } catch (PDOException $e) {
      setFlashMessage('danger', "Ошибка подключения к базе данных: " . $e->getMessage());
    }
  }

# Обновление CSRF токена
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

#Перенаправление для предотвращения повторной отправки формы
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

$flashMessages = getFlashMessages();
?>

<main class="content p-5">
  <?php foreach ($flashMessages as $flashMessage): ?>
    <div class="alert alert-<?= htmlspecialchars($flashMessage['type']) ?> alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($flashMessage['message']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endforeach; ?>

  <h1 class="display-5 mb-5">Форма для сбора информации</h1>

  <form action="" method="post" id="leadForm">
    <div class="mb-3 w-50">
      <label for="fullName" class="form-label">Ф.И.О:</label>
      <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Введите ваше полное имя">
    </div>

    <div class="mb-3 w-50">
      <label for="email" class="form-label">Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Введите ваш email">
    </div>

    <div class="mb-3 w-50">
      <label for="phone" class="form-label">Телефон:</label>
      <input type="tel" class="form-control" id="phone" name="phone" placeholder="+7(000)000-00-00"
             onkeyup="formatPhoneFront(this)" value="+7">
    </div>

    <div class="mb-3 w-50">
      <label for="city" class="form-label">Город:</label>
      <select class="form-select" id="city" name="city">
        <option value="" selected disabled>Выберите город</option>
        <option value="Москва">Москва</option>
        <option value="Санкт-Петербург">Санкт-Петербург</option>
        <option value="Тула">Тула</option>
      </select>
    </div>

    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

    <button type="submit" class="btn btn-primary" id="submitButton">Отправить</button>
  </form>

  <!-- Создание элементов для передачи данных сессии в JavaScript: -->
  <div id="formBlocked"
       style="display: none;"><?= json_encode($_SESSION['form_blocked'] ?? false, JSON_THROW_ON_ERROR); ?></div>
  <div id="unblockTime"
       style="display: none;"><?= json_encode($_SESSION['unblock_time'] ?? null, JSON_THROW_ON_ERROR); ?></div>
</main>

<?php
require_once('tmp/footer.php');
?>
