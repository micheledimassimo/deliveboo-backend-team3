<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Typology;

class TypologyController extends Controller
{
    public function index(){
        $typologies = Typology::orderBy('typology_name', 'asc')->get();

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => [
                'typologies' => $typologies
            ]
        ]);
    }

    public function show(Typology $typology){
        $typology = Typology::orderBy('typology_name', 'asc')->get();

        if($typology){
            return response()->json([
                'success' => true,
                'code' => 200,
                'data' => [
                    'typology' => $typology
                ]
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Tipologia non trovata'
            ]);
        }

    }
}
