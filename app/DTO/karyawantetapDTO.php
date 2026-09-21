<?php

namespace App\DTO;

class KaryawanTetapDTO extends KaryawanDTO {
    public function __construct(
        string         $nama,
        string         $nip,
        string         $departemen,
        string         $email,
        private float  $gajiPokok,
        private float  $tunjangan,
        private string $golongan
    ) {
        // Wajib memanggil parent constructor
        parent::__construct($nama, $nip, $departemen, $email);
    }

    public function getStatus(): string   { return 'Tetap'; }
    public function getGolongan(): string { return $this->golongan; }

    public function hitungGaji(): float {
        return $this->gajiPokok + $this->tunjangan;
    }
}
