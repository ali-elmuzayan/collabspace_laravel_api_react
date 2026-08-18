<?php

namespace App\Stats;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function index()
    {
        // stats
        $hits = Cache::rememberForever('stats:cache:hits', function () {
            return '0';
        });
        $misses = Cache::rememberForever('stats:cache:misses', function () {
            return '0';
        });

        $data = [];
        $data['hits'] = $hits;
        $data['misses'] = $misses;

        return $data;
    }
}
