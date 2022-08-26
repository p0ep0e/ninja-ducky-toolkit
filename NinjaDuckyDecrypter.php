<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/*
NINJA DUCKY V1.0
A collection of scripts designed to exfiltrate data using a HID USB implant sending securely to a remote web server for the purposes of demonstration and security hardening.

Author: Bob McKay
August 2022
GitHub: https://github.com/p0ep0e/ninja-ducky-toolkit
*/

/* -----  Mega Ducky Options ----- */
$decryption_key = "SpaceTonerMango"; //The decryption key, change to your own key - this will need to be added to the encryption script too.
/* ----- End Mega Ducky Options ----- */

function decryptData($ciphertext, $encryptionKey) {
    $plainText = openssl_decrypt($ciphertext, 'aes128', $encryptionKey);
    return $plainText;
}?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ninja Ducky Decrypter</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ninja Ducky Decrypter</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item"><a class="nav-link" href="https://github.com/p0ep0e/ninja-ducky-toolkit">Ninja Ducky GitHub Repo</a></li>
                <li class="nav-item"><a class="nav-link" href="https://bobmckay.com/i-t-support-networking/ethical-hacking/ninja-ducky-tool…via-usb-implants/">About Ninja Ducky</a></li>
                <li class="nav-item"><a class="nav-link" href="https://seguro.ltd" title="Seguro Information & Cyber Security Consulting">Sponsored by Seguro</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container" style="margin-top: 80px">
    <h1>Mr Ducky Decrypter</h1>
    <div class="bg-light p-5 rounded">
    <?php
    if(isset($_POST['decryptionKey'])&&isset($_POST['cipherText'])) {
        echo "<h2>Decrypted Text:</h2>";
        echo decryptData($_POST['cipherText'], $_POST['decryptionKey']);
        echo "<h2>Cipher Text</h2>";
        echo $_POST['cipherText'];

    }else{
    $date = date_create();
    ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?noCache=<?=date_timestamp_get($date)?>" method="post">
            <div class="mb-3">
                <label for="decryptionKey" class="form-label">Decryption Key</label>
                <input type="text" class="form-control" id="decryptionKey" name="decryptionKey" aria-describedby="decryptionKeyHelp">
                <div id="decryptionKeyHelp" class="form-text">The key you set your encryptor script to use for your ducky booty emails.</div>
            </div>
            <div class="mb-3">
                <label for="cipherText" class="form-label">Cipher Text</label>
                <textarea class="form-control" id="cipherText" name="cipherText" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Decrypt</button>
        </form>

    <?
    }
    ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
