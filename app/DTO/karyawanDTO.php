<?php

namespace App\DTO;

// ============================================================
// MATERI 9 & 12: INHERITANCE + PENGGUNAAN DI LARAVEL
// ============================================================

// CLASS INDUK — Base DTO untuk data Karyawan
abstract class KaryawanDTO {
    // Properti protected: bisa diwarisi oleh child class
    public function __construct(
        protected readonly string $nama,
        protected readonly string $nip,
        protected readonly string $departemen,
        protected readonly string $email
    ) {}

    // Getter methods
    public function getNama(): string       { return $this->nama; }
    public function getNip(): string        { return $this->nip; }
    public function getDepartemen(): string { return $this->departemen; }
    public function getEmail(): string      { return $this->email; }

    // Abstract method — WAJIB diimplementasikan child class
    abstract public function getStatus(): string;
    abstract public function hitungGaji(): float;

    // Helper method untuk format rupiah
    public function getGajiFormatted(): string {
        return 'Rp ' . number_format($this->hitungGaji(), 0, ',', '.');
    }
}

// ============================================================
// CLASS ANAK 1: KaryawanTetapDTO
// ============================================================