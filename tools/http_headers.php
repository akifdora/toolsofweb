<?php include "../header.php" ?>

    <h1>HTTP HEADERS</h1>
    <form method="post">
        <input type="text" name="url" placeholder="Web Sitesi URL'si">
        <input type="submit" value="Göster">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["url"])) {
    $url = $_POST["url"];

    // Protokol ekle (http:// veya https://)
    if (!preg_match("/^https?:\/\//", $url)) {
        $url = "http://" . $url;
    }

    // HTTP başlıklarını al
    $headers = @get_headers($url, 1);

    if ($headers) {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "Web Sitesi: <strong>$url</strong><br>";
        echo 'HTTP Başlıkları:';
        echo '<table border="1" cellpadding="10" cellspacing="0">';
        echo '<tr><th>Başlık</th><th>Değer</th></tr>';

        foreach ($headers as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $subValue) {
                    echo '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($subValue) . '</td></tr>';
                }
            } else {
                echo '<tr><td>' . htmlspecialchars($key) . '</td><td>' . htmlspecialchars($value) . '</td></tr>';
            }
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "Web sitesinin başlık bilgilerine erişilemedi: <strong>$url</strong>";
        echo '</div>';
    }
}
?>

<?php include "../footer.php" ?>
