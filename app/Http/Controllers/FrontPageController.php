<?php

namespace App\Http\Controllers;

use App\Models\LifetimePackage;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $packages = LifetimePackage::all();
        $data = session('data', null); // Retrieve 'data' from session if available
        return view('front.index', compact('packages', 'data'));
    }

    public function incomeCalculate(Request $request)
    {
        $package = LifetimePackage::where('id', $request->package_id)->first();
        if ($package) {
            if ($package->id == 1) {
                $unit = 2.777777777777778;
            } elseif ($package->id == 2) {
                $unit = 2.040816326530612;
            } else {
                $unit = 1.587301587301587;
            }

            $level1 =  ($request->level1) * (20 /  $unit);
            $level2 =  ($request->level2) * (58 /  $unit);
            $level3 =  ($request->level3) * (98 /  $unit);

            $total = $level1 + $level2 + $level3;
            $data = ['level1' => $level1, 'level2' => $level2, 'level3' => $level3, 'total' => $total];
            return redirect()->route('frontpage')->with('data', $data);
        } else {
            return ['status' => 404, 'message' => 'Sorry Invalid Package Selection'];
        }
    }
}
