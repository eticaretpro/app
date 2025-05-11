<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dosya Görüntüleme</title>

    <!-- CSS ile max-height ve kaydırma için stil ekledik -->
    <style>
        p.file-content {
            overflow-y: auto;  /* İçerik fazla olduğunda kaydırma çubuğu ekler */
            white-space: pre-wrap; /* Satır sonlarını korur */
            font-family: monospace; /* Kod gibi görünmesi için monospace fontu */
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ccc;
        }

        /* Buton stil */
        #download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        #download-btn:hover {
            background-color: #45a049;
        }
    </style>

</head>
<body>

<?php
function listFilesAndFolders($dir, $parentDir = '') {
    // Gizlenecek dizinler
    $hiddenDirs = ['xml', 'landing', 'map'];
    
    // Gizlenecek dosya adları
    $hiddenFiles = ['.DS_Store', '.htaccess'];

    // Gizlenecek dosya uzantıları
    $hiddenExtensions = ['svg', 'txt', 'log', 'mmdb']; // .mmdb dosyasını da gizle

    // Dizindeki dosya ve klasörleri al
    $files = scandir($dir);

    // Klasörleri ve dosyaları ayır
    $dirs = [];
    $normalFiles = [];

    foreach ($files as $file) {
        // . ve ..'yi geç
        if ($file == '.' || $file == '..') {
            continue;
        }

        // Dosya yolu
        $path = $dir . '/' . $file;

        // Eğer dosya bir dizinse ve gizlenmesi gereken dizinlerden biri değilse
        if (is_dir($path) && !in_array($file, $hiddenDirs)) {
            // Klasörün içinde dosya veya alt klasör olup olmadığını kontrol et
            $innerFiles = scandir($path);
            // Eğer klasör boşsa, atla (sadece . ve .. varsa)
            if (count($innerFiles) > 2) { // Boş klasörlerde sadece . ve .. vardır
                $dirs[] = $file;
            }
        } elseif (!is_dir($path) && !in_array($file, $hiddenFiles)) {
            // Dosyanın uzantısını al
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            
            // Eğer dosya uzantısı gizlenmesi gerekenlerden biriyse, atla
            if (in_array(strtolower($fileExtension), $hiddenExtensions)) {
                continue;
            }
            
            // Eğer dosya ise ve gizlenmesi gereken dosya değilse, dosyalara ekle
            $normalFiles[] = $file;
        }
    }

    // Klasörleri sıralayıp listele
    sort($dirs);
    echo '<ul>';
    foreach ($dirs as $dirItem) {
        echo '<li><strong>' . $dirItem . '</strong>';
        listFilesAndFolders($dir . '/' . $dirItem, $parentDir . $dirItem . ' > '); // Rekürsif çağrı
        echo '</li>';
    }

    // Dosyaları sıralayıp listele
    sort($normalFiles);
    foreach ($normalFiles as $file) {
        echo '<li>';
        
        // Dosya yolu ve ismini birleştir
        $fullPath = $parentDir . $file;
        echo '<strong>' . $fullPath . '</strong>';  // Dosya yolu ve ismini yazdır

        // Dosya içeriğini dosya adı altında hemen göster
        $filePath = $dir . '/' . $file;
        if (file_exists($filePath)) {
            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
            
            // Eğer dosya uzantısı .mmdb ise, içeriği okumadan geç
            if (strtolower($fileExtension) == 'mmdb') {
                echo '<p>Bu dosya okunamaz.</p>';
            } else {
                // Diğer dosyaların içeriğini göster
                $fileContent = file_get_contents($filePath);
                echo '<p class="file-content">';
                echo htmlspecialchars($fileContent); // Dosya içeriğini burada kod olarak göstermek için
                echo '</p>';
            }
        }
        echo '</li>';
    }
    echo '</ul>';
}

if (isset($_GET['file'])) {
    $filePath = $_GET['file'];
    if (file_exists($filePath)) {
        echo '<pre>';
        echo htmlspecialchars(file_get_contents($filePath)); // Dosya içeriğini göster
        echo '</pre>';
    } else {
        echo 'Dosya bulunamadı.';
    }
} else {
    // Klasör yolunu belirtin
    $dir = '/home/app.eticaret.pro/public_html/'; // Kendi klasör yolunuzu buraya yazın

    // Dizini ve içeriğini listele
    listFilesAndFolders($dir);
}
?>



</body>
</html>
