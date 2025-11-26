<x-admin-layout title="Tratamientos | DentalPlus" :breadcrumbs="[
    ['name'=> 'Dashboard', 'href'=> route('admin.dashboard')],
    ['name'=> 'Tratamientos', 'href'=> route('treatments.index')],
    ['name'=> 'Editar'],
]">

    <x-slot name="actions">
        <x-wire-button href="{{ route('treatments.index') }}" gray>
            <i class="fa-solid fa-arrow-left"></i>
            Regresar
        </x-wire-button>
    </x-slot>

    <x-wire-card>
        <form action= "{{ route('treatments.update', $treatment) }}" method="POST">
            @csrf
            @method('PUT')
            <x-wire-input label="Nombre" name="nombre" placeholder="Nombre del tratamiento" value="{{ old('nombre', $treatment->nombre ?? '') }}"></x-wire-input>
            <x-wire-input label="Duración (min)" name="duracion" type="number" placeholder="Duración en minutos" value="{{ old('duracion', $treatment->duracion ?? '') }}"></x-wire-input>
            <x-wire-input label="Costo" name="costo" type="number" step="0.01" placeholder="Precio" value="{{ old('costo', $treatment->costo ?? '') }}"></x-wire-input>
            <x-wire-input label="Cuidados" name="cuidados" placeholder="Indicaciones" value="{{ old('cuidados', $treatment->cuidados ?? '') }}"></x-wire-input>
            <div class="mt-4">
                <label for="doctor_id" class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                <select id="doctor_id" name="doctor_id" class="w-full rounded border-gray-300 p-2">
                    <option value="">-- Seleccione --</option>
                    @isset($doctors)
                        @foreach($doctors as $d)
                            <option value="{{ $d->id }}" {{ old('doctor_id', $treatment->doctor_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <div class="flex justify-end mt-4">
                <x-wire-button type="submit" blue>Actualizar</x-wire-button>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
