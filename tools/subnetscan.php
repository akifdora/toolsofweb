<?php include "../header.php" ?>

    <main>
        <h1>Subnet Scanner</h1>
        <form method="post">
            <input type="text" name="ipadresi" placeholder="IP Adresi">
            <input type="text" name="baslangic" placeholder="Başlangıç Değeri (boş bırakılırsa 1 kabul edilir)">
            <input type="text" name="bitis" placeholder="Bitiş Değeri (boş bırakılırsa 254 kabul edilir)">
            <input type="submit" value="Tara">
        </form>
    </main>

<?php
function scanSubnet($subnet, $start, $end) {
    $ipParts = explode(".", $subnet);
    $ipBase = implode(".", array_slice($ipParts, 0, 3));

    $openIPs = array();

    for ($i = $start; $i <= $end; $i++) {
        $ip = $ipBase . "." . $i;
        $result = @fsockopen($ip, 80, $errno, $errstr, 0.5);

        if ($result) {
            fclose($result);
            $openIPs[] = $ip;
        }
    }

    return $openIPs;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ipadresi"])) {
    $subnet = $_POST['ipadresi'];
    $start = empty($_POST['baslangic']) ? 1 : max(1, min(254, intval($_POST['baslangic'])));
    $end = empty($_POST['bitis']) ? 254 : max(1, min(254, intval($_POST['bitis'])));
    $openIPs = scanSubnet($subnet, $start, $end);
    echo "<table>";
    foreach ($openIPs as $ip) {
        echo "<tr>";
        echo "<td> $ip </td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<?php include "../footer.php" ?>