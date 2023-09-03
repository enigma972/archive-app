<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Directory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public static function getDirSize($dir_name)
    {
        $dir_size = 0;
        if (is_dir($dir_name)) {
            if ($dh = opendir($dir_name)) {
                while (false !== ($file = readdir($dh))) {
                    if ($file != '.' && $file != '..') {
                        if (is_file($dir_name . '/' . $file)) {
                            $dir_size += filesize($dir_name . '/' . $file);
                        }
                        /* check for any new directory inside this directory */
                        if (is_dir($dir_name . '/' . $file)) {
                            $dir_size +=  self::getDirSize($dir_name . '/' . $file);
                        }
                    }
                }
                closedir($dh);
            }
        }

        return $dir_size;
    }
}
