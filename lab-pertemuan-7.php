<?php
// LAB 7 — Trait (bagian namespace & Composer dikerjakan lokal di Laragon,
//         kirim tautan repositori GitHub pada kolom tautan)
// Spesifikasi:
//  - trait Timestampable: touch(): void (isi createdAt), getCreatedAt(): ?string
//  - Buku(string $judul) dan Anggota(string $nama) memakai Timestampable

trait Timestampable
{
    private ?string $createdAt =null;
    
    public function touch(): void
    {
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

}

class Buku
{
    use Timestampable;
    
    public string $judul;
    
    public function __construct(string $judul)
    {
        $this->judul = $judul;
        $this->touch();
    }
}

class Anggota
{
    use Timestampable;
    
    public string $nama;
    
    public function __construct(string $nama)
    { 
        $this->nama = $nama;
        $this->touch();
    }
    
}
