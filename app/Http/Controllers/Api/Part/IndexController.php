<?php

namespace App\Http\Controllers\Api\Part;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpinePart;

class IndexController extends Controller
{
    public function __invoke($part)
    {
        $mappedPartsD = ['D1','D2','D3','D4','D5'];
        $mappedPartsH20 = ['H2O_1','H2O_2'];
        if(in_array($part, $mappedPartsD)){
            $result = SpinePart::where('part_name', 'D')->get();
        }
        else if(in_array($part, $mappedPartsH20)){
            $result = SpinePart::where('part_name', 'H20')->get();
        }
        else{
            $result = SpinePart::where('part_name', $part)->get();
        }
        return $result;
    }
}
