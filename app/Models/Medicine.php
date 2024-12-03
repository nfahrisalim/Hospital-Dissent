<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'expiration_date',
        'image', // Menambahkan 'image' pada $fillable
    ];

    /**
     * Menyimpan gambar ke storage dan mengupdate kolom 'image' pada record.
     */
    public static function storeImage($image)
    {
        // Menyimpan gambar ke storage dan mengembalikan path relatifnya
        $imagePath = $image->store('medicines', 'public'); // Penyimpanan di folder 'public/medicines'
        return $imagePath;
    }

    /**
     * Menghapus gambar terkait dengan obat.
     */
    public function deleteImage()
    {
        // Menghapus gambar dari storage
        if ($this->image && Storage::exists('public/' . $this->image)) {
            Storage::delete('public/' . $this->image);
        }
    }
}
