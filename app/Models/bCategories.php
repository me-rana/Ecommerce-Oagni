<?php

namespace App\Models;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        public function getposts() : HasMany{
            return $this->hasMany(Posts::class,'category','id');
        }
		
		public function getUser() : BelongsTo {
			return $this->belongsTo(User::class, 'cuid', 'id');
		}
    }
