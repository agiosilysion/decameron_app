<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Hotel;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $habitaciones = Habitacion::where('hotel_id', $request->hotel_id)->get();
        return $habitaciones;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $numero_habitaciones = 0;
        $hoteles = Hotel::where('id', $request->hotel_id)->get();
        foreach ($hoteles as $hotel) {
            $numero_habitaciones = $hotel->numero_habitaciones;
            break;
        }

        $suma_habitaciones = 0;
        $total_habitaciones = Habitacion::select(Habitacion::raw('SUM(cantidad) as total_habitaciones'))
        ->where('hotel_id', $request->hotel_id)
        ->get();

        foreach ($total_habitaciones as $total) {
            $suma_habitaciones = $total->total_habitaciones;
            break;
        }

        $habitaciones = Habitacion::where('hotel_id', $request->hotel_id)->where('tipo_habitacion_id', $request->tipo_habitacion_id)->where('acomodacion_id', $request->acomodacion_id)->get();
        if (sizeof($habitaciones) === 0 || $habitaciones === null) {
            if ($suma_habitaciones + $request->cantidad > $numero_habitaciones) {
                return "No se puede exceder el número de habitaciones";
            }

            $habitacion = new Habitacion();
            $habitacion->hotel_id = $request->hotel_id;
            $habitacion->tipo_habitacion_id = $request->tipo_habitacion_id;
            $habitacion->acomodacion_id = $request->acomodacion_id;
            $habitacion->cantidad = $request->cantidad;
            $habitacion->save();

            return $habitacion;
        }
        else {
            foreach ($habitaciones as $habitacion) {
                if ($suma_habitaciones + $request->cantidad - $habitacion->cantidad > $numero_habitaciones) {
                    return "No se puede exceder el número de habitaciones";
                }

                $habitacion->cantidad = $request->cantidad;
                $habitacion->save();

                return $habitacion;
            }
            return null;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
