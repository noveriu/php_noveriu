<?php
// koneksi database
$conn = new mysqli('localhost','root','','testdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ambil semua hobi beserta jumlah orang yang punya hobi tersebut
$sql = "SELECT hobi, COUNT(person_id) AS jumlah_person
        FROM hobi
        GROUP BY hobi
        ORDER BY jumlah_person DESC";

$result = $conn->query($sql);
?>

<h2>Laporan Hobi</h2>

<table border="1" cellpadding="5" style="border-collapse: collapse;">
    <tr>
        <th>No</th>
        <th>Hobi</th>
        <th>Jumlah Person</th>
    </tr>
    <?php 
    $no = 1;
    if($result->num_rows > 0):
        while($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['hobi']) ?></td>
        <td><?= $row['jumlah_person'] ?></td>
    </tr>
    <?php 
        endwhile;
    else: 
    ?>
    <tr>
        <td colspan="3">Tidak ada data</td>
    </tr>
    <?php endif; ?>
</table>

<?php
$conn->close();
?>
