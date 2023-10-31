<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Grow;

class GrowController extends Controller
{
    public function getGrowByRoute($url){
        $grow = Grow::where('cod_desc','like', $url)->first();
        return response()->json($grow);
    }
}
