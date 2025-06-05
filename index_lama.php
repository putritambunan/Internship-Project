<?php
include "data.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($rowData)) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
        function openModal(mode, rowData = {}) {
            console.log("Mode yang dikirim:", mode, "Data:", rowData);

            document.getElementById('modal').style.display = 'block';
            document.getElementById('formTitle').innerText = mode === 'edit' ? 'Edit Data' : 'Tambah Data';
            document.getElementById('formMode').value = mode;

            // Pastikan kolom 'no' tetap terisi dalam mode edit
            if (mode === 'edit' && rowData['no']) {
                document.getElementById('no').value = rowData['no'];
            } else {
                document.getElementById('no').value = ''; // Kosongkan saat tambah data
            }

            <?php foreach ($columns as $col_name) : ?>
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
                        event.preventDefault(); // Mencegah submit form
			
			let start = this.selectionStart;
                	let end = this.selectionEnd;

                this.value = this.value.substring(0, start) + "\n" + this.value.substring(end);
                this.selectionStart = this.selectionEnd = start + 1; // Geser kursor ke bawah
		    }
                });
            });

            document.querySelectorAll("form").forEach(form => {
        	form.addEventListener("keydown", function (event) {
	 	  if (event.key === "Enter" && !event.shiftKey && document.activeElement.tagName === "TEXTAREA") {
              	event.preventDefault();
              }
          });
      });
  });
    </script>
</head>
<body>
    <header class="container py-4">
        <div class="row align-items-center">
            <div class="cold-md-2">
                <img src="logo_ptsi.jpeg" alt="Logo Surveyor Indonesia" class="img-fluid">
            </div>
            <div class="col-md-7 text-center">
                <h2 class="h3">PT SURVEYOR INDONESIA</h2>
                <h3>DIVISI IT</h3>
                <h3>FORMULIR LOG INSIDEN</h3>
            </div>
            <div class="col-md-3">
                <p>No Dokumen: <strong>FP-DTI20-01</strong></p>
                <p>No Revisi: <strong>00</strong></p>
                <p>Tanggal Terbit: <strong>24 Agustus 2024</strong></p>
            </div>
        </header>
	<div class="border-line"></div>

        <button onclick="openModal('add')">Tambah Data</button>
        <table border="1">
            <tr>
		<th>No</th>
                <?php foreach ($columns as $col_name) : ?>
		    <?php if ($col_name == 'no') continue; ?> 
                    <th><?= ucwords(str_replace('_', ' ', $col_name)); ?></th>
               <?php endforeach; ?>
               <th>Edit</th>
            </tr>
	    <?php $i = 1; ?>
            <?php foreach ($rows as $row) : ?>
                <tr>
		    <td><?= $i++; ?></td>
                    <?php foreach ($row as $col_name => $value) : ?>
                        <?php if ($col_name == 'no') continue; ?>
			<td>
			    <?php if ($col_name == 'evidence' && !empty($value)): ?>
				<img src="uploads/<?= htmlspecialchars($value); ?>" alt="<?= htmlspecialchars($value); ?>" width="150">
				<br>
				<small><?= htmlspecialchars($value); ?></small>
			    <?php else : ?>
				<?= htmlspecialchars($value); ?>
			    <?php endif; ?>
			</td>
                    <?php endforeach; ?>
                    <td>
			<?php
			$row_cleaned = array_map(function ($value) {
				if (is_null($value)) return '';
				return is_string($value) ? trim(preg_replace('/\s+/', ' ', $value)) : $value;
			}, $row);
			
			$json_data = json_encode($row_cleaned, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
			?>
			<button onclick='openModal("edit", <?= htmlspecialchars(json_encode($row_cleaned, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)); ?>)'>Edit</button>

                	<a href="delete.php?no=<?= $row['no']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">    
			    Hapus
			</a>
		</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- Modal Pop-up -->
    <div id="modal" style="display:none; position:fixed; top:20%; left:30%; background:white; padding:50px; border:1px solid black;">
        <h3 id="formTitle"></h3>
        <form action="save.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="mode" id="formMode">
            <label>No:</label>
            <input type="text" name="no" id="no" readonly><br>

            <?php foreach ($columns as $col_name) : ?>
                <?php if ($col_name !== 'no') : ?> 
                    <label><?= ucfirst(str_replace("_", " ", $col_name)) ?>:</label>
			<textarea name="<?= $col_name ?>" id="<?= $col_name ?>" rows="6" cols="60"><?= isset($rowData[$col_name]) ? htmlspecialchars($rowData[$col_name]) : '' ?></textarea>
		<br><br>
  	        <?php endif; ?>
            <?php endforeach; ?>

	    <input type="file" name="evidence">

            <button type="submit">Simpan</button>
            <button type="button" onclick="closeModal()">Batal</button>
        </form>
    </div>
</body>
</html>
