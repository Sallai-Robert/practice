<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\str;

class Book extends Model
{
    protected $table = "Books";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'author',
        'description',
        'pdf_original',
        'pdf_printable'
    ];
     /**
     * Generate uuid
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

}
