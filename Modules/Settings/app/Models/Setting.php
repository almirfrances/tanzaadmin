<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public $timestamps = true;

    


    public static function getValue($key, $default = null)
    {
        return self::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function setValue($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
