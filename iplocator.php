<?php include "header.php" ?>

<h1>IP Locator</h1>
<form method="post">
    <input type="text" name="ip" placeholder="IP Adresi">
    <input type="submit" value="Ara">
</form>

<?php
function getIPInfo($ip) {
    $url = "http://ip-api.com/json/" . $ip;

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ip"])) {
    $ip = $_POST["ip"];
    $ipInfo = getIPInfo($ip);
    if ($ipInfo["status"] == "success") {
        echo "<table>";
        echo "<tr><td>IP Adresi</td><td>" . $ipInfo["query"] . "</td></tr>";
        echo "<tr><td>Ülke</td><td>" . $ipInfo["country"] . "</td></tr>";
        echo "<tr><td>Şehir</td><td>" . $ipInfo["city"] . "</td></tr>";
        echo "<tr><td>Posta Kodu</td><td>" . $ipInfo["zip"] . "</td></tr>";
        echo "<tr><td>Koordinatlar</td><td>" . $ipInfo["lat"] . ", " . $ipInfo["lon"] . "</td></tr>";
        $googleMapsLink = "https://www.google.com/maps/place/" . $ipInfo["lat"] . "," . $ipInfo["lon"];
        echo "<tr><td>Google Haritalar</td><td><a href=\"$googleMapsLink\" target=\"_blank\">Görüntüle</a></td></tr>";
        echo "</table>";
    } else {
        echo "IP adresi bilgileri alınamadı.";
    }
}
?>

<?php include "footer.php" ?>
