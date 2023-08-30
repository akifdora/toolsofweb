<?php include "header.php" ?>

    <h1>Pass Checker</h1>
    <form method="post">
        <input type="text" name="metin" placeholder="Kontrol edilecek şifre">
        <select id="veritabani" name="veritabani">
            <option>Kullanılacak veritabanı</option>
            <option value="rockyou">rockyou.txt</option>
            <option value="pwnedpasswords">pwnedpasswords</option>
        </select>
        <input type="submit" value="Kontrol Et">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aranacakSifre = $_POST["metin"];
    $veritabani = $_POST["veritabani"];

    function checkRockYou($password) {
        $dosyaAdi = "./assets/rockyou.txt";

        if (file_exists($dosyaAdi)) {
            $aranacakMetin = $_POST["metin"];
            $dosya = fopen($dosyaAdi, "r");

            while (!feof($dosya)) {
                $satir = fgets($dosya);
                if (trim($satir) == $aranacakMetin) {
                    return true;
                    fclose($dosya);
                    exit;
                }
            }
            fclose($dosya);
            return false;
        }
    }

    function checkPwnedPasswords($password) {
        $hash = strtoupper(sha1($password));
        $prefix = substr($hash, 0, 5);
        $suffix = substr($hash, 5);

        $url = "https://api.pwnedpasswords.com/range/" . $prefix;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $lines = explode("\n", $response);
        foreach ($lines as $line) {
            list($suffixFromAPI, $count) = explode(":", $line);
            if ($suffixFromAPI === $suffix) {
                return intval($count);
            }
        }

        return 0;
    }

    if ($veritabani == "rockyou") {
        if (checkRockYou($aranacakSifre)) {
            echo "Bu şifre rockyou veritabanında bulundu!";
        } else {
            echo "Bu şifre rockyou veritabanında bulunamadı.";
        }
    } elseif ($veritabani == "pwnedpasswords") {
        if (checkPwnedPasswords($aranacakSifre)) {
            echo "Bu şifre pwnedpasswords veritabanında bulundu!";
        } else {
            echo "Bu şifre pwnedpasswords veritabanında bulunamadı.";
        }
    }
}
?>


<?php include "footer.php" ?>