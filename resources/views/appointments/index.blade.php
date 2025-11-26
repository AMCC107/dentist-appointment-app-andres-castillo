<x-admin-layout title="Citas | DentalPlus" :breadcrumbs="[
     ['name'=> 'Dashboard', 'href'=> route('admin.dashboard')],
     ['name'=> 'Citas'],
]">

     {{-- Botón "Nuevo --}}
     <x-slot name="actions">
          <div class="flex justify-end">
               <x-wire-button href="{{ route('appointments.create') }}" blue>
                    <i class="fa-solid fa-plus"></i>
                    <span class="ml-1">Nuevo</span>
               </x-wire-button>
          </div>
     </x-slot>

     {{-- Tabla Livewire --}}
     @livewire('admin.datatables.appointment-table')

</x-admin-layout>
