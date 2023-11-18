<?php

namespace App\Models;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getproducts(){
        return $this->hasMany(Products::class,'category','id');
    }
}
