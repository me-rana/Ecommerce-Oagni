<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posts extends Model
{
    use HasFactory,Sluggable;
    public function sluggable(): array
    		{
      		  return [
        		  'slug' => [
              		  'source' => 'title'
            			    ]
        		];
    	}
    public function getUser() : BelongsTo{
        return $this->belongsTo(User::class, 'writer', 'id');
    }
	public function getCategory() : BelongsTo{
		return $this->belongsTo(bCategories::class, 'category', 'id');
	}

}
