<?php
// Nyalakan output buffering
ob_start();

require("fpdf/fpdf.php");

// Tentukan jalur ke file font
$font = "C:/xampp/htdocs/ecertificate/calibri_regular.ttf";

// Hubungkan ke basis data MySQL Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecertifikat";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tentukan query untuk mengambil data dari basis data
$sql = "SELECT * FROM karyawan WHERE id = {$_GET['id']}"; // Sesuaikan nama_tabel dan kolom dengan struktur basis data Anda

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ambil data dari hasil set
    while ($row = $result->fetch_assoc()) {
        // Data yang ingin Anda cetak pada sertifikat
        $name = $row["nama"];
        $noser = "No/Sertif/".$row["no_sertifikat"];
        $deskripsi = $row["deskripsi"];
        $tanggal = "Jakarta, " . date("d-m-Y", strtotime($row["tanggal"]));
        $ttd = $row["ttd"];
    }
} else {
    echo "0 hasil";
}

// Buat instansi PDF baru
$pdf = new FPDF('P', 'mm', 'A4');

// Tambahkan halaman ke PDF (mode potrait, ukuran A4)
$pdf->AddPage();

// Muat gambar sertifikat
$certificateImage = imagecreatefromjpeg("sertifikat.jpg");

// Muat gambar logo
$logoImage = imagecreatefromjpeg("logo.jpg");
$stampImage = imagecreatefromjpeg("stamp.jpg");

// Tetapkan warna teks
$color = imagecolorallocate($certificateImage, 19, 21, 22);

// Fungsi untuk menghitung lebar teks dan menyesuaikan posisinya agar berada di tengah
function centerText($image, $font_size, $text, $font, $color, $y) {
    $bbox = imagettfbbox($font_size, 0, $font, $text);
    $textWidth = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $textWidth) / 2;
    imagettftext($image, $font_size, 0, $x, $y, $color, $font, $text);
}

// Tambahkan teks ke gambar sertifikat
centerText($certificateImage, 30, $noser, $font, $color, 290);
centerText($certificateImage, 60, "SERTIFIKAT", $font, $color, 250);
centerText($certificateImage, 40, "DIBERIKAN KEPADA", $font, $color, 400);
centerText($certificateImage, 60, $name, $font, $color, 550);
centerText($certificateImage, 35, $deskripsi, $font, $color, 750);
centerText($certificateImage, 30, $tanggal, $font, $color, 920);
centerText($certificateImage, 30, $ttd, $font, $color, 1150);
centerText($certificateImage, 30, "KOMISARIS", $font, $color, 1200);

// Ubah ukuran gambar logo untuk cocok dalam ukuran tertentu
$logoWidth = 250; // Lebar logo yang diinginkan
$logoHeight = 100; // Tinggi logo yang diinginkan
$resizedLogo = imagecreatetruecolor($logoWidth, $logoHeight);
imagecopyresized($resizedLogo, $logoImage, 0, 0, 0, 0, $logoWidth, $logoHeight, imagesx($logoImage), imagesy($logoImage));

// Gabungkan logo yang diubah ukurannya dengan gambar sertifikat
imagecopy($certificateImage, $resizedLogo, 850, 50, 0, 0, $logoWidth, $logoHeight);

// Ubah ukuran gambar stempel untuk cocok dalam ukuran tertentu
$stampWidth = 200; // Lebar stempel yang diinginkan
$stampHeight = 100; // Tinggi stempel yang diinginkan
$resizedStamp = imagecreatetruecolor($stampWidth, $stampHeight);
imagecopyresized($resizedStamp, $stampImage, 0, 0, 0, 0, $stampWidth, $stampHeight, imagesx($stampImage), imagesy($stampImage));

// Gabungkan stempel yang diubah ukurannya dengan gambar sertifikat
imagecopy($certificateImage, $resizedStamp, 900, 950, 0, 0, $stampWidth, $stampHeight);

// Tentukan jalur lengkap ke direktori
$dir = $_SERVER['DOCUMENT_ROOT'] . "/ecertificate/download-certificate/";

// Pastikan direktori ada
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

// Tentukan jalur lengkap ke file gambar
$imageFilename = $dir . "{$time}.jpg";

// Simpan gambar yang sudah diubah
if (!imagejpeg($certificateImage, $imageFilename)) {
    die('Gagal menyimpan gambar');
}

// Sematkan gambar ke dalam PDF
$pdf->Image($imageFilename, 0, 0, 210);

// Bersihkan output buffer
ob_end_clean();

// Keluarkan PDF
$pdf->Output();
?>
