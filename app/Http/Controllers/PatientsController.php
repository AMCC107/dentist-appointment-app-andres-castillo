<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{

    public function __construct() 
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if (!$user || !$user->roles()->whereIn('id', [2,3,4])->exists()) {
                return redirect('/');
            }

            return $next($request);
        });
    }

    public function index()
    {
        return view('patients.index');
    }

    public function create()
    {
        $doctors = User::whereHas('roles', fn($query) => $query->where('id', 2))->get();

        return view('patients.create', compact('doctors'));
    }

public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
        ]);
        Patients::create([
            'name' => $request->name,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'phone' => $request->phone,
            'address' => $request->address,
            'doctor_id' => $request->doctor_id,
        ]);
        //Variable de un solo uso para alerta
        session()->flash('swal',
        [
            'icon' => 'success',
            'title' => 'Paciente creado correctamente',
            'text' => 'El paciente ha sido creado exitosamente',
        ]);
        //Redireccionará a la tabal principal
        return redirect()->route('patients.index')->with('success', 'Paciente creado exitosamente');
    }

    public function edit(Patients $patient)
    {
        $doctors = User::whereHas('roles', fn($query) => $query->where('id', 2))->get();

        return view('patients.edit', compact('patient', 'doctors'));
    }

    public function show($id)
    {
        $patient = Patients::withTrashed()->findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    public function update(Request $request, Patients $patient)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
        ]);
        $patient->update([
            'name' => $request->name,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'phone' => $request->phone,
            'address' => $request->address,
            'doctor_id' => $request->doctor_id,
        ]);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente actualizado',
            'text' => 'El paciente fue actualizado correctamente',
        ]);
        return redirect()->route('patients.index');
    }

    public function destroy(Patients $patient)
    {
        //Physical delete
        $patient->forceDelete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente eliminado permanentemente',
            'text' => 'El paciente fue eliminado',
        ]);
        return redirect()->route('patients.index');
    }

    /**
     * Soft delete (mark deleted_at)
     */
    public function delete(Patients $patient)
    {
        $patient->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente eliminado (soft)',
            'text' => 'El paciente fue marcado como eliminado',
        ]);
        return redirect()->route('patients.index');
    }

    /**
     * Restore soft deleted patient
     */
    public function restore($id)
    {
        $patient = Patients::withTrashed()->findOrFail($id);
        $patient->restore();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente restaurado',
            'text' => 'El paciente fue restaurado',
        ]);
        return redirect()->route('patients.index');
    }
}
