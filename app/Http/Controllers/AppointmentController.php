<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Treatment;
use App\Models\User;

class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Aquí es donde se carga la vista de roles
        return view('appointments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patients::all();
        $treatments = Treatment::all();
        $doctors = User::whereHas('roles', fn($query) => $query->where('id', 2))->get();

        return view('appointments.create', compact('patients', 'treatments', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validación
        $request->validate([
            'nombre' => 'required',
            'fecha_hora' => 'required|date',
        ]);

        //Crear cita
        Appointment::create([
            'nombre' => $request->nombre,
            'fecha_hora' => $request->fecha_hora,
            'doctor_id' => $request->doctor_id,
            'paciente_id' => $request->paciente_id,
            'tratamiento_id' => $request->tratamiento_id,
        ]);
        //Variable de un solo uso para alerta
        session()->flash('swal',
        [
            'icon' => 'success',
            'title' => 'Cita creada correctamente',
            'text' => 'La cita ha sido creada exitosamente',
        ]);
        //Redireccionará a la tabal principal
        return redirect()->route('appointments.index')->with('success', 'Appointment created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::withTrashed()->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $patients = Patients::all();
        $treatments = Treatment::all();
        $doctors = User::whereHas('roles', fn($query) => $query->where('id', 2))->get();

        return view('appointments.edit', compact('appointment', 'patients', 'treatments', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'nombre' => 'required',
            'fecha_hora' => 'required|date',
        ]);

        $appointment->update([
            'nombre' => $request->nombre,
            'fecha_hora' => $request->fecha_hora,
            'doctor_id' => $request->doctor_id,
            'paciente_id' => $request->paciente_id,
            'tratamiento_id' => $request->tratamiento_id,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita actualizada correctamente',
            'text' => 'La cita ha sido actualizada exitosamente',
        ]);
        return redirect()->route('appointments.index');
    }

    /**
     * Soft delete (marca con deleted_at) — ruta: appointments.delete
     */
    public function delete(Appointment $appointment)
    {
        $appointment->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita eliminada (soft)',
            'text' => 'La cita fue marcada como eliminada',
        ]);
        return redirect()->route('appointments.index');
    }

    /**
     * Permanently remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->forceDelete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita eliminada permanentemente',
            'text' => 'La cita fue eliminada permanentemente',
        ]);
        return redirect()->route('appointments.index');
    }

    /**
     * Restore a soft-deleted appointment.
     */
    public function restore($id)
    {
        $appointment = Appointment::withTrashed()->findOrFail($id);
        $appointment->restore();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita restaurada',
            'text' => 'La cita fue restaurada exitosamente',
        ]);
        return redirect()->route('appointments.index');
    }

}
