<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/filter.css" />
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

      // Проверка, были ли отправлены флажки формы
      if (isset($_POST['filter'])) {
        // Получение выбранных значений флажков
        $filters = $_POST['filter'];

        // Подготовка списка значений для SQL-запроса
        $filter_values = implode("', '", $filters);

        // SQL-запрос с использованием фильтров
        $sql = "SELECT DISTINCT * FROM products WHERE type IN ('$filter_values') OR metal_color IN ('$filter_values')";
        $result = $conn->query($sql);

        $displayedItems = array(); // Массив для хранения уже выведенных предметов
        echo "<title>";
        foreach ($filters as $filt) {
         echo $filt . "/"; 
        }
        echo "</title>";
      }
    ?>
  </head>
  <body>
    <header class="header">
        <div class="header-logo">
          <a href="index.php" class="header-logo">
            <img src="img/Logo.png" alt="logo">
            <h1>Lёva</h1>
          </a>
        </div>
        <form method="post" class="header-search" action="search.php">
          <input type="text" name="keyword" placeholder="Введите ключевое слово">
          <button><img src="img/search-svgrepo-com.svg" alt=""></button>
        </form>
        <div class="header-links">
          <img src="img/telegram-svgrepo-com.svg" alt="Telegram">
          <img src="img/VK_icon.svg" alt="VK">
        </div>
    </header>
    <main>
        <div class="main-menu">
          <div class="main-list">
          <?php
            // Проверка, были ли отправлены флажки формы
            if (isset($_POST['filter'])) {
              if ($result->num_rows > 0) {
                // Есть продукты, соответствующие фильтру
                while ($row = $result->fetch_assoc()) {
                  if (!in_array($row['id'], $displayedItems)) {
                    echo "<a href=\"item.php?id=" . $row["id"] . "\">";
                    echo "<div id=\"" . $row["id"] . "\" class=\"main-list-elem\">";
                    echo "<img src=\"" . $row["image"] . "\" alt=\"" . $row["type"] . "\">";
                    echo "<div class=\"main-list-elem-name\">";
                    echo "<p>" . $row["name"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                  echo "</a>"; 

                      $displayedItems[] = $row['id'];
                  }else{
                    echo "<h1>Не указан фильтр</h1>";
                  }
                }
              } else {
                  // Нет продуктов, соответствующих фильтру
                  echo "Нет продуктов, соответствующих фильтру.";
              }
            }else {
                echo "<h1>Не выбран не один фильтр</h1>";
            }
          ?>
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