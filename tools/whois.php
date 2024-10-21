<?php include "../header.php" ?>

    <h1>WHOIS</h1>
    <form method="post">
        <input type="text" name="domain" placeholder="Domain Adresi">
        <input type="submit" value="Ara">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["domain"])) {
        $domain = $_POST["domain"];
        $whois_server = "whois.verisign-grs.com";
        $socket = fsockopen($whois_server, 43);

        if ($socket) {
            fwrite($socket, $domain . "\r\n");
            $response = "";
            while (!feof($socket)) {
                $response .= fgets($socket, 128);
            }
            fclose($socket);

            echo '<textarea>' . htmlspecialchars($response) . '</textarea>'; // Çıktıyı metin kutusuna bastırma
        } else {
            echo "WHOIS sunucusuna bağlanırken hata oluştu.";
        }
    }
    ?>

<?php include "../footer.php" ?>