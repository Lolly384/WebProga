<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/filter.css" />
    <title>Ювелирный магазин</title>
  </head>
  <body>
    <header class="header">
        <div class="header-logo">
            <a href="index.php" class="header-logo">
              <img src="img/Logo.png" alt="logo">
              <h1>Lёva</h1>
            </a>
          </div>
          <div class="header-search">
            <input type="text">
            <button><img src="img/search-svgrepo-com.svg" alt=""></button>
          </div>
          <div class="header-links">
            <img src="img/telegram-svgrepo-com.svg" alt="Telegram">
            <img src="img/VK_icon.svg" alt="VK">
          </div>
      
    </header>
    <main>
        <div class="main-menu">
          <div class="main-list">
          <?php
            // Подключение к базе данных
            $servername = "PHPProdject";
            $username = "root";
            $password = "";
            $dbname = "jewelry_catalog";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Проверка соединения
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            // Выполнение запроса к базе данных
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);

           // Проверка, был ли отправлен поисковый запрос
            if (isset($_POST['keyword'])) {
              // Получение ключевого слова из формы
              $keyword = $_POST['keyword'];

              // SQL-запрос для поиска предметов по ключевому слову
              $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%'";
              $result = $conn->query($sql);

              $displayedItems = array(); // Массив для хранения уже выведенных предметов

              if ($result->num_rows > 0) {
                  // Есть продукты, соответствующие фильтру
                  while ($row = $result->fetch_assoc()) {
                      if (!in_array($row['id'], $displayedItems)) {
                          echo "<div id=\"" . $row["id"] . "\" class=\"main-list-elem\">";
                          echo "<img src=\"" . $row["image"] . "\" alt=\"" . $row["type"] . "\">";
                          echo "<div class=\"main-list-elem-name\">";
                          echo "<p>" . $row["name"] . "</p>";
                          echo "<img src=\"img/heart-svgrepo-false.svg\" alt=\"Like\">";
                          echo "</div>";
                          echo "</div>";

                          $displayedItems[] = $row['id'];
                      }
                  }
              } else {
                  // Нет продуктов, соответствующих фильтру
                  echo "Нет продуктов, соответствующих фильтру.";
              }
            }
            ?>

            <!-- <div class="main-list-elem">
              <img src="img/earrings-svgrepo-com.png" alt="Серьги">
              <div class="main-list-elem-name">
                <p>Название</p>
                <img src="img/heart-svgrepo-false.svg" alt="">
              </div>
            </div> -->

          </div>
        </div>
    </main>
    <footer class="footer">
        <p>+7 - 000 - 000 - 00 - 00</p>
        <p>O Компании</p>
        <div class="footer-icon">
          <img class="AppStore" src="img/appStore.svg" alt="App Store">
          <img  class="googlePlay" src="img/icons8-google-play.svg" alt="Google Play">
        </div>
      </footer>
  </body>