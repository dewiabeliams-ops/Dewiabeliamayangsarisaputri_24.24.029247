<?php
declare(strict_types=1);
// LAB 4 — Static, const, fitur PHP 8
// Spesifikasi:
//  - Mahasiswa(public readonly string $nim, public string $nama)  (constructor promotion)
//      const BATAS_SKS = 24
//      static getJumlah(): int  -> jumlah object Mahasiswa yang pernah dibuat
//  - enum Semester: string { Ganjil = 'ganjil', Genap = 'genap' }
//  - enum Predikat dengan method label(): string

class Mahasiswa
{
    public const int BATAS_SKS = 24;

    private static int $jumlah = 0;

    public function __construct(
        public readonly string $nim,
        public string $nama,
    ) {
        self::$jumlah++;
    }

    public static function getJumlah(): int
    {
        return self::$jumlah;
    }
}

enum Semester: string
{
    case Ganjil = 'ganjil';
    case Genap = 'genap';
}

enum Predikat
{
    case Cumlaude;
    case SangatMemuaskan;
    case Memuaskan;
    case Cukup;

    public function label(): string
    {
        return match ($this) {
            self::Cumlaude => 'Dengan Pujian (Cumlaude)',
            self::SangatMemuaskan => 'Sangat Memuaskan',
            self::Memuaskan => 'Memuaskan',
            self::Cukup => 'Cukup',
        };
    }
}

