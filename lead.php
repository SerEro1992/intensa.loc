<?php
session_start();
require_once 'config.php';
require_once 'functions.php';


#Получение списка городов для фильтра
global $pdo;


$cities = [
  'Москва' => 'Москва',
  'Санкт-Петербург' => 'Санкт-Петербург',
  'Тула' => 'Тула'
];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filter'])) {
  $selectedCity = $_POST['city'] ?? '';
  $_SESSION['selectedCity'] = $selectedCity;

  #Перенаправление для предотвращения повторной отправки формы
  header('Location: ' . $_SERVER['REQUEST_URI']);
  exit();
}

# Получение данных из сессии
$selectedCity = $_SESSION['selectedCity'] ?? '';

try {
  if ($selectedCity && in_array($selectedCity, $cities, true)) {
    $stmt = $pdo->prepare("SELECT name, email, phone, city FROM users WHERE city = ?");
    $stmt->execute([$selectedCity]);

  } else {
    $stmt = $pdo->query("SELECT name, email, phone, city FROM users");
  }

  $leads = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $leads = array_reverse($leads);


} catch (PDOException $e) {
  die("Ошибка выполнения запроса: " . $e->getMessage());
}


# Проверяем, была ли нажата кнопка "Экспортировать в CSV"
if (isset($_POST['export_csv'])) {
  exportCSV($leads);
}


?>

<?php
require_once('tmp/header.php');
?>
  <main class="content p-5">
    <h1 class="display-5 mb-5">Сохраненные лиды</h1>

    <div class="d-flex justify-content-between align-items-center">
      <form method="post" action="" class="w-50 mb-4 d-flex justify-content-start align-items-end">
        <div class="form-group w-100 me-2">
          <label for="city" class="form-label">Фильтр по городу:</label>
          <select class="form-select" id="city" name="city">
            <option value="">Все города</option>
            <?php foreach ($cities as $key => $value): ?>
              <option value="<?= htmlspecialchars($key) ?>" <?= ($selectedCity == $key) ? 'selected' : '' ?>>
                <?= htmlspecialchars($value) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" name="filter">Фильтровать</button>
      </form>

      <form method="post" action="">
        <input type="hidden" name="city" value="<?= htmlspecialchars($selectedCity) ?>">
        <button type="submit" name="export_csv" class="btn btn-success">Экспортировать в CSV</button>
      </form>
    </div>

    <table class="table table-striped">
      <thead>
      <tr>
        <th>Ф.И.О</th>
        <th>Email</th>
        <th>Телефон</th>
        <th>Город</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($leads as $lead): ?>
        <tr>
          <td><?= htmlspecialchars($lead['name']) ?></td>
          <td><?= htmlspecialchars($lead['email']) ?></td>
          <td><?= htmlspecialchars(formatPhoneTpl($lead['phone'])) ?></td>
          <td><?= htmlspecialchars($lead['city']) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </main>

<?php
require_once('tmp/footer.php');
?>