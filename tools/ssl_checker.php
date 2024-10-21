<?php include "../header.php" ?>

    <h1>SSL CERTIFICATE CHECKER</h1>
    <form method="post">
        <input type="text" name="domain" placeholder="Domain Adresi">
        <input type="submit" value="Kontrol Et">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["domain"])) {
    $domain = $_POST["domain"];
    $port = 443;
    $timeout = 30;
    $contextOptions = [
        "ssl" => [
            "capture_peer_cert" => true,
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
    ];
    $context = stream_context_create($contextOptions);
    $client = stream_socket_client("ssl://$domain:$port", $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);

    if ($client) {
        $params = stream_context_get_params($client);
        $cert = openssl_x509_parse($params["options"]["ssl"]["peer_certificate"]);

        if ($cert) {
            echo '<div style="margin-top: 20px; font-size: 18px;">';
            echo "Domain: <strong>$domain</strong><br>";
            echo "Sağlayıcı: <strong>" . $cert['issuer']['CN'] . "</strong><br>";
            echo "Başlangıç Tarihi: <strong>" . date('d.m.Y H:i:s', $cert['validFrom_time_t']) . "</strong><br>";
            echo "Bitiş Tarihi: <strong>" . date('d.m.Y H:i:s', $cert['validTo_time_t']) . "</strong><br>";
            echo '</div>';
        } else {
            echo '<div style="margin-top: 20px; font-size: 18px;">';
            echo "SSL sertifikası alınamadı.";
            echo '</div>';
        }
    } else {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "Bağlantı kurulamadı: $errstr ($errno)";
        echo '</div>';
    }
}
?>

<?php include "../footer.php" ?>
