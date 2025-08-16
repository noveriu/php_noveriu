 <?php
// soal1a.php

$step = isset($_POST['step']) ? $_POST['step'] : 1;

if ($step == 1) {
    // STEP 1: Input jumlah baris & kolom
    ?>
    <form method="post">
        <label>Inputkan Jumlah Baris:</label>
        <input type="number" name="baris" required>
        <br><br>
        <label>Inputkan Jumlah Kolom:</label>
        <input type="number" name="kolom" required>
        <br><br>
        <input type="hidden" name="step" value="2">
        <button type="submit">SUBMIT</button>
    </form>
    <?php
} elseif ($step == 2) {
    // STEP 2: Generate form sesuai jumlah baris & kolom
    $baris = $_POST['baris'];
    $kolom = $_POST['kolom'];
    ?>
    <form method="post">
        <?php for ($i = 1; $i <= $baris; $i++): ?>
            <?php for ($j = 1; $j <= $kolom; $j++): ?>
                <?php echo "$i:$j "; ?>
                <input type="text" name="data[<?php echo $i; ?>][<?php echo $j; ?>]" required>
            <?php endfor; ?>
            <br><br>
        <?php endfor; ?>
        <input type="hidden" name="baris" value="<?php echo $baris; ?>">
        <input type="hidden" name="kolom" value="<?php echo $kolom; ?>">
        <input type="hidden" name="step" value="3">
        <button type="submit">SUBMIT</button>
    </form>
    <?php
} elseif ($step == 3) {
    // STEP 3: Tampilkan hasil input
    $data = $_POST['data'];
    $baris = $_POST['baris'];
    $kolom = $_POST['kolom'];

    echo "<h3>Hasil Input:</h3>";
    for ($i = 1; $i <= $baris; $i++) {
        for ($j = 1; $j <= $kolom; $j++) {
            echo "$i.$j : " . htmlspecialchars($data[$i][$j]) . "<br>";
        }
    }
}
?>
