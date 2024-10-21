<?php include "../header.php" ?>

<h1>SUBDOMAIN SCAN</h1>
<p>Bu işlem internet hızınıza bağlı olarak değişiklik gösterebilir, ortalama 30 saniye sürmektedir.</p>
<form method="post">
    <input type="text" name="domain" placeholder="Domain Adresi">
    <input type="submit" value="Dönüştür">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["domain"])) {
    $targetDomain = $_POST["domain"];
    $subdomainsFile = "assets/subdomains.txt";

    if (!file_exists($subdomainsFile)) {
        die("subdomains.txt dosyası bulunamadı.");
    }

    $subdomains = file($subdomainsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $foundSubdomains = array();

    echo "<table>";
    foreach ($subdomains as $subdomain) {
        $fullSubdomain = $subdomain . "." . $targetDomain;
        $ip = gethostbyname($fullSubdomain);

        if ($ip !== $fullSubdomain) {
            $foundSubdomains[] = $fullSubdomain;
            echo "<tr>";
            echo "<td><a href='http://" . $fullSubdomain . "'>" . $fullSubdomain . "</a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";

    if (count($foundSubdomains) === 0) {
        echo "<p>Hiçbir alt alan adı bulunamadı.</p>";
    }
}
?>

<?php include "../footer.php" ?>