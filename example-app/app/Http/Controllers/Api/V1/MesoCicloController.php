<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MesoCicloController extends Controller
{
    //

    public function index() {
        $mesociclos = DB::table('mesociclo')->get();

        return response()->json($mesociclos);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'descripcion' => [
                'required',
                'regex:/^[a-zA-Z0-9 .,!?-]*$/'
            ],
            'fecha_creacion' => [
                'required',
                'regex:/^(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/'
            ],
        ];

        $messages = [
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.regex' => 'El formato del campo descripcion no es válido.',
            //fecha creacion mensajes
            'fecha_creacion.required' => 'El campo fecha_creacion es obligatorio.',
            'fecha_creacion.regex' => 'El formato del campo fecha_creacion no es válido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $id = DB::table('mesociclo')->insertGetId(
            [
                'descripcion' => $request['descripcion'], 
                'fecha_creacion' => $request['fecha_creacion']
            ]
        );

        return response()->json(['id'=> $id], 201);


    }

}
