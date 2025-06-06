<?php
// Jangan lupa panggil session_start() di file utama jika ingin menggunakan $_SESSION
// session_start(); 

include "koneksi.php"; // Pastikan $db adalah objek koneksi mysqli

// SELECT FUNCTION
function select($query, $params = []) {
    global $db;
    $stmt = mysqli_prepare($db, $query);

    if (!$stmt) {
        error_log("Select prepare error: " . mysqli_error($db));
        return [];
    }

    if (!empty($params)) {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        
        $bind_params = [$stmt, $types];
        foreach ($params as $key => $value) {
            $bind_params[] = &$params[$key];
        }

        if (!call_user_func_array('mysqli_stmt_bind_param', $bind_params)) {
             error_log("Select bind param error: " . mysqli_stmt_error($stmt));
             mysqli_stmt_close($stmt);
             return [];
        }
    }

    if (!mysqli_stmt_execute($stmt)) {
        error_log("Select execute error: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        return [];
    }
    
    $result = mysqli_stmt_get_result($stmt);
    if ($result === false) {
        error_log("Select get result error: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        return [];
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $rows;
}

// LOG ACTIVITY FUNCTION
function log_activity($user_id, $activity) {
    global $db;
    $log_user_id = isset($user_id) && is_numeric($user_id) ? (int)$user_id : 0;

    $query = "INSERT INTO aktivitas_log (user_id, aktivitas) VALUES (?, ?)";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Log activity prepare error: " . mysqli_error($db));
        return false;
    }
    mysqli_stmt_bind_param($stmt, "is", $log_user_id, $activity);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected > 0 ? mysqli_insert_id($db) : false;
}

// TIME AGO FUNCTION
function waktu_lalu($timestamp) {
    $selisih = time() - strtotime($timestamp);
    if ($selisih < 60) return "baru saja";
    elseif ($selisih < 3600) return floor($selisih/60) . " menit lalu";
    elseif ($selisih < 86400) return floor($selisih/3600) . " jam lalu";
    else return date('j M Y', strtotime($timestamp));
}

// LOGIN FUNCTIONS
function create_login($post) {
    global $db;
    $name = strip_tags($post['name']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']); // Password disimpan plain text
    $level = strip_tags($post['level']);
    $status = strip_tags($post['status']);

    $query = "INSERT INTO login (name, username, password, level, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Create login prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "sssss", $name, $username, $password, $level, $status);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menambahkan user baru: $username");
    }
    
    return $affected;
}

function update_login($post) {
    global $db;
    $id = (int)$post['id'];
    $name = strip_tags($post['name']);
    $username = strip_tags($post['username']);
    $level = strip_tags($post['level']);
    $status = strip_tags($post['status']);

    $query = "UPDATE login SET name = ?, username = ?, level = ?, status = ?";
    $params = [$name, $username, $level, $status];
    $types = "ssss";

    if (!empty($post['password'])) {
        $password = strip_tags($post['password']); // Password disimpan plain text
        $query .= ", password = ?";
        $params[] = $password;
        $types .= "s";
    }

    $query .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Update login prepare error: " . mysqli_error($db));
        return -1;
    }
    
    $bind_params = [$stmt, $types];
    foreach ($params as $key => $value) {
        $bind_params[] = &$params[$key];
    }
    if (!call_user_func_array('mysqli_stmt_bind_param', $bind_params)) {
        error_log("Update login bind param error: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        return -1;
    }

    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Memperbarui user: $username");
    }
    
    return $affected;
}

function delete_login($id) {
    global $db;
    $user = select("SELECT username FROM login WHERE id = ?", [$id]);
    $username = $user[0]['username'] ?? 'unknown';
    
    $query = "DELETE FROM login WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Delete login prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menghapus user: $username");
    }
    
    return $affected;
}

// KATEGORI FUNCTIONS
function create_kategori($post) {
    global $db;
    $nama = strip_tags($post['nama']);
    $query = "INSERT INTO kategori (nama) VALUES (?)";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Create kategori prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "s", $nama);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menambahkan kategori: $nama");
    }
    
    return $affected;
}

function update_kategori($post) {
    global $db;
    $id = (int)$post['id'];
    $nama = strip_tags($post['nama']);
    $query = "UPDATE kategori SET nama = ? WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Update kategori prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "si", $nama, $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Memperbarui kategori ID $id: $nama");
    }
    
    return $affected;
}

function delete_kategori($id) {
    global $db;
    $kategori = select("SELECT nama FROM kategori WHERE id = ?", [$id]);
    $nama = $kategori[0]['nama'] ?? 'unknown';
    
    $query = "DELETE FROM kategori WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Delete kategori prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menghapus kategori: $nama");
    }
    
    return $affected;
}

// BUKU FUNCTIONS
function create_buku($data) {
    global $db;
    $id_kategori = (int) $data['id_kategori'];
    $judul_buku = strip_tags($data['judul_buku']);
    $pengarang = strip_tags($data['pengarang']);
    $tahun_terbit = (int) strip_tags($data['tahun_terbit']);
    $jumlah_buku = (int) strip_tags($data['jumlah_buku']);
    $gambar = strip_tags($data['gambar']);

    $query = "INSERT INTO buku (id_kategori, judul_buku, pengarang, tahun_terbit, jumlah_buku, gambar)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Create buku prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "isssis", $id_kategori, $judul_buku, $pengarang, $tahun_terbit, $jumlah_buku, $gambar);
    
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Create buku execute error: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        return -1;
    }

    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menambahkan buku: $judul_buku");
    }
    
    return $affected;
}

function update_buku($data) {
    global $db;
    $id = (int) $data['id'];
    $id_kategori = (int) $data['id_kategori'];
    $judul_buku = strip_tags($data['judul_buku']);
    $pengarang = strip_tags($data['pengarang']);
    $tahun_terbit = (int) strip_tags($data['tahun_terbit']);
    $jumlah_buku = (int) strip_tags($data['jumlah_buku']);
    $gambar = strip_tags($data['gambar']);

    $query = "UPDATE buku SET id_kategori = ?, judul_buku = ?, pengarang = ?, tahun_terbit = ?, jumlah_buku = ?, gambar = ? WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Update buku prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "issiisi", $id_kategori, $judul_buku, $pengarang, $tahun_terbit, $jumlah_buku, $gambar, $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Memperbarui buku ID $id: $judul_buku");
    }
    
    return $affected;
}

function delete_buku($id) {
    global $db;
    $buku = select("SELECT judul_buku FROM buku WHERE id = ?", [$id]);
    $judul = $buku[0]['judul_buku'] ?? 'unknown';
    
    $query = "DELETE FROM buku WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Delete buku prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menghapus buku: $judul");
    }
    
    return $affected;
}

// SISWA FUNCTIONS
function create_siswa($post) {
    global $db;
    $nama = strip_tags($post['nama']);
    $kelas = strip_tags($post['kelas']);
    $alamat = strip_tags($post['alamat']);
    $query = "INSERT INTO siswa (nama, kelas, alamat) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Create siswa prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "sss", $nama, $kelas, $alamat);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menambahkan siswa: $nama");
    }
    
    return $affected;
}

function update_siswa($post) {
    global $db;
    $id = (int)$post['id'];
    $nama = strip_tags($post['nama']);
    $kelas = strip_tags($post['kelas']);
    $alamat = strip_tags($post['alamat']);
    $query = "UPDATE siswa SET nama = ?, kelas = ?, alamat = ? WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Update siswa prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $kelas, $alamat, $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Memperbarui siswa ID $id: $nama");
    }
    
    return $affected;
}

function delete_siswa($id) {
    global $db;
    $siswa = select("SELECT nama FROM siswa WHERE id = ?", [$id]);
    $nama = $siswa[0]['nama'] ?? 'unknown';
    
    $query = "DELETE FROM siswa WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $affected = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        
        if ($affected > 0 && isset($_SESSION['user_id'])) {
            log_activity($_SESSION['user_id'], "Menghapus siswa: $nama");
        }
        
        return $affected;
    } else {
        error_log("Delete siswa prepare error: " . mysqli_error($db));
        return -1;
    }
}

// PEMINJAMAN FUNCTIONS
function create_peminjaman($data) {
    global $db;
    $id_siswa = (int)$data['id_siswa'];
    $id_buku = (int)$data['id_buku'];
    $jumlah_buku = (int)$data['jumlah_buku'];
    $tanggal_pinjam = $data['tanggal_pinjam'];
    $tanggal_kembali = $data['tanggal_kembali'];

    $siswa = select("SELECT nama FROM siswa WHERE id = ?", [$id_siswa]);
    $buku = select("SELECT judul_buku FROM buku WHERE id = ?", [$id_buku]);
    $nama_siswa = $siswa[0]['nama'] ?? 'unknown';
    $judul_buku = $buku[0]['judul_buku'] ?? 'unknown';

    $query = "INSERT INTO peminjaman (id_siswa, id_buku, jumlah_buku, tanggal_pinjam, tanggal_kembali)
              VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Create peminjaman prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "iiiss", $id_siswa, $id_buku, $jumlah_buku, $tanggal_pinjam, $tanggal_kembali);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Mencatat peminjaman: $nama_siswa meminjam $judul_buku");
    }
    
    return $affected;
}

function update_peminjaman($post) {
    global $db;
    $id = (int)$post['id'];
    $id_siswa = (int)$post['id_siswa'];
    $id_buku = (int)$post['id_buku'];
    $tanggal_pinjam = $post['tanggal_pinjam'];
    $tanggal_kembali = $post['tanggal_kembali'];
    $jumlah_buku = (int)$post['jumlah_buku'];

    $siswa = select("SELECT nama FROM siswa WHERE id = ?", [$id_siswa]);
    $buku = select("SELECT judul_buku FROM buku WHERE id = ?", [$id_buku]);
    $nama_siswa = $siswa[0]['nama'] ?? 'unknown';
    $judul_buku = $buku[0]['judul_buku'] ?? 'unknown';

    $query = "UPDATE peminjaman 
              SET id_siswa = ?, id_buku = ?, tanggal_pinjam = ?, tanggal_kembali = ?, jumlah_buku = ? 
              WHERE id = ?";
              
    $stmt = mysqli_prepare($db, $query);
    
    if (!$stmt) {
        error_log("Update peminjaman prepare error: " . mysqli_error($db));
        return -1;
    }

    mysqli_stmt_bind_param($stmt, "iissii", $id_siswa, $id_buku, $tanggal_pinjam, $tanggal_kembali, $jumlah_buku, $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Memperbarui peminjaman ID $id: $nama_siswa - $judul_buku");
    }

    return $affected;
}

function delete_peminjaman($id) {
    global $db;
    $loan = select("SELECT p.id, s.nama AS siswa, b.judul_buku AS buku 
                    FROM peminjaman p
                    JOIN siswa s ON p.id_siswa = s.id
                    JOIN buku b ON p.id_buku = b.id
                    WHERE p.id = ?", [$id]);
    $nama_siswa = $loan[0]['siswa'] ?? 'unknown';
    $judul_buku = $loan[0]['buku'] ?? 'unknown';
    
    $query = "DELETE FROM peminjaman WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Delete peminjaman prepare error: " . mysqli_error($db));
        return -1;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($affected > 0 && isset($_SESSION['user_id'])) {
        log_activity($_SESSION['user_id'], "Menghapus peminjaman: $nama_siswa - $judul_buku");
    }
    
    return $affected;
}

// GET RECENT ACTIVITY LOGS
function get_recent_logs($limit = 5) {
    global $db;
    $query = "SELECT a.*, l.username, l.name, l.level 
              FROM aktivitas_log a
              LEFT JOIN login l ON a.user_id = l.id
              ORDER BY a.created_at DESC 
              LIMIT ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Get recent logs prepare error: " . mysqli_error($db));
        return [];
    }
    mysqli_stmt_bind_param($stmt, "i", $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $rows;
}

// GET USER DETAILS BY ID
function get_user_details($user_id) {
    global $db;
    $query = "SELECT name, username, level FROM login WHERE id = ?";
    $stmt = mysqli_prepare($db, $query);
    if (!$stmt) {
        error_log("Get user details prepare error: " . mysqli_error($db));
        return null;
    }
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $user;
}
?>