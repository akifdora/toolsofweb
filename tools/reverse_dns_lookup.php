<?php include "../header.php" ?>

    <h1>REVERSE DNS LOOKUP</h1>
    <form method="post">
        <input type="text" name="ip" placeholder="IP Adresi">
        <input type="submit" value="Sorgula">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ip"])) {
    $ip = $_POST["ip"];
    $domain = gethostbyaddr($ip);

    if ($domain !== $ip) {
        echo '<div style="margin-top: 20px; font-size: 20px;">';
        echo "IP: <strong>$ip</strong><br>";
        echo "Domain: <strong>$domain</strong>";
        echo '</div>';
    } else {
        echo '<div style="margin-top: 20px; font-size: 20px;">';
        echo "Domain adı bulunamadı.";
        echo '</div>';
    }
}
?>

<?php include "../footer.php" ?>
