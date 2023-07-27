<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'desc',
        'author_id',
    ];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id');
    }
}
