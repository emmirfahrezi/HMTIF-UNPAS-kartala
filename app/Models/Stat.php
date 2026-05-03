<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'sta';

    protected $fillable = ['label', 'value', 'icon', 'order'];
}