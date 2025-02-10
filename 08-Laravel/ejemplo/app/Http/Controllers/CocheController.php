<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index () {
            $coches = [
                [
                    "marca" => "Mazda",
                    "modelo" => "RX7",
                    "precio" => 30000
                ],
                [
                    "marca" => "Mercedes",
                    "modelo" => "CLA",
                    "precio" => 35000
                ],
                [
                    "marca" => "Ford",
                    "modelo" => "Mustang",
                    "precio" => 40000
                ],
                [
                    "marca" => "Peugeot",
                    "modelo" => "307 MS",
                    "precio" => 20000
                ],
                [
                    "marca" => "Fiat",
                    "modelo" => "Multipla",
                    "precio" => 15000
                ],
                [
                    "marca" => "Citroen",
                    "modelo" => "C15",
                    "precio" => 12000
                ],
                [
                    "marca" => "Mitsubishi",
                    "modelo" => "Pajero",
                    "precio" => 25000
                ]
        ];

        return view('coches', ['coches' => $coches]);
    }
}
