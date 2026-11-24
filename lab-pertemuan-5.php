<?php
// LAB 5 — Inheritance & overriding
// Spesifikasi:
//  - Pegawai(string $nama, float $gajiPokok): hitungGaji(): float, FINAL info(): string
//  - Guru(nama, gajiPokok, int $jamMengajar)      -> gajiPokok + jamMengajar x 50.000
//  - Staf(nama, gajiPokok, float $tunjangan)       -> gajiPokok + tunjangan
//  - Honorer(nama, float $gajiPerJam, int $jamKerja) -> gajiPerJam x jamKerja
//  - Sekolah: tambahPegawai(Pegawai $p), totalGaji(): float  (komposisi)

class Pegawai
{
    protected string $nama;
    protected float $gajiPokok;

    public function __construct(string $nama, float $gajiPokok = 0.0)
    {
        $this->nama = $nama;
        $this->gajiPokok = $gajiPokok;
    }

    public function hitungGaji(): float
    {
        return $this->gajiPokok;
    }

    final public function info(): string
    {
        $gajiFormatted = number_format($this->hitungGaji(), 0, ',', '.');
        return "Nama: {$this->nama} | Gaji: Rp {$gajiFormatted}";
    }
}

class Guru extends Pegawai
{
    private int $jamMengajar;

    public function __construct(string $nama, float $gajiPokok, int $jamMengajar)
    {
        parent::__construct($nama, $gajiPokok);
        $this->jamMengajar = $jamMengajar;
    }

    public function hitungGaji(): float
    {
        return $this->gajiPokok + ($this->jamMengajar * 50000);
    }
}

class Staf extends Pegawai
{
    private float $tunjangan;

    public function __construct(string $nama, float $gajiPokok, float $tunjangan)
    {
        parent::__construct($nama, $gajiPokok);
        $this->tunjangan = $tunjangan;
    }

    public function hitungGaji(): float
    {
        return $this->gajiPokok + $this->tunjangan;
    }
}

class Honorer extends Pegawai
{
    private float $gajiPerJam;
    private int $jamKerja;

    public function __construct(string $nama, float $gajiPerJam, int $jamKerja)
    {
        parent::__construct($nama, 0.0);
        $this->gajiPerJam = $gajiPerJam;
        $this->jamKerja = $jamKerja;
    }

    public function hitungGaji(): float
    {
        return $this->gajiPerJam * $this->jamKerja;
    }
}

class Sekolah
{
   
    private array $daftarPegawai = [];

    public function tambahPegawai(Pegawai $p): void
    {
        $this->daftarPegawai[] = $p;
    }

    public function totalGaji(): float
    {
        $total = 0.0;
        foreach ($this->daftarPegawai as $pegawai) {
            $total += $pegawai->hitungGaji();
        }
        return $total;
    }
}


$sekolah = new Sekolah();

$guru = new Guru("Budi", 4000000, 24);        // 4.000.000 + (24 x 50.000) = 5.200.000
$staf = new Staf("Siti", 3500000, 500000);      // 3.500.000 + 500.000 = 4.000.000
$honorer = new Honorer("Andi", 25000, 80);      // 25.000 x 80 = 2.000.000

$sekolah->tambahPegawai($guru);
$sekolah->tambahPegawai($staf);
$sekolah->tambahPegawai($honorer);

echo $guru->info() . PHP_EOL;
echo $staf->info() . PHP_EOL;
echo $honorer->info() . PHP_EOL;
echo "Total Gaji Sekolah: Rp " . number_format($sekolah->totalGaji(), 0, ',', '.') . PHP_EOL;