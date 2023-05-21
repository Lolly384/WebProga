<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" />
    <title>Ювелирный магазин</title>
  </head>
  <body>
    <header class="header">
        <a href="index.php" class="header-logo">
          <img src="img/Logo.png" alt="logo">
          <h1>Lёva</h1>
        </a>
      <form method="post" class="header-search" action="search.php">
        <input type="text" name="keyword" placeholder="Введите ключевое слово">
        <button><img src="img/search-svgrepo-com.svg" alt=""></button>
      </form>
      <div class="header-links">
        <img src="img/telegram-svgrepo-com.svg" alt="Telegram">
        <img src="img/VK_icon.svg" alt="VK">
      </div>
    </header>
    <main class="main">
      <div class="main-menu">
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

          // Проверка наличия результатов
          if (mysqli_num_rows($result) > 0) {

            echo "<form class=\"form-sly\" method=\"post\" action=\"filter.php\">";
            echo "<div class=\"main-menu-tip\">";
            // Вывод данных: вывод всех категорий
            echo "<p>Тип изделия</p>";
            echo "<div class=\"line\"></div>";

            // Инициализация счетчика
            $counter = 0;

            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC); // Сохранение всех строк результата в массив
            
            foreach ($rows as $row) {
                echo "<div class=\"main-menu-tip-check\">";
                
                echo "<input type=\"checkbox\" class=\"first\" value=\"" . $row['name'] . "\" name=\"filter[]\">";
                echo "<p>" . $row['name'] . "</p>";
                echo "</div>";

                $counter++;

                if ($counter === 8) {
                    break;
                }
            }

            echo "</div>";
            echo "<div class=\"main-menu-metal\">";
            echo "<p>Цвет металла</p>";
            echo "<div class=\"line\"></div>";

            for ($i = 8; $i < 12; $i++) {
                echo "<div class=\"main-menu-tip-check\">";
                echo "<input type=\"checkbox\" class=\"first\" value=\"" . $rows[$i]['name'] . "\" name=\"filter[]\">";
                echo "<p>" . $rows[$i]['name'] . "</p>";
                echo "</div>";
            }
            echo "</div>";
            echo "<input type=\"submit\" class=\"menu-accept\" value=\"Применить\">";
            echo "</form>";
          }
        ?>
      </div>
      <div class="main-list">
        <?php
          // Выполнение запроса к базе данных
          $sql = "SELECT * FROM products";
          $result = mysqli_query($conn, $sql);
          
          // Проверка наличия результатов
          if (mysqli_num_rows($result) > 0) {
            // Вывод данных каждой строки
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<a href=\"item.php?id=" . $row["id"] . "\">";
                echo "<div id=\"" . $row["id"] . "\" class=\"main-list-elem\">";
                echo "<img src=\"" . $row["image"] . "\" alt=\"" . $row["type"] . "\">";
                echo "<div class=\"main-list-elem-name\">";
                echo "<p>" . $row["name"] . "</p>";
                echo "</div>";
                echo "</div>";
               echo "</a>"; 
            }
          } else {
            echo "0 результатов";
          }
        ?>
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
</html>