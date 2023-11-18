<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class bCategories extends Model
{
    use HasFactory,Sluggable;

    public function sluggable(): array
    		{
      		  return [
        		  'curl' => [
              		  'source' => 'cname'
            			    ]
        		];
    	}
        public function getposts(){
            return $this->hasMany(Posts::class,'category','id');
        }
    }
