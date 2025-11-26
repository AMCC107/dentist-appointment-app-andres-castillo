<x-admin-layout title="Pacientes | DentalPlus" :breadcrumbs="[
    ['name'=> 'Dashboard', 'href'=> route('admin.dashboard')],
    ['name'=> 'Pacientes', 'href'=> route('patients.index')],
    ['name'=> 'Nuevo'],
]">

    <x-slot name="actions">
        <x-wire-button href="{{ route('patients.index') }}" gray>
            <i class="fa-solid fa-arrow-left"></i>
            Regresar
        </x-wire-button>
    </x-slot>

    <x-wire-card>
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <x-wire-input label="Nombre" name="name" placeholder="Nombre del paciente" value="{{ old('name') }}"></x-wire-input>

            <x-wire-input label="Email" name="email" placeholder="email@dominio.com" value="{{ old('email') }}"></x-wire-input>

            <x-wire-input label="Fecha nacimiento" name="fecha_nacimiento" type="date" placeholder="YYYY-MM-DD" value="{{ old('fecha_nacimiento') }}"></x-wire-input>

            <x-wire-input label="Teléfono" name="phone" placeholder="Número telefónico" value="{{ old('phone') }}"></x-wire-input>

            <x-wire-input label="Dirección" name="address" placeholder="Dirección" value="{{ old('address') }}"></x-wire-input>

            <div class="mt-4">
                <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                <select id="doctor_id" name="doctor_id" class="w-full rounded border-gray-300 p-2">
                    <option value="">-- Seleccione --</option>
                    @isset($doctors)
                        @foreach($doctors as $d)
                            <option value="{{ $d->id }}" {{ old('doctor_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>Guardar</x-wire-button>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
