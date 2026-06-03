<?php

namespace App\Models;

use App\Traits\GeneratesId;
use Illuminate\Database\Eloquent\Model;

class DeveloperTeamSetting extends Model
{
    use GeneratesId;

    protected static string $idPrefix = 'dts';

    protected $fillable = ['title', 'description'];
}
