<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "nama" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $noser = isset($_POST['no_sertifikat']) ? $_POST['no_sertifikat'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $ttd = isset($_POST['ttd']) ? $_POST['ttd'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO karyawan (id, nama, no_sertifikat, deskripsi, tanggal, ttd) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $noser, $deskripsi, $tanggal, $ttd]);

    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2>Create Contact</h2>
    <form action="create.php" method="post">
        <!-- <label for="id">ID</label> -->
        <input type="text" name="id" value="auto" id="id" hidden>
        
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        
        <label for="no_sertifikat">Nomor Sertifikat</label>
        <input type="text" name="no_sertifikat" id="no_sertifikat">
        
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" style="width: 400px; height: 200px;"></textarea>
        
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal">

        <label for="ttd">Penanda Tangan</label>
        <input type="text" name="ttd" id="ttd">
        
        <input type="submit" value="Create">
    </form>
    
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
