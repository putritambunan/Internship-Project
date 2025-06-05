<?php
include "data.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$rows = getData();
if (!isset($rowData) || empty($rowData)) {
    $rowData = is_array($rows) && !empty($rows) ? $rows[0] : [];
}

$columns = !empty($rows) ? array_keys($rows[0]) : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Log Insiden</title>

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="styles.css">
    <link href="bootstrap-5.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@600&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container my-5 position-relative">
        <!-- Header -->
        <div class="d-flex align-items-center border-bottom pb-3 position-fixed top-0 start-0 w-100 shadow-sm px-4" style="z-index: 999; height: 130px; background-color: #e4edf7;">
            <a href="index.php">
            <img src="logo_ptsi.jpeg" alt="Logo Surveyor Indonesia" width="150" class="me-4">
            </a>

            <div class="position-absolute top-50 start-50 translate-middle text-center" style="font-family: 'Lato', sans-serif;">
                <h3 class="mb-1" style="color:#02112b;">PT SURVEYOR INDONESIA</h3>
                <h3 class="mb-1" style="color:#02112b;">DIVISI IT</h3>
                <h3 class="mb-1" style="color:#02112b;">FORMULIR LOG INSIDEN</h3>
            </div>
            <div class="ms-auto text-end small">
                <h6 class="mb-1">No.Dokumen : FP-DTI20-01</h6>
                <h6 class="mb-1">No.Revisi : 00</h6>
                <h6 class="mb-1">Tanggal Terbit : 24 Agustus 2024</h6>
            </div>
        </div>

        <!-- Tombol Tambah Data -->
        <button class="btn btn-success mb-3" onclick="openModal('add')">Tambah Data</button>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>

                        <th>No</th>
                        <?php foreach ($columns as $col_name): ?>
                            <?php if ($col_name == 'no') continue; ?>
                            <th><?= ucwords(str_replace('_', ' ', $col_name)); ?></th>
                        <?php endforeach; ?>
                        <th>Klik</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($rows as $index => $row): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <?php foreach ($row as $col_name => $value): ?>
                                <?php if ($col_name == 'no') continue; ?>
                                <td>
                                    <?php if ($col_name == 'evidence' && !empty($value)): ?>
                                        <img src="uploads/<?= htmlspecialchars($value); ?>" alt="<?= htmlspecialchars($value); ?>" width="200">
                                        <br><small><?= htmlspecialchars($value); ?></small>
                                    <?php else: ?>
                                        <?= htmlspecialchars($value); ?>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <?php
                                $row_cleaned = array_map(fn($v) => is_null($v) ? '' : (is_string($v) ? htmlspecialchars(trim(preg_replace('/\s+/', ' ', $v))) : $v), $row);
                                ?>
                                <button class="btn btn-primary btn-sm mb-1" onclick='openModal("edit", <?= json_encode($row_cleaned) ?>, <?=$index ?>)'>Edit</button>
                                <a class="btn btn-danger btn-sm" href="delete.php?no=<?= $row['no']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="save.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formTitle"></h5>
                        <button type="button" class="btn-close" onclick="closeModal()"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="mode" id="formMode">

                       <!-- Tampilkan hanya No urutan (read-only -->
                       <div class="mb-3">
                            <label class="form-label">No:</label>
                            <input type="text" class="form-control" id="no_display" readonly>
                        </div>

                        <input type="hidden" name="no" id="real_no">

                        <?php foreach ($columns as $col_name): ?>
                            <?php if ($col_name !== 'no'): ?>
                                <div class="mb-3">
                                    <label class="form-label"><?= ucfirst(str_replace("_", " ", $col_name)) ?>:</label>
                                    <textarea name="<?= $col_name ?>" id="<?= $col_name ?>" class="form-control" rows="3"><?= htmlspecialchars($rowData[$col_name] ?? '') ?></textarea>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <div class="mb-3">
                            <label class="form-label">Upload Evidence</label>
                            <input type="file" name="evidence" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Modal & Interaksi -->
    <script>
        function openModal(mode, rowData = {}, index = null) {
           // console.log("Mode yang dikirim:", mode, "Data:", rowData);
            document.getElementById('modal').style.display = 'block';
            document.getElementById('formTitle').innerText = mode === 'edit' ? 'Edit Data' : 'Tambah Data';
            document.getElementById('formMode').value = mode;
            // document.getElementById('no').value = (mode === 'edit' && rowData['no']) ? rowData['no'] : ''; -->

            document.getElementById('no_display').value = index !== null ? index + 1 : '';
            document.getElementById('real_no').value = rowData['no'] ?? '';

            <?php foreach ($columns as $col_name): ?>
                if (document.getElementById('<?= $col_name ?>')) {
                    document.getElementById('<?= $col_name ?>').value = rowData['<?= $col_name ?>'] ?? '';
                }
            <?php endforeach; ?>
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("textarea").forEach(textarea => {
                textarea.addEventListener("keydown", function (event) {
                    if (event.key === "Enter" && !event.shiftKey) {
                        event.preventDefault();
                        let start = this.selectionStart;
                        let end = this.selectionEnd;
                        this.value = this.value.substring(0, start) + "\n" + this.value.substring(end);
                        this.selectionStart = this.selectionEnd = start + 1;
                    }
                });
            });
        });
    </script>
</body>
</html>
