<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public const ADMIN_ROLE_ID = 1;
    public const USER_ROLE_ID = 2;
}
