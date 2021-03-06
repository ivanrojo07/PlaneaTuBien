<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use App\Banco;
use App\TipoContrato;
use App\TipoBaja;
use App\TipoArea;
use App\TipoPuesto;
use App\Sucursal;
use App\EmpleadoDatoLab;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use UxWeb\SweetAlert\SweetAlert as Alert;

class EmpleadoDatoLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Empleado $empleado)
    {
        //
        $dato_lab= $empleado->datos_laborales->last();
        $historial = $empleado->datos_laborales()->paginate(5);
        return view('empleado.datoslaborales.index',['empleado'=>$empleado,'dato_lab'=>$dato_lab,'historial'=>$historial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Empleado $empleado)
    {
        $datoslab = new EmpleadoDatoLab;
        $contratos = TipoContrato::get();
        $bajas = TipoBaja::get();
        $areas =   TipoArea::get();
        $puestos = TipoPuesto::get();
        $bancos=Banco::get();
        $edit = false;
        
        return view('empleado.datoslaborales.create',[
            'empleado'=>$empleado,
            'bajas'=>$bajas,
            'contratos'=>$contratos,
            'datoslab'=>$datoslab,
            'areas'=>$areas, 
            'puestos'=>$puestos,
            'edit'=>$edit,
            'bancos'=>$bancos]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datoslab = EmpleadoDatoLab::create($request->all());
        $empleado = Empleado::find($request->empleado_id);

        // if ($request->puntualidad == 'on') {
        //     # code...
        //     $datoslab->puntualidad = true;
        //     // dd($request->all());
        // } else {
        //     # code...
        //     $datoslab->puntualidad = false;
        // }
    //--------- BAJA --------------------------------
        if($request->fechabaja!=null){
            $empleado->delete();
            Alert::success('Baja de Empleado', 'Se redireccionará a la Lista de Empleados');
            return redirect()->route('empleados.index');
        }else{
            $empleado->datos_laborales()->save($datoslab);
            Alert::info('Datos laborales creado', 'Siga agregando información al empleado');
            return redirect()->route('empleados.laborals.index',['empleado'=>$empleado]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmpleadoDatoLab  $empleadoDatoLab
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoDatoLab $empleadoDatoLab)
    {
        //
    }
}
