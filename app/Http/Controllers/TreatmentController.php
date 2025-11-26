<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TreatmentController extends BaseController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if (!$user || !$user->roles()->whereIn('id', [2, 4])->exists()) {
                return redirect('/');
            }

            return $next($request);
        });
    }

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
        $doctors = User::whereHas('roles', fn($query) => $query->where('id', 2))->get();

        return view('treatments.create', compact('doctors'));
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
        $doctors = User::whereHas('roles', fn($query) => $query->where('id', 2))->get();

        return view('treatments.edit', compact('treatment', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'nombre' => 'required|unique:treatments,nombre,' . $treatment->id,
            'duracion' => 'nullable|integer',
            'costo' => 'nullable|numeric',
        ]);
        if ($treatment->nombre === $request->nombre && $treatment->duracion == $request->duracion && $treatment->costo == $request->costo) {
            session()->flash('swal', [
                'icon' => 'info',
                'title' => 'Sin cambios',
                'text' => 'No se detectaron modificaciones',
            ]);
            return redirect()->route('treatments.edit', $treatment);
        }

        $treatment->update([
            'nombre' => $request->nombre,
            'duracion' => $request->duracion,
            'costo' => $request->costo,
            'cuidados' => $request->cuidados,
            'doctor_id' => $request->doctor_id,
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
        $treatment->forceDelete();

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

    public function delete(Treatment $treatment)
    {
        $treatment->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Tratamiento eliminado (soft)',
            'text' => 'El tratamiento fue marcado como eliminado',
        ]);
        return redirect()->route('treatments.index');
    }

    public function restore($id)
    {
        $treatment = Treatment::withTrashed()->findOrFail($id);
        $treatment->restore();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Tratamiento restaurado',
            'text' => 'El tratamiento fue restaurado',
        ]);
        return redirect()->route('treatments.index');
    }
}
