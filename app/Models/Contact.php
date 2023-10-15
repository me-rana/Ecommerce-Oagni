<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;



class Contact extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $fillable = ['name', 'email', 'message'];

    public static function boot() {

        parent::boot();

        static::created(function ($item) {

            $adminEmail = "irana.bpr9@gmail.com";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
