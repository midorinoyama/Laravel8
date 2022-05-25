<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'book_title',
        'author',
        'title',
        'body',
        'readed_on',
    ];

    //$fillableが多い場合は$guardedも可能（id=編集してはいけない項目の設定）
    //protected $guarded = ['id'];

    protected $dates = [
        'readed_on'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
