<?php

namespace Sz6\Permission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rolepermission extends Model
{
    use HasFactory;

    protected $table = 'rolepermissions';

    protected $fillable = [
        'roleId',
        'permission',
    ];

}
