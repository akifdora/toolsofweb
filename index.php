<!DOCTYPE html>
<html>
<head>
    <title>Tools Of Web</title>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php"><strong>Ana Sayfa</strong></a></li>
        </ul>
    </nav>
</header>

<main>
    <h1>Tools Of Web</h1>
        <table style='width: auto;'>
            <tr>
                <th>Araç Adı</th>
                <th>Açıklaması</th>
            </tr>
            <tr>
                <td><a href="tools/domain_to_ip.php">DomainToIP</a></td>
                <td>Girilen domainin IP adresini bulur</td>
            </tr>
            <tr>
                <td><a href="tools/iplocator.php">IP Locator</a></td>
                <td>Girilen IP adresi hakkında bilgileri verir</td>
            </tr>
            <tr>
                <td><a href="tools/passchecker.php">PassChecker</a></td>
                <td>Girilen şifreyi iki farklı veritabanında kontrol eder</td>
            </tr>
            <tr>
                <td><a href="tools/portscan.php">PortScan</a></td>
                <td>Girilen domainin açık/kapalı (belirli) portlarını listeler</td>
            </tr>
            <tr>
                <td><a href="tools/sitemapping.php">SiteMapping</a></td>
                <td>Girilen domain adresinin haritasını çıkartır</td>
            </tr>
            <tr>
                <td><a href="tools/subdomainscan.php">SubdomainScan</a></td>
                <td>Girilen domain adresindeki subdomainleri tarar</td>
            </tr>
            <tr>
                <td><a href="tools/subnetscan.php">SubnetScan</a></td>
                <td>Girilen IP adresinde belirlediğiniz aralıktaki açık olan IP'leri listeler</td>
            </tr>
            <tr>
                <td><a href="tools/whois.php">WhoIS</a></td>
                <td>Girilen domainin detaylı bilgilerini verir</td>
            </tr>
            <tr>
                <td><a href="tools/reverse_dns_lookup.php">ReverseDnsLookup</a></td>
                <td>Girilen IP'nin hangi domaine ait olduğunu gösterir</td>
            </tr>
            <tr>
                <td><a href="tools/ssl_checker.php">SSLChecker</a></td>
                <td>Girilen domainin SSL'ini kontrol eder</td>
            </tr>
            <tr>
                <td><a href="tools/dns_record_lookup.php">DNSRecordLookup</a></td>
                <td>Girilen domainin DNS kayıtlarını listeler</td>
            </tr>
            <tr>
                <td><a href="tools/http_headers.php">HTTPHeaders</a></td>
                <td>Girilen domainin HTTP Headerlarını listeler</td>
            </tr>
            <tr>
                <td><a href="tools/http_status_checker.php">HTTPStatusChecker</a></td>
                <td>Girilen domainin HTTP durumunu kontrol eder</td>
            </tr>
            <tr>
                <td><a href="tools/vulnerability_scanner.php">VulnerabilityScanner</a></td>
                <td>Girilen web sitesindeki potansiyel güvenlik açıklarını tarar</td>
            </tr>
        </table>
</main>

<?php include "footer.php" ?>