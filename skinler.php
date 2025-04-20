<?php

$skinler = file_get_contents("skinler.txt");

preg_match_all('/\[\s*(\d+)\s*\]\s*([^[]+)/', $skinler, $ciktilar);

$skinler_arr = [];
foreach ($ciktilar[1] as $index => $key) {
    $skinler_arr[$key] = trim($ciktilar[2][$index]);
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Levent Emre PAÇAL">
    <title>Prooyun Skin Listesi</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="icon" href="favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container mt-3">
        <div style="text-align:center;">
            <h2>Skin Listesi</h2>
        </div>
        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Oyun içerisinde skin nasıl uygulanır?</h4>
            <p>Tablo üzerinden arama yaparak almak istediğiniz skini seçiniz örnek olarak <strong>Çıngıraklı Yılan</strong> skinini arattık ve id değerinin <strong>199</strong> olduğunu bulduk. Bunu oyun üzerinde almak için chat üzerinden <strong><code>!ws awp 199</code></strong> yazmamız gerek bu şekilde yazarak awp silahına 199 idli skini uygulamış olacağız.</p>
            <hr>
            <h4 class="alert-heading">Skin uygulama yolları</h4>
            <ul class="list-unstyled">
                <li>Tablodan istediğiniz skini bulup <strong><i class="fa fa-copy"></i> Chat kodunu kopyala</strong> yazısına tıklayın ve oyundaki chate kopyalanan komutu yapıştırın</li>
                <li>Chat üzerinden <code>!ws awp 199</code> yazarak "awp" silahını belirterek uygulayın</li>
                <li>Silah elinizdeyken <code>!ws 199</code> yazarak elinizdeki silaha uygulayın</li>
            </ul>
        </div>

        <table id="skinlerTablo" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Skin ID</th>
                    <th>Chat Komutu</th>
                    <th style="width: 50%;">Skin Adı</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($skinler_arr as $skinid => $skinadi) {
                    echo '<tr>
                    <td>' . $skinid . '</td>
                    <td><button onclick="komutKopyala(' . $skinid . ', this)" class="btn btn-primary btn-sm"><i class="fa fa-copy"></i> Chat kodunu kopyala</button></td>
                    <td>' . $skinadi . '</td>
                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#skinlerTablo').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json"
                }
            });
        });

        function komutKopyala(skinid, button) {

            navigator.clipboard.writeText('!ws ' + skinid)
                .then(() => {
                    $(button).prop("disabled", true);
                    $(button).html('<i class="fa fa-check"></i> Kopyalandı');

                    setTimeout(() => {
                        $(button).html('<i class="fa fa-copy"></i> Chat kodunu kopyala');
                        $(button).prop("disabled", false);
                    }, 500);
                })
                .catch(err => {
                    console.error('Kopyalama işlemi başarısız:', err);
                });
        }
    </script>
</body>

</html>
