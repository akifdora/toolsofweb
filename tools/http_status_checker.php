<?php include "../header.php" ?>

    <h1>HTTP STATUS CHECKER</h1>
    <form method="post">
        <input type="text" name="url" placeholder="Web Sitesi URL'si">
        <input type="submit" value="Kontrol Et">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["url"])) {
    $url = $_POST["url"];

    // Protokol ekle (http:// veya https://)
    if (!preg_match("/^https?:\/\//", $url)) {
        $url = "http://" . $url;
    }

    // HTTP başlıklarını al
    $headers = @get_headers($url);

    if ($headers) {
        // İlk başlık, durum kodunu içerir
        $statusLine = $headers[0];
        preg_match('/HTTP\/\S+ (\d{3})/', $statusLine, $matches);

        if (isset($matches[1])) {
            $statusCode = $matches[1];
            echo '<div style="margin-top: 20px; font-size: 18px;">';
            echo "Web Sitesi: <strong>$url</strong><br>";
            echo "Durum Kodu: <strong>$statusCode</strong><br>";
            echo "Durum Açıklaması: ";

            // Durum koduna açıklama ekle
            switch ($statusCode) {
                case 200:
                    echo "OK";
                    break;
                case 301:
                    echo "Moved Permanently";
                    break;
                case 302:
                    echo "Found";
                    break;
                case 400:
                    echo "Bad Request";
                    break;
                case 401:
                    echo "Unauthorized";
                    break;
                case 403:
                    echo "Forbidden";
                    break;
                case 404:
                    echo "Not Found";
                    break;
                case 500:
                    echo "Internal Server Error";
                    break;
                case 502:
                    echo "Bad Gateway";
                    break;
                case 503:
                    echo "Service Unavailable";
                    break;
                default:
                    echo "Bilinmeyen Durum Kodu";
                    break;
            }

            echo '</div>';
        } else {
            echo '<div style="margin-top: 20px; font-size: 18px;">';
            echo "Durum kodu tespit edilemedi: <strong>$url</strong>";
            echo '</div>';
        }
    } else {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "Web sitesine erişilemedi: <strong>$url</strong>";
        echo '</div>';
    }
}
?>

<?php include "../footer.php" ?>
