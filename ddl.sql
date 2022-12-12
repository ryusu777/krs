CREATE TABLE takd (
    kode_takd CHAR(9) PRIMARY KEY NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE prodi(
    no_prodi CHAR(3) PRIMARY KEY,
    nama_prodi VARCHAR(30) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ruang(
    kode_ruang VARCHAR(10) PRIMARY KEY,
    nama_ruang VARCHAR(20) NOT NUlL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dosen(
    nid_dosen CHAR(10) PRIMARY KEY,
    nama_dosen VARCHAR(50) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kurikulum (
    kode_kurikulum VARCHAR(6) PRIMARY KEY,
    tahun_berlaku CHAR(4) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE matkul(
    kode_matkul VARCHAR(10) PRIMARY KEY,
    kode_kurikulum VARCHAR(6) NOT NULL,
    no_prodi CHAR(3) NOT NULL,
    sks INT NOT NULL,
    smt_matkul CHAR(1) NOT NULL,
    nama_matkul VARCHAR(50),
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (no_prodi) REFERENCES prodi (no_prodi),
    FOREIGN KEY (kode_kurikulum) REFERENCES kurikulum (kode_kurikulum)
);

CREATE TABLE jadwal_hdr(
    no_jadwal_hdr CHAR(10) PRIMARY KEY,
    kode_takd CHAR(9) NOT NULL,
    nid_dosen CHAR(10) NOT NULL,
    no_prodi CHAR(3) NOT NULL,
    semester VARCHAR(6) NOT NULL,
    kode_kurikulum CHAR(6) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kode_kurikulum) REFERENCES kurikulum (kode_kurikulum),
    FOREIGN KEY (no_prodi) REFERENCES prodi (no_prodi),
    FOREIGN KEY (kode_takd) REFERENCES takd (kode_takd),
    FOREIGN KEY (nid_dosen) REFERENCES dosen (nid_dosen)
);

CREATE TABLE jadwal_dtl(
    no_jadwal_detail INT PRIMARY KEY AUTO_INCREMENT,
    kode_ruang VARCHAR(10) NOT NULL,
    kode_matkul VARCHAR(10) NOT NULL,
    no_jadwal_hdr CHAR(10) NOT NULL,
    nid_dosen CHAR(10) NOT NULL,
    hari VARCHAR(10) NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kode_matkul) REFERENCES matkul (kode_matkul),
    FOREIGN KEY (kode_ruang) REFERENCES ruang (kode_ruang),
    FOREIGN KEY (no_jadwal_hdr) REFERENCES jadwal_hdr (no_jadwal_hdr),
    FOREIGN KEY (nid_dosen) REFERENCES dosen (nid_dosen)
);

CREATE TABLE jadwal_dtl_log(
    no_log INT PRIMARY KEY AUTO_INCREMENT,
    no_jadwal_detail INT NOT NULL,
    kode_ruang VARCHAR(10) NOT NULL,
    kode_matkul VARCHAR(10) NOT NULL,
    no_jadwal_hdr CHAR(10) NOT NULL,
    nid_dosen CHAR(10) NOT NULL,
    hari VARCHAR(10) NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    aksi CHAR(6) NOT NULL,
    aksi_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$
CREATE TRIGGER update_jadwal_dtl
BEFORE UPDATE
ON jadwal_dtl
FOR EACH ROW
BEGIN
    INSERT INTO jadwal_dtl_log
    SET no_jadwal_detail= new.no_jadwal_detail,
    kode_ruang= new.kode_ruang,
    kode_matkul= new.kode_matkul,
    no_jadwal_hdr= new.no_jadwal_hdr,
    nid_dosen= new.nid_dosen,
    hari= new.hari,
    jam_mulai= new.jam_mulai,
    jam_selesai= new.jam_selesai,
    aksi= 'UPDATE';
END $$

CREATE TRIGGER delete_jadwal_dtl
BEFORE DELETE
ON jadwal_dtl
FOR EACH ROW
BEGIN
    INSERT INTO jadwal_dtl_log
    SET no_jadwal_detail= old.no_jadwal_detail,
    kode_ruang= old.kode_ruang,
    kode_matkul= old.kode_matkul,
    no_jadwal_hdr= old.no_jadwal_hdr,
    nid_dosen= old.nid_dosen,
    hari= old.hari,
    jam_mulai= old.jam_mulai,
    jam_selesai= old.jam_selesai,
    aksi= 'DELETE';
END $$
DELIMITER ;



CREATE VIEW vjadwal AS
SELECT
    jh.no_jadwal_hdr,
    jh.kode_takd,
    jh.semester,
    jd.no_jadwal_detail,
    jd.hari,
    jd.jam_selesai,
    jd.jam_mulai,
    r.kode_ruang,
    r.nama_ruang,
    m.nama_matkul,
    m.sks,
    m.smt_matkul,
    d.nama_dosen,
    d.nid_dosen,
    k.kode_kurikulum,
    k.tahun_berlaku
    FROM jadwal_dtl jd
        JOIN jadwal_hdr jh  ON jd.no_jadwal_hdr = jh.no_jadwal_hdr
        JOIN ruang      r   ON jd.kode_ruang    = r.kode_ruang
        JOIN matkul     m   ON jd.kode_matkul   = m.kode_matkul
        JOIN dosen      d   ON jd.nid_dosen     = d.nid_dosen
        JOIN kurikulum  k   ON m.kode_kurikulum = k.kode_kurikulum;

DROP PROCEDURE IF EXISTS InsertJadwal;
DELIMITER $$
CREATE PROCEDURE InsertJadwal(IN 
    pKodeTakd CHAR(9),
    pNidDosen CHAR(10),
    pNoProdi CHAR(3),
    pSemester VARCHAR(6),
    pKodeKurikulum VARCHAR(6)
)
BEGIN
    DECLARE tahun CHAR(2);
    DECLARE digitSemester CHAR(1);
    DECLARE noUrutTerakhir INT;
    DECLARe noJadwal CHAR(10);

    IF pSemester != 'Ganjil' AND pSemester != 'Genap' THEN
        SIGNAL SQLSTATE '50000'
            SET MESSAGE_TEXT = 'Semester tidak valid';
    END IF;

    IF (SELECT p.no_prodi FROM prodi p WHERE p.no_prodi=pNoProdi) IS NULL THEN
        SIGNAL SQLSTATE '50000'
            SET MESSAGE_TEXT = 'Prodi tidak ditemukan';
    END IF;

    IF (SELECT t.kode_takd FROM takd t WHERE t.kode_takd=pKodeTakd) IS NULL THEN
        SIGNAL SQLSTATE '50000'
            SET MESSAGE_TEXT = 'Tahun akademik tidak ditemukan';
    END IF;
    
    IF (SELECT d.nid_dosen FROM dosen d WHERE d.nid_dosen=pNidDosen) IS NULL THEN
        SIGNAL SQLSTATE '50000'
            SET MESSAGE_TEXT = 'Dosen tidak ditemukan';
    END IF;

    IF (SELECT k.kode_kurikulum FROM kurikulum k WHERE k.kode_kurikulum=pKodeKurikulum) IS NULL THEN
        SIGNAL SQLSTATE '50000'
            SET MESSAGE_TEXT = 'Kurikulum tidak ditemukan';
    END IF;

    SET tahun = SUBSTR(CURDATE(), 3, 2);
    SET digitSemester = IF(pSemester = 'Ganjil', 1, 2);
    SET noUrutTerakhir = (SELECT CAST(SUBSTRING(j.no_jadwal_hdr, 8, 3) AS SIGNED)
        FROM jadwal_hdr j
        WHERE SUBSTRING(j.no_jadwal_hdr, 2, 2) = tahun
            AND SUBSTRING(j.no_jadwal_hdr, 4, 1) = digitSemester
            AND SUBSTRING(j.no_jadwal_hdr, 5, 3) = pNoProdi
        ORDER BY j.no_jadwal_hdr DESC
        LIMIT 1
    );

    SET noJadwal = CONCAT(
        'J',
        tahun,
        digitSemester,
        pNoProdi,
        LPAD(CAST(IFNULL(noUrutTerakhir, 0) + 1 as char), 3, '0')
    );

    INSERT INTO jadwal_hdr (no_jadwal_hdr, kode_takd, nid_dosen, no_prodi, kode_kurikulum, semester) VALUES (noJadwal, pKodeTakd, pNidDosen, pNoProdi, pKodeKurikulum, pSemester);
END$$
DELIMITER ;