<x-admin-layout title="Citas | DentalPlus" :breadcrumbs="[
    ['name'=> 'Dashboard', 'href'=> route('admin.dashboard')],
    ['name'=> 'Citas', 'href'=> route('appointments.index')],
    ['name'=> 'Editar'],
]">

    <x-slot name="actions">
        <x-wire-button href="{{ route('appointments.index') }}" gray>
            <i class="fa-solid fa-arrow-left"></i>
            Regresar
        </x-wire-button>
    </x-slot>

    <x-wire-card>
        <form action= "{{ route('appointments.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')
            <x-wire-input label="Nombre" name="nombre" placeholder="Título de la cita" value="{{ old('nombre', $appointment->nombre ?? '') }}"></x-wire-input>
            <x-wire-input label="Fecha y hora" name="fecha_hora" type="datetime-local" placeholder="YYYY-MM-DD HH:MM" value="{{ old('fecha_hora', $appointment->fecha_hora) }}"></x-wire-input>

            <div class="mt-4">
                <label for="paciente_id" class="block text-sm font-medium text-gray-700 mb-1">Paciente</label>
                <select id="paciente_id" name="paciente_id" class="w-full rounded border-gray-300 p-2">
                    <option value="">-- Seleccione --</option>
                    @foreach($patients as $p)
                        <option value="{{ $p->id }}" {{ old('paciente_id', $appointment->paciente_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="tratamiento_id" class="block text-sm font-medium text-gray-700 mb-1">Tratamiento</label>
                <select id="tratamiento_id" name="tratamiento_id" class="w-full rounded border-gray-300 p-2">
                    <option value="">-- Seleccione --</option>
                    @foreach($treatments as $t)
                        <option value="{{ $t->id }}" {{ old('tratamiento_id', $appointment->tratamiento_id) == $t->id ? 'selected' : '' }}>{{ $t->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                <select id="doctor_id" name="doctor_id" class="w-full rounded border-gray-300 p-2">
                    <option value="">-- Seleccione --</option>
                    @foreach($doctors as $d)
                        <option value="{{ $d->id }}" {{ old('doctor_id', $appointment->doctor_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>Actualizar</x-wire-button>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
