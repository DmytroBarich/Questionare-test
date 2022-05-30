<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    public const GENDERS = [self::GENDER_MALE, self::GENDER_FEMALE];
    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public const TYPES = [self::STRING_TYPE, self::DATE_TYPE, self::INTEGER_TYPE];
    public const STRING_TYPE = 'string';
    public const INTEGER_TYPE = 'integer';
    public const DATE_TYPE = 'date';

    protected $fillable = ['title', 'slug', 'description', 'required', 'type', 'max', 'min'];

    public function setTitleAttribute($value)
    {
        if (empty($this->slug)) {
            $this->attributes['slug'] = Str::slug($value);
        }
        $this->attributes['title'] = $value;
    }
}
