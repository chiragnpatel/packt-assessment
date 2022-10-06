<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'isbn13',
        'title',
        'publication_date',
        'product_type',
        'authors',
        'categories',
        'concept',
        'language',
        'language_version',
        'tool',
        'vendor',
    ];
}
