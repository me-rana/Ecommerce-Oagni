<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory,Sluggable;
    protected  $primaryKey = 'id';
    public function sluggable(): array
    {
        return [
          'slug' => [
                'source' => 'pro_name'
                    ]
        ];
}
    public function getSeller() : BelongsTo {
        return $this->belongsTo(User::class, 'seller', 'id');
    }
}
