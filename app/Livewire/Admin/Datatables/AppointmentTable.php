<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Treatment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class AppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;

    public function builder(): Builder
    {
        return Appointment::query()
            ->with([
                'paciente:id,name',
                'tratamiento:id,nombre',
                'doctor:id,name',
            ]);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id','id')
                ->sortable(),

            Column::make('Nombre','nombre')
                ->sortable()
                ->searchable(),

            Column::make('Fecha','fecha_hora')
                ->sortable()
                ->format(fn($value) => $value
                    ? ($value instanceof Carbon ? $value : Carbon::parse($value))->format('d/m/Y H:i')
                    : ''),

            Column::make('Paciente','paciente_id')
                ->format(fn($value, $row) => optional($row->paciente)->name ?? ''),

            Column::make('Tratamiento','tratamiento_id')
                ->format(fn($value, $row) => optional($row->tratamiento)->nombre ?? ''),

            Column::make('Doctor','doctor_id')
                ->format(fn($value, $row) => optional($row->doctor)->name ?? ''),

            Column::make('Acciones')
                ->label(fn($row) => view('admin.appointments.actions', ['appointment' => $row])),
        ];
    }
}
