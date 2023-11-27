<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pCategories extends Model
{
    use HasFactory, Sluggable;
    public function sluggable(): array
    		{
      		  return [
        		  'purl' => [
              		  'source' => 'pname'
            			    ]
        		];
    	}

    public function getproducts() : HasMany{
        return $this->hasMany(Products::class,'category','id');
    }
	public function getUser() : BelongsTo {
        return $this->belongsTo(User::class, 'puid', 'id');
    }
}
