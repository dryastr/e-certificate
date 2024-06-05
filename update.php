<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $noser = isset($_POST['no_sertifikat']) ? $_POST['no_sertifikat'] : '';
        $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
        $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
        $ttd = isset($_POST['ttd']) ? $_POST['ttd'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE karyawan SET id = ?, nama = ?, no_sertifikat = ?, deskripsi = ?, tanggal = ?, ttd = ? WHERE id = ?');
        $stmt->execute([$id, $nama, $noser, $deskripsi, $tanggal, $ttd, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM karyawan WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id" readonly>

        <label for="nama">Nama</label>
        <input type="text" name="nama" value="<?=$contact['nama']?>" id="nama">
        
        <label for="no_sertifikat">Nomor Sertifikat</label>
        <input type="text" name="no_sertifikat" value="<?=$contact['no_sertifikat']?>" id="no_sertifikat">
        
        <label for="deskripsi">Deskripsi</label>
        <input type="text" name="deskripsi" value="<?=$contact['deskripsi']?>" id="deskripsi">
        
        <label for="tanggal">Tanggal</label>
        <input type="text" name="tanggal" value="<?=$contact['tanggal']?>" id="tanggal">
        
        <label for="ttd">Penanda Tangan</label>
        <input type="text" name="ttd" value="<?=$contact['ttd']?>" id="ttd">
        
        <input type="submit" value="Update">
    </form>

    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>