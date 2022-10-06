<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    const BOOK = 1;
    const Video = 2;
    use SoftDeletes, HasFactory;

    protected $table = 'product_detail';

    protected $fillable = [
        'product_id',
        'isbn13',
        'isbn10',
        'isbns',
        'title',
        'product_type',
        'tagline',
        'pages',
        'publication_date',
        'length',
        'learn',
        'features',
        'description',
        'authors',
        'url',
        'category',
        'concept',
        'expertise',
        'languages',
        'tools',
        'jobroles',
        'vendors',
        'images'
    ];
}
