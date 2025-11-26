<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patients;
use Carbon\Carbon;

class PatientsTable extends DataTableComponent
{
    protected $model = Patients::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Teléfono', 'phone')
                ->sortable(),

            Column::make('Fecha Nac.', 'fecha_nacimiento')
                ->sortable()
                ->format(fn($value) => $value
                    ? ($value instanceof Carbon ? $value : Carbon::parse($value))->format('d/m/Y')
                    : ''),

            Column::make('Acciones')
                ->label(function ($row) {
                    return view('admin.patients.actions', ['patient' => $row]);
                }),
        ];
    }
}
