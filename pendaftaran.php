<?php
/*
  ===================================================================
  ANALISIS VIDEO (BAGIAN A)
  ===================================================================
  1. Perhatikan URL browser pada menit [08:24]. Apa yang terjadi pada URL 
     saat data dikirim menggunakan metode GET?
     Jawaban: Data yang dikirimkan akan terpapar/terlihat jelas di baris 
     URL browser sebagai query parameter (contoh: ?nama=isi_input).

  2. Berdasarkan penjelasan di menit [10:31], mengapa kita dilarang keras 
     menggunakan metode GET untuk form yang berisi password atau data sensitif?
     Jawaban: Karena data sensitif akan terlihat terbuka di URL, tersimpan 
     di riwayat (history) browser, serta mudah diintip oleh pihak luar, 
     sehingga tidak aman untuk keamanan data.

  3. Apa fungsi utama dari pengecekan isset() yang dipraktikkan pada menit [09:00]?
     Jawaban: Untuk memeriksa apakah suatu variabel (seperti tombol submit) 
     sudah ditekan/dikirimkan atau belum, sehingga mencegah timbulnya error 
     'Undefined index' saat halaman diakses pertama kali.
  ===================================================================
*/

// Inisialisasi variabel untuk pesan error dan status sukses
$pesan_error = "";
$sukses = false;

// Deklarasi variabel awal
$nama = $nis = $email = $jurusan = $perusahaan = $alasan = "";
$tech_stack = [];

// Pengecekan apakah tombol submit sudah diklik (isset $_POST)
if (isset($_POST['submit'])) {
    
    // Ambil input dan amankan dengan htmlspecialchars
    $nama       = isset($_POST['nama']) ? htmlspecialchars(trim($_POST['nama'])) : "";
    $nis        = isset($_POST['nis']) ? htmlspecialchars(trim($_POST['nis'])) : "";
    $email      = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : "";
    $jurusan    = isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan']) : "";
    $perusahaan = isset($_POST['perusahaan']) ? htmlspecialchars(trim($_POST['perusahaan'])) : "";
    $alasan     = isset($_POST['alasan']) ? htmlspecialchars(trim($_POST['alasan'])) : "";
    
    if (isset($_POST['tech_stack']) && is_array($_POST['tech_stack'])) {
        $tech_stack = $_POST['tech_stack'];
    }

    // Validasi field wajib dengan empty()
    if (empty($nama) || empty($nis) || empty($email) || empty($jurusan) || empty($perusahaan)) {
        $pesan_error = "Harap isi seluruh field wajib (Nama, NIS, Email, Jurusan, dan Perusahaan)!";
    } else {
        $sukses = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Peserta PKL</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; padding: 20px; }
        .card { max-width: 550px; background: #fff; padding: 25px; border-radius: 8px; margin: auto; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="number"], input[type="email"], select, textarea {
            width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
        }
        .error { color: #d9534f; background: #f2dede; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .hasil { background: #d9edf7; color: #31708f; padding: 15px; border-radius: 4px; margin-top: 20px; }
        button { background: #0275d8; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background: #025aa5; }
    </style>
</head>
<body>

<div class="card">
    <h2>Form Pendaftaran Peserta PKL</h2>

    <?php if (!empty($pesan_error)): ?>
        <div class="error"><?php echo $pesan_error; ?></div>
    <?php endif; ?>

    <!-- Form menggunakan method POST sesuai aturan -->
    <form action="" method="POST">
        
        <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>">
        </div>

        <div class="form-group">
            <label>NIS *</label>
            <input type="number" name="nis" value="<?php echo $nis; ?>">
        </div>

        <div class="form-group">
            <label>Email Siswa *</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>

        <div class="form-group">
            <label>Kompetensi Keahlian / Jurusan *</label>
            <input type="radio" name="jurusan" value="TJAT" <?php if($jurusan=="TJAT") echo "checked"; ?>> TJAT <br>
            <input type="radio" name="jurusan" value="RPL" <?php if($jurusan=="RPL") echo "checked"; ?>> RPL <br>
            <input type="radio" name="jurusan" value="TKJ" <?php if($jurusan=="TKJ") echo "checked"; ?>> TKJ
        </div>

        <div class="form-group">
            <label>Pilihan Perusahaan PKL *</label>
            <select name="perusahaan">
                <option value="">-- Pilih Perusahaan --</option>
                <option value="PT Telkom Indonesia" <?php if($perusahaan=="PT Telkom Indonesia") echo "selected"; ?>>PT Telkom Indonesia</option>
                <option value="PT Lintasarta" <?php if($perusahaan=="PT Lintasarta") echo "selected"; ?>>PT Lintasarta</option>
                <option value="PT Indosat Ooredoo" <?php if($perusahaan=="PT Indosat Ooredoo") echo "selected"; ?>>PT Indosat Ooredoo</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tech Stack / Kompetensi yang Dikuasai</label>
            <input type="checkbox" name="tech_stack[]" value="HTML/CSS"> HTML/CSS <br>
            <input type="checkbox" name="tech_stack[]" value="PHP & MySQL"> PHP & MySQL <br>
            <input type="checkbox" name="tech_stack[]" value="Jaringan / Network Access"> Jaringan / Network Access <br>
            <input type="checkbox" name="tech_stack[]" value="Python / MicroPython"> Python / MicroPython
        </div>

        <div class="form-group">
            <label>Alasan Memilih Perusahaan</label>
            <textarea name="alasan" rows="3"><?php echo $alasan; ?></textarea>
        </div>

        <button type="submit" name="submit">Kirim Pendaftaran</button>
    </form>

    <!-- Menampilkan Hasil Input Jika Validasi Berhasil -->
    <?php if ($sukses): ?>
        <div class="hasil">
            <h3>Data Berhasil Dicetak:</h3>
            <p><b>Nama:</b> <?php echo $nama; ?></p>
            <p><b>NIS:</b> <?php echo $nis; ?></p>
            <p><b>Email:</b> <?php echo $email; ?></p>
            <p><b>Jurusan:</b> <?php echo $jurusan; ?></p>
            <p><b>Perusahaan PKL:</b> <?php echo $perusahaan; ?></p>
            <p><b>Tech Stack:</b> 
                <?php 
                    if (!empty($tech_stack)) {
                        echo implode(", ", array_map('htmlspecialchars', $tech_stack));
                    } else {
                        echo "-";
                    }
                ?>
            </p>
            <p><b>Alasan:</b> <?php echo nl2br($alasan); ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>