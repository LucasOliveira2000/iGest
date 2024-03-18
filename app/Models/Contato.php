<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'nome',
        'telefone',
        'email',
        'mensagem'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->uuid = (string) Str::uuid();
        });
    }
}
