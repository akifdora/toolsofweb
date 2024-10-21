<?php include "../header.php" ?>

    <h1>DNS RECORD LOOKUP</h1>
    <form method="post">
        <input type="text" name="domain" placeholder="Domain Adresi">
        <input type="submit" value="Sorgula">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["domain"])) {
    $domain = $_POST["domain"];
    $dnsRecords = dns_get_record($domain, DNS_ALL);

    if ($dnsRecords) {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "Domain: <strong>$domain</strong><br>";
        echo "DNS Kayıtları:<br>";

        echo '<table border="1" cellpadding="10" cellspacing="0">';
        echo '<tr><th>Tip</th><th>Host</th><th>Target/IP/Value</th><th>Priority</th></tr>';

        foreach ($dnsRecords as $record) {
            echo '<tr>';
            echo '<td>' . $record['type'] . '</td>';

            if (isset($record['host'])) {
                echo '<td>' . $record['host'] . '</td>';
            } else {
                echo '<td>-</td>';
            }

            if (isset($record['target'])) {
                echo '<td>' . $record['target'] . '</td>';
            } elseif (isset($record['ip'])) {
                echo '<td>' . $record['ip'] . '</td>';
            } elseif (isset($record['ipv6'])) {
                echo '<td>' . $record['ipv6'] . '</td>';
            } elseif (isset($record['txt'])) {
                echo '<td>' . $record['txt'] . '</td>';
            } else {
                echo '<td>-</td>';
            }

            if (isset($record['pri'])) {
                echo '<td>' . $record['pri'] . '</td>';
            } else {
                echo '<td>-</td>';
            }

            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    } else {
        echo '<div style="margin-top: 20px; font-size: 18px;">';
        echo "DNS kayıtları bulunamadı.";
        echo '</div>';
    }
}
?>

<?php include "../footer.php" ?>
