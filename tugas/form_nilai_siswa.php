<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background: #007bff;
            border-radius: 5px;
        }
        .hasil-nilai {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card p-4">
            <div class="card-header">
                <h3>Form Penilaian Mahasiswa</h3>
            </div>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="matkul" class="form-control" required>
                        <option value="Pemrograman Web">Pemrograman Web</option>
                        <option value="Basis Data">Basis Data</option>
                        <option value="Jaringan Komputer">Jaringan Komputer</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nilai UTS</label>
                        <input type="number" name="nilai_uts" class="form-control" min="0" max="100" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nilai UAS</label>
                        <input type="number" name="nilai_uas" class="form-control" min="0" max="100" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Nilai Tugas</label>
                        <input type="number" name="nilai_tugas" class="form-control" min="0" max="100" required>
                    </div>
                </div>
                <button type="submit" name="proses" class="btn btn-primary w-100">Hitung</button>
            </form>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proses'])) {
                $nama_siswa = $_POST['nama'];
                $mata_kuliah = $_POST['matkul'];
                $nilai_uts = $_POST['nilai_uts'];
                $nilai_uas = $_POST['nilai_uas'];
                $nilai_tugas = $_POST['nilai_tugas'];

                $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
                $status = ($nilai_akhir > 55) ? "Lulus" : "Tidak Lulus";
                $grade = ($nilai_akhir >= 85) ? 'A' : (($nilai_akhir >= 70) ? 'B' : (($nilai_akhir >= 56) ? 'C' : (($nilai_akhir >= 36) ? 'D' : 'E')));
                $predikat_list = ['A' => 'Sangat Memuaskan', 'B' => 'Memuaskan', 'C' => 'Cukup', 'D' => 'Kurang', 'E' => 'Sangat Kurang'];
                $predikat = $predikat_list[$grade];
            ?>
                <div class="hasil-nilai mt-4">
                    <h5 class="text-center">Hasil Penilaian</h5>
                    <p><strong>Nama:</strong> <?= $nama_siswa; ?></p>
                    <p><strong>Mata Kuliah:</strong> <?= $mata_kuliah; ?></p>
                    <p><strong>Nilai UTS:</strong> <?= $nilai_uts; ?></p>
                    <p><strong>Nilai UAS:</strong> <?= $nilai_uas; ?></p>
                    <p><strong>Nilai Tugas:</strong> <?= $nilai_tugas; ?></p>
                    <p><strong>Nilai Akhir:</strong> <?= number_format($nilai_akhir, 2); ?></p>
                    <p><strong>Status:</strong> <span class="badge bg-<?= ($status == "Lulus") ? 'success' : 'danger'; ?>"> <?= $status; ?> </span></p>
                    <p><strong>Grade:</strong> <span class="badge bg-primary"> <?= $grade; ?> </span></p>
                    <p><strong>Predikat:</strong> <?= $predikat; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>