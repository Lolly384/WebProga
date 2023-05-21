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

    // Проверка, был ли отправлен поисковый запрос
      if (isset($_POST['keyword'])) {
        // Получение ключевого слова из формы
        $keyword = $_POST['keyword'];

        // SQL-запрос для поиска предметов по ключевому слову
        $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%' OR metal_color LIKE '%$keyword%'";
        $result = $conn->query($sql);

        $displayedItems = array(); // Массив для хранения уже выведенных предметов
        echo "<title>Поиск: " . $keyword . "</title>";
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
            // Проверка, был ли отправлен поисковый запрос
            if (isset($_POST['keyword'])) {
              $keyword = $_POST['keyword'];
              if($keyword !== ""){
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
                      }
                  }
                } 
              }else{
                echo "<h1>Пустая поисковая строка</h1>";
              }
            }else {
              // Нет продуктов, соответствующих фильтру
              echo "Нет продуктов, соответствующих фильтру.";
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