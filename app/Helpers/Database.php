<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Database
{
    public static function getEnum(Model $model, string $column, $preference = [])
    {
        $tableName = $model->getTable();

        $enum = DB::selectOne("SHOW COLUMNS FROM `$tableName` WHERE Field = ?", [$column]);

        if (!empty($preference['default'])) {
            return $enum->Default ?? null;
        }


        if ($enum && preg_match("/^enum\('(.*)'\)$/", $enum->Type, $matches)) {
            return explode("','", $matches[1]);
        }

        return [];
    }
}
