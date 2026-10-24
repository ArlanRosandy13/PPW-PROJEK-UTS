<?php
// 1. Ambil status dari URL (contoh: ?status=success atau ?status=failed)
$status = isset($_GET['status']) ? $_GET['status'] : 'success';

// 2. Baca isi file template HTML eksternal
$template = file_get_contents('login-status.html');

// 3. Tentukan data berdasarkan kondisi (Berhasil atau Gagal)
if ($status === 'success') {
    $box_class         = 'success';
    $title_text        = 'Login Berhasil!';
    $subtitle_text     = 'Selamat datang kembali, <br><span class="user-email">user@domain.com</span>';
    $label_1           = 'Waktu Masuk';
    $value_1           = date('H:i, d M Y');
    $label_2           = 'IP Address';
    $value_2           = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $btn_primary_link  = 'dashboard.php';
    $btn_primary_text  = 'Lanjut ke Dashboard';
    $btn_secondary_link= 'logout.php';
    $btn_secondary_text= 'Keluar (Logout)';
    $btn_secondary_cls = 'btn-outline';
    $icon_svg          = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>';
} else {
    $box_class         = 'failed';
    $title_text        = 'Login Gagal';
    $subtitle_text     = 'Kombinasi email atau kata sandi yang Anda masukkan tidak sesuai.';
    $label_1           = 'Kode Eror';
    $value_1           = '<span class="text-danger">ERR_AUTH_INVALID</span>';
    $label_2           = 'Sisa Percobaan';
    $value_2           = '<span class="text-danger">2 dari 3 kali</span>';
    $btn_primary_link  = 'login.php';
    $btn_primary_text  = 'Coba Login Lagi';
    $btn_secondary_link= 'forgot-password.php';
    $btn_secondary_text= 'Lupa Kata Sandi?';
    $btn_secondary_cls = 'btn-secondary';
    $icon_svg          = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';
}

// 4. Masukkan data dinamis ke dalam template HTML
$output = str_replace([
    '{{BOX_CLASS}}', '{{TITLE_TEXT}}', '{{SUBTITLE_TEXT}}', 
    '{{LABEL_1}}', '{{VALUE_1}}', '{{LABEL_2}}', '{{VALUE_2}}', 
    '{{BTN_PRIMARY_LINK}}', '{{BTN_PRIMARY_TEXT}}', 
    '{{BTN_SECONDARY_LINK}}', '{{BTN_SECONDARY_TEXT}}', '{{BTN_SECONDARY_CLASS}}',
    '{{ICON_SVG}}'
], [
    $box_class, $title_text, $subtitle_text, 
    $label_1, $value_1, $label_2, $value_2, 
    $btn_primary_link, $btn_primary_text, 
    $btn_secondary_link, $btn_secondary_text, $btn_secondary_cls,
    $icon_svg
], $template);

// 5. Tampilkan hasilnya ke pengguna
echo $output;
?>