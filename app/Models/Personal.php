<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';

    protected $primaryKey = 'ID';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'ID',
        'apellido',
        'nombre',
        'fecha_nacimiento',
        'codigo_estudiantil',
        'programa',
        'semestre',
        'correo',
        'telefono',
        'direccion'
    ];
}
