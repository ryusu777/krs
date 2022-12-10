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
    tahun_akademik CHAR(9) NOT NULL,
    tahun_kurikulum CHAR(4) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
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

CREATE VIEW vjadwal AS
SELECT
    jd.no_jadwal_detail,
    m.nama_matkul,
    jd.hari,
    r.nama_ruang,
    jd.jam_mulai,
    jd.jam_selesai,
    m.sks,
    m.smt_matkul,
    d.nama_dosen
    FROM jadwal_dtl jd
        JOIN jadwal_hdr jh  ON jd.no_jadwal_hdr = jh.no_jadwal_hdr
        JOIN ruang      r   ON jd.kode_ruang    = r.kode_ruang
        JOIN matkul     m   ON jd.kode_matkul   = m.kode_matkul
        JOIN dosen      d   ON jd.nid_dosen     = d.nid_dosen;
