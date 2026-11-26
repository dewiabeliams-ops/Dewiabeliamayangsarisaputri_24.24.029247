<?php
// LAB 9 — Exception (bagian PHPUnit dikerjakan lokal, kirim tautan repositori)
// Spesifikasi:
//  - NilaiTidakValidException & SaldoTidakCukupException extends Exception
//  - Siswa(): setNilai(int) melempar NilaiTidakValidException jika di luar 0–100
//  - Rekening(float $saldo): tarik(float) melempar SaldoTidakCukupException; getSaldo(): float

class NilaiTidakValidException extends Exception
{
}

class SaldoTidakCukupException extends Exception
{
}

class Siswa
{
    private int $nilai;
    
    public function setNilai(int $nilai): void
    {
        if ($nilai < 0 || $nilai > 100) {
            throw new NilaiTidakValidException("Nilai harus berada di antara 0 dan 100.");
        }
        $this->nilai = $nilai;
    }
    
    public function getNilai(): int
    {
        return $this->nilai;
    }   
}

class Rekening
{
    private float $saldo;
    
    public function __construct(float $saldo)
    {
        $this->saldo = $saldo;
    }
    
    public function tarik(float $jumlah): void
    {
        if ($jumlah > $this->saldo) {
           throw new SaldoTidakCukupException("Saldo tidak mencukupi untuk penarikan.");
        }
        $this->saldo -= $jumlah;
    }
    
    public function getsaldo(): float
    {
        return $this->saldo;
    }
}

try {
    (new Siswa ())->setNilai(150);
} catch (NilaiTidakValidException $e) {
    echo 'Tertangkap: ' . $e->getMessage();
}