<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Treatment;
use App\Models\User;

class AppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Fecha', 'fecha_hora')
                ->sortable()
                ->format(function ($value) {
                    return optional($value)->format('d/m/Y H:i');
                }),

            Column::make('Paciente', 'paciente_id')
                ->label(function ($row) {
                    $p = Patients::find($row->paciente_id);
                    return $p ? $p->name : $row->paciente_id;
                }),

            Column::make('Tratamiento', 'tratamiento_id')
                ->label(function ($row) {
                    $t = Treatment::find($row->tratamiento_id);
                    return $t ? $t->nombre : $row->tratamiento_id;
                }),

            Column::make('Doctor', 'doctor_id')
                ->label(function ($row) {
                    $d = User::find($row->doctor_id);
                    return $d ? $d->name : $row->doctor_id;
                }),

            Column::make('Acciones')
                ->label(function ($row) {
                    return view('admin.appointments.actions', ['appointment' => $row]);
                }),
        ];
    }
}
