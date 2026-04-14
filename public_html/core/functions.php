<?php

function qrEquipment($inv) {

    $baseUrl = "http://p905091w.beget.tech/index.php?page=equipment";

    $inv = trim($inv);

    if ($inv === '') {
        return '';
    }

    // ВАЖНО: используем &
    $url = $baseUrl . "&inv=" . urlencode($inv);

    return "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($url);
}
