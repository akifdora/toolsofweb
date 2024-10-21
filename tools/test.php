<?php include "../header.php" ?>

    <h1>JavaScript Security Scanner</h1>
    <form method="post">
        <input type="text" name="url" placeholder="Web Sitesi URL'si (örn. example.com)">
        <input type="submit" value="Tara">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["url"])) {
    $url = $_POST["url"];

    // Protokol ekle (http:// veya https://)
    if (!preg_match("/^https?:\/\//", $url)) {
        $url = "http://" . $url;
    }

    // HTML içeriği al
    $htmlContent = @file_get_contents($url);

    if ($htmlContent === false) {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "<h2>Tarama Sonuçları</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr><th>Test</th><th>Sonuç</th></tr>";
        echo "<tr><td>JavaScript Güvenlik Tarayıcı</td><td><strong>İçerik alınamadı</strong></td></tr>";
        echo '</table></div>';
    } else {
        // JavaScript dosyalarını bul
        preg_match_all('/<script\s+src="([^"]+)"/i', $htmlContent, $matches);
        $jsFiles = $matches[1];

        // HTML tablo başlangıcı
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "<h2>Tarama Sonuçları</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr><th>Test</th><th>Sonuç</th></tr>";

        if (!empty($jsFiles)) {
            foreach ($jsFiles as $jsFile) {
                $jsUrl = $url . '/' . ltrim($jsFile, '/');
                $jsContent = @file_get_contents($jsUrl);

                if ($jsContent !== false) {
                    // Basit güvenlik açıklarını kontrol et (XSS, eval, innerHTML, vb.)
                    $issues = [];
                    if (stripos($jsContent, 'eval') !== false) {
                        $issues[] = 'eval kullanımı';
                    }
                    if (stripos($jsContent, 'innerHTML') !== false) {
                        $issues[] = 'innerHTML kullanımı';
                    }
                    if (stripos($jsContent, 'document.write') !== false) {
                        $issues[] = 'document.write kullanımı';
                    }
                    
                    echo "<tr><td>JavaScript Dosyası: $jsFile</td><td>";
                    echo !empty($issues) ? "<strong>" . implode(", ", $issues) . " ❌</strong>" : "<strong>Yok ✅</strong>";
                    echo "</td></tr>";
                } else {
                    echo "<tr><td>JavaScript Dosyası: $jsFile</td><td><strong>İçerik alınamadı ❌</strong></td></tr>";
                }
            }
        } else {
            echo "<tr><td>JavaScript Dosyası</td><td><strong>Bulunamadı</strong></td></tr>";
        }

        // HTML tablo bitişi
        echo '</table></div>';
    }
}
?>

<?php include "../footer.php" ?>
