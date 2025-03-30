<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModule extends Model
{
    protected $table = 'admin_modules';

    protected $fillable = [
        'name',
        'description',
        'author',
        'author_url',
        'version',
        'status',
    ];

    public static function isModuleEnabled($moduleName)
    {
        return self::where('name', $moduleName)->where('status', true)->exists();
    }

    /**
     * Check if multiple modules exist and are enabled.
     *
     * @param array|string $moduleNames
     * @return bool
     */
    public static function areModulesEnabled($moduleNames)
    {
        $moduleNames = is_array($moduleNames) ? $moduleNames : explode(',', $moduleNames);
        foreach ($moduleNames as $moduleName) {
            if (!self::isModuleEnabled(trim($moduleName))) {
                return false;
            }
        }
        return true;
    }
}
