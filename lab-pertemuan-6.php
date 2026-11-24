<?php
// LAB 6 - Abstraction & polymorphism
// Spesifikasi:
// - abstract BangunDatar: abstract luas(): float, abstract keliling(): float
// - Lingkaran(float $r), Persegi(float $sisi), PersegiPanjang(float $p, float $l)
// - interface Notifikasi { kirim(string $pesan): string }
//     Email, Whatsapp, SMS implements Notifikasi
// - function kirimSemua(array $notifikasi, string $pesan): array (hasil tiap kirim)

abstract class BangunDatar
{
    abstract public function luas(): float;
    abstract public function keliling(): float;
}

class Lingkaran extends BangunDatar
{
    private float $r;

    public function __construct(float $r)
    {
        $this->r = $r;
    }

    public function luas(): float
    {
        return pi() * $this->r * $this->r;
    }

    public function keliling(): float
    {
        return 2 * pi() * $this->r;
    }
}

class Persegi extends BangunDatar
{
    private float $sisi;

    public function __construct(float $sisi)
    {
        $this->sisi = $sisi;
    }

    public function luas(): float
    {
        return $this->sisi * $this->sisi;
    }

    public function keliling(): float
    {
        return 4 * $this->sisi;
    }
}

class PersegiPanjang extends BangunDatar
{
    private float $p;
    private float $l;

    public function __construct(float $p, float $l)
    {
        $this->p = $p;
        $this->l = $l;
    }

    public function luas(): float
    {
        return $this->p * $this->l;
    }

    public function keliling(): float
    {
        return 2 * ($this->p + $this->l);
    }
}

interface Notifikasi
{
    public function kirim(string $pesan): string;
}

class Email implements Notifikasi
{
    public function kirim(string $pesan): string
    {
        return "Email terkirim: " . $pesan;
    }
}

class Whatsapp implements Notifikasi
{
    public function kirim(string $pesan): string
    {
        return "WhatsApp terkirim: " . $pesan;
    }
}

class SMS implements Notifikasi
{
    public function kirim(string $pesan): string
    {
        return "SMS terkirim: " . $pesan;
    }
}

function kirimSemua(array $notifikasi, string $pesan): array
{
    $hasil = [];
    foreach ($notifikasi as $notif) {
        if ($notif instanceof Notifikasi) {
            $hasil[] = $notif->kirim($pesan);
        }
    }
    return $hasil;
}


$lingkaran = new Lingkaran(7);
$persegi = new Persegi(5);
$persegiPanjang = new PersegiPanjang(3, 4);

echo "Lingkaran(7) -> Luas: " . round($lingkaran->luas(), 2) . ", Keliling: " . round($lingkaran->keliling(), 2) . "\n";
echo "Persegi(5) -> Luas: " . $persegi->luas() . ", Keliling: " . $persegi->keliling() . "\n";
echo "PersegiPanjang(3,4) -> Luas: " . $persegiPanjang->luas() . ", Keliling: " . $persegiPanjang->keliling() . "\n\n";

$daftarNotif = [
    new Email(),
    new Whatsapp(),
    new SMS(),
];

$hasilKirim = kirimSemua($daftarNotif, "Halo, ini pesan notifikasi!");
foreach ($hasilKirim as $item) {
    echo $item . "\n";
}