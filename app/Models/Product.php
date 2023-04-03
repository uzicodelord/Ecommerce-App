<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination;
class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function averageRating()
    {
        $total = 0;
        foreach ($this->ratings as $rating) {
            $total += $rating->rating;
        }
        return $this->ratings->count() > 0 ? round($total / $this->ratings->count(), 1) : 0;
    }

    public function hasUserRated($userId)
    {
        return $this->ratings()->where('user_id', $userId)->exists();
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }


}
