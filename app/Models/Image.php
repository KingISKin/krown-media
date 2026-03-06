<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'client_id',
        'image_category_id',
        'title',
        'file_name',
        'path',
        'width',
        'height',
        'size'
    ];

    /*
    RELACIONAMENTO COM CLIENTE
    */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /*
    RELACIONAMENTO COM CATEGORIA
    */
    public function category()
    {
        return $this->belongsTo(ImageCategory::class, 'image_category_id');
    }
}