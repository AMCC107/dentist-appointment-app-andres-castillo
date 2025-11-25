<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Treatment;

class TreatmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Aquí es donde se carga la vista de roles
        return view('treatments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('treatments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validar que se cree bien
        $request->validate(['nombre' => 'required']);

        //Si pasa la validación, creará el rol
        Treatment::create([
            'nombre' => $request->nombre,
            'duracion' => $request->duracion,
            'costo' => $request->costo,
            'cuidados' => $request->cuidados,
            'doctor_id' => $request->doctor_id
        ]);
        //Variable de un solo uso para alerta
        session()->flash('swal',
        [
            'icon' => 'success',
            'title' => 'Tratamiento creado correctamente',
            'text' => 'El tratamiento ha sido creado exitosamente',
        ]);
        //Redireccionará a la tabal principal
        return redirect()->route('treatments.index')->with('success', 'Tratamiento creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        //Restringir la acción para los primeros 4 roles fijos
        if ($treatment->id <=4){
            //Variable de un solo uso
            session()->flash('swal',[
                'icon' => 'error',
                'title' => 'Acción no permitida',
                'text' => 'No puedes editar este rol.',
            ]);
            return redirect()->route('treatments.index');
        }
        return view('treatments.edit', compact('treatment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        //Validar que se inserte bien
        $request->validate(['nombre' => 'required|unique:treatments,nombre,' . $treatment->id]);

        //Si el campo no cambió no actualices
        if ($treatment->nombre === $request->nombre) {
            session()->flash('swal',
            [
                'icon' => 'info',
                'title' => 'Sin cambios',
                'text' => 'No se detectaron modificaciones',
            ]);
            return redirect()->route('treatments.edit', $treatment);
        }

        //Si pasa la validación, creará el rol
        $treatment->update([
            'name' => $request->name,
        ]);
        //Variable de un solo uso para alerta
        session()->flash('swal',
        [
            'icon' => 'success',
            'title' => 'Tratamiento creado correctamente',
            'text' => 'El tratamiento ha sido actualizado exitosamente',
        ]);
        //Redireccionará a la tabal principal
        return redirect()->route('treatments.index', $treatment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        //Restringir la acción para los primeros 4 roles fijos
        if ($treatment->id <=4){
            //Variable de un solo uso
            session()->flash('swal',[
                'icon' => 'error',
                'title' => 'Acción no permitida',
                'text' => 'No puedes eliminar este tratamiento.',
            ]);
            return redirect()->route('treatments.index');
        }
        //Borrar el elemento
        $treatment->delete();

        //Alerta
        session()->flash('swal',
        [
            'icon' => 'success',
            'title' => 'Tratamiento eliminado correctamente',
            'text' => 'El tratamiento ha sido eliminado exitosamente',
        ]);
        //Redireccionar al mismo lugar
        return redirect()->route('treatments.index');
    }
}
