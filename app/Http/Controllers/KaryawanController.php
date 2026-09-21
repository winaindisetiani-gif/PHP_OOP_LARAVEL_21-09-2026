<?php
 
namespace App\Http\Controllers;
 
use App\DTO\KaryawanDTO;
use App\DTO\KaryawanTetapDTO;
use App\DTO\KaryawanKontrakDTO;
use App\DTO\KaryawanMagangDTO;
 
// ============================================================
// MATERI 12: CONTROLLER DI LARAVEL
// KaryawanController mewarisi base Controller Laravel
// Ini adalah contoh Inheritance di framework!
// ============================================================
class KaryawanController extends Controller
{
    // --------------------------------------------------------
    // METHOD: index()
    // Menampilkan daftar semua karyawan
    // --------------------------------------------------------
    public function index()
    {
        // Data diambil dari satu sumber: getDaftarKaryawan()
        $karyawan = $this->getDaftarKaryawan();
 
        // Hitung total gaji dari semua karyawan
        $totalGaji = array_sum(
            array_map(fn($k) => $k->hitungGaji(), $karyawan)
        );
 
        $judulHalaman = 'Portal Karyawan — Daftar Karyawan';
        $jumlahTotal  = count($karyawan);
        $bulanTahun   = now()->translatedFormat('F Y');
 
        // MATERI 11: compact()
        return view('karyawan.index', compact(
            'karyawan',
            'totalGaji',
            'judulHalaman',
            'jumlahTotal',
            'bulanTahun'
        ));
    }
 
    // --------------------------------------------------------
    // METHOD: show()
    // Menampilkan detail satu karyawan berdasarkan NIP
    // --------------------------------------------------------
    public function show(string $nip)
    {
        $karyawan = $this->cariKaryawanByNip($nip);
 
        if (!$karyawan) {
            abort(404, 'Karyawan tidak ditemukan!');
        }
 
        $judulHalaman = "Detail Karyawan: {$karyawan->getNama()}";
 
        return view('karyawan.show', compact('karyawan', 'judulHalaman'));
    }
 
    // --------------------------------------------------------
    // METHOD: laporanGaji()
    // Laporan penggajian bulanan
    // --------------------------------------------------------
    public function laporanGaji()
    {
        $karyawan     = $this->getDaftarKaryawan();
        $totalGaji    = array_sum(array_map(fn($k) => $k->hitungGaji(), $karyawan));
        $periode      = now()->translatedFormat('F Y');
        $judulHalaman = 'Laporan Gaji Bulanan';
 
        return view('karyawan.laporan', compact(
            'karyawan',
            'totalGaji',
            'periode',
            'judulHalaman'
        ));
    }
 
    // --------------------------------------------------------
    // HELPER: cariKaryawanByNip()
    // Return type memakai class induk (KaryawanDTO) supaya
    // karyawan Tetap, Kontrak, maupun Magang semuanya valid.
    // --------------------------------------------------------
    private function cariKaryawanByNip(string $nip): ?KaryawanDTO
    {
        foreach ($this->getDaftarKaryawan() as $k) {
            if ($k->getNip() === $nip) {
                return $k;
            }
        }
 
        return null;
    }
 
    // --------------------------------------------------------
    // HELPER: getDaftarKaryawan()
    // MATERI 10: ARRAY OF OBJECTS
    // Satu-satunya tempat data karyawan (simulasi database).
    // --------------------------------------------------------
    private function getDaftarKaryawan(): array
    {
        return [
            new KaryawanTetapDTO(
                nama:       'Budi Santoso',
                nip:        'KT-001',
                departemen: 'Teknologi Informasi',
                email:      'budi@perusahaan.id',
                gajiPokok:  5_500_000,
                tunjangan:  1_200_000,
                golongan:   'III-A'
            ),
            new KaryawanTetapDTO(
                nama:       'Sari Dewi Rahayu',
                nip:        'KT-002',
                departemen: 'Keuangan',
                email:      'sari@perusahaan.id',
                gajiPokok:  6_000_000,
                tunjangan:  1_500_000,
                golongan:   'III-B'
            ),
            new KaryawanKontrakDTO(
                nama:         'Ahmad Fauzi',
                nip:          'KK-001',
                departemen:   'Desain Kreatif',
                email:        'ahmad@perusahaan.id',
                gajiPerBulan: 4_500_000,
                masaKontrak:  '12 Bulan'
            ),
            new KaryawanKontrakDTO(
                nama:         'Rina Amalia Putri',
                nip:          'KK-002',
                departemen:   'Marketing',
                email:        'rina@perusahaan.id',
                gajiPerBulan: 4_000_000,
                masaKontrak:  '6 Bulan'
            ),
            new KaryawanMagangDTO(
                nama:         'Deni Pratama',
                nip:          'KM-001',
                departemen:   'Teknologi Informasi',
                email:        'deni@perusahaan.id',
                uangSaku:     1_500_000,
                durasiMinggu: 12
            ),
        ];
    }
}
 