CREATE TABLE kehadiran (
    id_kehadiran INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(32),
    tanggal DATE,
    jam_masuk TIME,
    jam_keluar TIME,
    kehadiran ENUM('Hadir', 'Cuti', 'Sakit', 'Izin', 'Alpa') DEFAULT 'Hadir'
);