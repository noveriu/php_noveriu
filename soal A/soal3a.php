<?php
// koneksi database
$conn = new mysqli('localhost','root','','testdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ambil keyword hobi
$hobi = $_GET['hobi'] ?? '';

if ($hobi != '') {
    // cari person berdasarkan hobi
    $sql = "SELECT person.id, person.nama, person.alamat, GROUP_CONCAT(hobi.hobi SEPARATOR ', ') AS hobi_list
            FROM person
            JOIN hobi ON person.id = hobi.person_id
            WHERE hobi.hobi LIKE ?
            GROUP BY person.id, person.nama, person.alamat";
    
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$hobi%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // tampil semua jika kosong
    $sql = "SELECT person.id, person.nama, person.alamat, GROUP_CONCAT(hobi.hobi SEPARATOR ', ') AS hobi_list
            FROM person
            LEFT JOIN hobi ON person.id = hobi.person_id
            GROUP BY person.id, person.nama, person.alamat";
    $result = $conn->query($sql);
}
?>

<h2>Search Person by Hobi</h2>

<form method="GET" action="">
    <input type="text" name="hobi" placeholder="Cari hobi..." value="<?= htmlspecialchars($hobi) ?>">
    <button type="submit">Search</button>
</form>

<table border="1" cellpadding="5" style="margin-top:10px;">
    <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Hobi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['alamat']) ?></td>
        <td><?= htmlspecialchars($row['hobi_list']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php
$conn->close();
?>
