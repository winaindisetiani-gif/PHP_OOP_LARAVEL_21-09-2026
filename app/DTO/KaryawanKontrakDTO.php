<?php

namespace App\DTO;



class KaryawanKontrakDTO extends KaryawanDTO {
    public function __construct(
        string         $nama,
        string         $nip,
        string         $departemen,
        string         $email,
        private float  $gajiPerBulan,
        private string $masaKontrak
    ) {
        parent::__construct($nama, $nip, $departemen, $email);
    }

    public function getStatus(): string      { return 'Kontrak'; }
    public function getMasaKontrak(): string { return $this->masaKontrak; }

    public function hitungGaji(): float {
        return $this->gajiPerBulan; // Gaji tetap tanpa tunjangan
    }
}