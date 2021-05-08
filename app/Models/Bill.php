<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        "user_id",
        "category_id",
        "image_id",
        "seller",
        "total",
        "payment_date",
        "address",
        "note",
        "status"
    ];

    public function image() {
        return $this->belongsTo(Image::class, "image_id", "id");
    }

    public function category() {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}
