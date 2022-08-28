<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pais extends Model
{
    use HasFactory;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome'
    ];

    public function Pessoa(): HasMany
    {
        return $this->hasMany(Pessoa::class, 'id');
    }
}
