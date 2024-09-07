<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    use HasFactory;
    // Note to self:
    // Menspesifikasikan primary key karena nama key di tabel aku ganti jadi 'task_id', tidak pakai default 'id'
    protected $primaryKey = 'task_id';

    // Menspesifikasikan nama tabel yg dipakai
    protected $table = 'tasklist';

    // Menspesifikasikan nama-nama atribut yg bisa dipakai
    protected $fillable = ['task_text', 'task_status', 'user_id'];
    
    // Menuliskan relasi dari User model (seorang user memiliki tugas dan sebaliknya)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
