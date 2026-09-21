<?php

namespace App\DTO;


class KaryawanMagangDTO extends KaryawanDTO {
    public function __construct(
        string        $nama,
        string        $nip,
        string        $departemen,
        string        $email,
        private float $uangSaku,
        private int   $durasiMinggu
    ) {
        parent::__construct($nama, $nip, $departemen, $email);
    }

    public function getStatus(): string { return 'Magang'; }

    public function hitungGaji(): float {
        return $this->uangSaku; // Hanya uang saku
    }
}