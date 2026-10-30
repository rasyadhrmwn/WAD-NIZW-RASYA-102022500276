<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopikBaru extends Model
{
    use HasFactory;

    protected $table = 'topik_barus';

    // Tambahkan baris ini agar error merahnya hilang
    protected $fillable = ['kode', 'nama', 'rumpun', 'deskripsi'];
}