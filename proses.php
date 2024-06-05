<!-- <?php
// Memuat dan menciptakan gambar
$gambar = imagecreatefromjpeg('gambar/pexels-photo-192651.jpeg');
// Mengalokasikan warna untuk teks, masukkan nilai RGB
$warna_putih = imagecolorallocate($gambar, 255, 255, 255);
// Menetapkan file path font
$font_path = 'font/DK Lemon Yellow Sun.otf';
// Mendapatkan isi teks dari input form untuk dicetak ke gambar
$isiteks = $_POST["isiteks"];
$ukuran=40;
$angle=0;
$kiri=220;
$atas=200;
// Cetak teks ke gambar
imagettftext($gambar, $ukuran,$angle,$kiri,$atas, $warna_putih, $font_path, $isiteks);
// Simpan Gambar ke File
imagejpeg($gambar, 'hasilnya.jpg');
// Membersihkan Memory
imagedestroy($gambar);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Gambar</title>
</head>
<body>
    <h1>Hasil Gambar</h1>
    <img src="hasilnya.jpg" alt="Hasil Gambar">
</body>
</html> -->
