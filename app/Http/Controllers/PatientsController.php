<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index()
    {
        return view('patients.index');
    }

    public function create()
    {
        return view('patients.create');
    }

public function store(Request $request)
    {
        //Validar que se cree bien
        $request->validate(['name' => 'required']);

        //Si pasa la validación, creará el rol
        Patients::create([
            'nombre' => $request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'phone' => $request->phone,
            'address' => $request->address,
            'doctor_id' => $request->doctor_id
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
        return view('admin.users.edit', compact('patient'));
    }

    public function update(Request $request, Patients $patient)
    {

    }

    public function destroy(Patients $patient)
    {

    }
}
