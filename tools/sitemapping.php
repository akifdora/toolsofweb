<?php include "../header.php" ?>

<main>
    <h1>Site Mapping</h1>
    <form method="post">
        <input type="text" name="domain" placeholder="Domain Adresi">
        <input type="submit" value="Tara">
    </form>
</main>

<?php
function extractLinks($url) {
    $html = file_get_contents($url);
    preg_match_all('/<a\s+href=["\']([^"\']+)["\']/i', $html, $matches);
    return $matches[1];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["domain"])) {
    $domain = $_POST['domain'];
    if (strpos($domain, "http://") !== 0 && strpos($domain, "https://") !== 0) {
        $domain = "http://" . $domain;
    }
    $links = extractLinks($domain);

    echo "<table>";
    foreach ($links as $link) {
        echo "<tr>";
        echo "<td> $link </td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php include "../footer.php" ?>

