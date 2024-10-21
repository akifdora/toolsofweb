<?php include "../header.php" ?>

    <h1>DOMAIN TO IP</h1>
    <form method="post">
        <input type="text" name="domain" placeholder="Domain Adresi">
        <input type="submit" value="Dönüştür">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["domain"])) {
    $domain = $_POST["domain"];
    $ip = gethostbyname($domain);

    if ($ip !== $domain) {
        echo '<div style="margin-top: 20px; font-size: 20px;">';
        echo "Domain: <strong>$domain</strong><br>";
        echo "IP: <strong>$ip</strong>";
        echo '</div>';
    } else {
        echo '<div style="margin-top: 20px; font-size: 20px;">';
        echo "IP adresi alınamadı.";
        echo '</div>';
    }
}
?>

<?php include "../footer.php" ?>