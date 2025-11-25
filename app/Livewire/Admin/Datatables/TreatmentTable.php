<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Treatment;

class TreatmentTable extends DataTableComponent
{
    protected $model = Treatment::class;

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

            Column::make('Duración (min)', 'duracion')
                ->sortable(),

            Column::make('Costo', 'costo')
                ->sortable()
                ->format(function ($value) {
                    return $value ? number_format($value, 2) : '';
                }),

            Column::make('Acciones')
                ->label(function ($row) {
                    return view('admin.treatments.actions', ['treatment' => $row]);
                }),
        ];
    }
}
