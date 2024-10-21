<?php include "../header.php" ?>

    <h1>Port Scanner</h1>
    <form method="post">
        <input type="text" name="domain" placeholder="Domain Adresi">
        <input type="submit" value="Tara">
    </form>

    <?php
    function scanPorts($domain, $ports) {
        $results = array();
        foreach ($ports as $port) {
            $service = getservbyport($port, "tcp");
            $connection = @fsockopen($domain, $port, $errorNumber, $errorString, 1);
            if (is_resource($connection)) {
                $results[] = array(
                    'port' => $port,
                    'service' => getPortDescription($port),
                    'status' => "✅"
                );
                fclose($connection);
            } else {
                $results[] = array(
                    'port' => $port,
                    'service' => getPortDescription($port),
                    'status' => "❌"
                );
            }
        }
        return $results;
    }

    function getPortDescription($port) {
        switch ($port) {
            case 21:
                return "FTP";
            case 25:
                return "SMTP";
            case 80:
            case 81:
                return "HTTP";
            case 110:
                return "POP3";
            case 143:
                return "IMAP";
            case 443:
                return "HTTPS";
            case 587:
                return "SMTP (TLS)";
            case 2525:
                return "SMTP (Alternate)";
            case 3306:
                return "MySQL";
            default:
                return "Bilinmiyor";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["domain"])) {
        $domain = $_POST["domain"];
        $ports = array(21, 25, 80, 81, 110, 143, 443, 587, 2525, 3306);

        $scanResults = scanPorts($domain, $ports);

        echo "<h2>Scan Results:</h2>";
        echo "<table>";
        echo "<tr><th>Port</th><th>Service</th><th>Status</th></tr>";
        foreach ($scanResults as $result) {
            echo "<tr>";
            echo "<td>{$result['port']}</td>";
            echo "<td>{$result['service']}</td>";
            echo "<td>{$result['status']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>

<?php include "../footer.php" ?>
