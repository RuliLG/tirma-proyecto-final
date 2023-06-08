<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StoredProcedure extends Model
{
    use \Sushi\Sushi;

    protected static string $spName = '';
    protected static array $params = [];

    public static function procedure(string $spName, array $params = [])
    {
        static::$spName = $spName;
        static::$params = $params;
        return new static();
    }

    public function toQuery()
    {
        $escapedParams = join(', ', array_map(fn ($param) => '?', self::$params));
        return DB::query()
            ->selectRaw('* FROM (CALL ' . self::$spName . '(' . $escapedParams . '))', self::$params);
    }

    public function getRows(): array
    {
        return $this->toQuery()->get()->toArray();
    }
}
