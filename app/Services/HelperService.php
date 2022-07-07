<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class HelperService
{
    public static function formattedDate($date, $format = 'Y/m/d', $showDayName = false, $timeFormat = null)
    {
        $dateType = gettype($date);

        $parsedDate = Carbon::parse($date);
        if ($dateType == 'integer') {
            $parsedDate = Carbon::createFromTimestamp($date);
        }

        if ($showDayName) {
            $days = array("日", "月", "火", "水", "木", "金", "土");

            if ($timeFormat) {
                return $parsedDate->format($format) . ' (' . $days[$parsedDate->copy()->format('w')] . ') ' . $parsedDate->format($timeFormat);
            }
            return $parsedDate->format($format) . ' (' . $days[$parsedDate->copy()->format('w')] . ')';
        }
        return $parsedDate->format($format);

        // return Carbon::parse($date, 'Asia/Tokyo')->locale('ja')->translatedFormat('Y/m/d H:i:s');
        //return Carbon::parse($date)->translatedFormat($format);
    }

    public static function getMAxItemLimit($itemPerPage = 50)
    {
        $request = app('request');

        if ($request->has('per_page')) {
            return $request->per_page > 500 ? 500 : $request->per_page;
        }
        return $itemPerPage;
    }

    public static function extractKeywords($input, $limit = -1)
    {
        return array_values(array_unique(preg_split('/[\p{Z}\p{Cc}]++/u', $input, $limit, PREG_SPLIT_NO_EMPTY)));
    }

    public static function generateFileName($prefix = 'export', $extension = '.csv')
    {
        $current = Carbon::now()->format('YmdHis');

        return $prefix . $current . $extension;
    }

    public static function paginate($results, $pageSize)
    {
        $results = $results instanceof Collection ? $results : Collection::make($results);

        $page = Paginator::resolveCurrentPage('page');
        return self::paginator($results->forPage($page, $pageSize), $results->count(), $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }

    public static function calculatePrice($unitPrice, $unitQty, $qty, $purchaseQty)
    {
        $newPrice = round((($unitPrice * $qty) / $unitQty), 2) * $purchaseQty;

        return $newPrice;
    }

    public static function generateAlphanumericRandomKey($length = 6)
    {
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';

        $key = substr(str_shuffle($str), 0, $length);

        return strtoupper($key);
    }

}
