<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/item-style.css" />
    <?php
      if (isset($_GET['id'])) {
        $item_id = $_GET['id'];
    
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
        // Подготовленный SQL-запрос с использованием параметров
        $sql = "SELECT * FROM products WHERE id = $item_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // Продукт найден
          $product = $result->fetch_assoc();
          echo "<title>" . $product['name'] . "</title>";
        }
        
      } else {
        // ID предмета не указан
        echo "ID предмета не указан.";
      }
     
    ?>
  </head>
  <body class="body">
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
    <main class="main">
      <?php
      // Проверка наличия результатов
      if ($result->num_rows > 0) {
        
        echo "<div class=\"main-item\">";
        echo "<img src=\"" . $product["image"] . "\" alt=\"" . $product["type"] . "\">";
        echo "<div class=\"main-item-description\">";
        echo "   <h1>" . $product['name'] . "</h1>";
        echo "    <p>тип изделия: " . $product['type'] . "</p>";
        echo "    <p>цвет металла: " . $product['metal_color'] . "</p>";
        echo "    <div class=\"main-item-description-all\">";
        echo "        <h1>Описание</h1>";
        echo "        <p>" . $product['description'] . "</p>";
        echo "    </div>";
        echo "</div>" ;
        echo "</div>";
      }
      ?>
       
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

