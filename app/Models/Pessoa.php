<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Pessoa extends Model
{
    use HasFactory;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'nascimento', 'genero', 'pais'
    ];

    public function pais(): HasOne
    {
        return $this->hasOne(Pais::class, 'pais');
    }

    public function getNascimentoBrAttribute(string $value): ?string
    {
        if ($value) {
            return Carbon::parse($value)->format('d/m/Y');
        }

        return null;
    }
}
