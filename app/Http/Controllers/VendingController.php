<?php

namespace App\Http\Controllers;
use App\Models\Device;

use Illuminate\Http\Request;

class VendingController extends Controller
{
    // Показать все автоматы
    public function showAll()
    {
        $devices = Device::with('products')->get();

        return view('home', [
            'devices' => $devices,
        ]);
       
    }
}
