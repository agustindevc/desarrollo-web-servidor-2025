<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index () {
            $coches = [
                ["Mazda", "RX7", 30000],
                ["Mercedes", "CLA", 35000],
                ["Ford", "Mustang", 40000],
                ["Peugeot", "307 MS", 20000],
                ["Fiat", "Multipla", 15000],
                ["Citroen", "C15", 12000],
                ["Mitsubishi", "Pajero", 25000]
        ];

        return view('coches', ['coches' => $coches]);
    }
}
