<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nama', 'nim', 'alamat', 'telp'
    ];
}
