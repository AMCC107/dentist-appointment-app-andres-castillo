<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ]
]">
    <div class="flex flex-col items-center justify-center text-center space-y-6 py-10">
        <div class="max-w-2xl space-y-3">
            <h1 class="text-3xl font-bold text-gray-800">Bienvenido a DentalPlus</h1>
            <p class="text-gray-600">
                La plataforma de gestión integral para tu clínica dental. Agenda citas,
                da seguimiento a pacientes y coordina tratamientos en un solo lugar.
            </p>
        </div>

        <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
            <img
                src="{{ asset('images/logo_nuevo.png') }}"
                alt="DentalPlus"
                class="w-40 mx-auto mb-4 opacity-80"
            >
        </div>
    </div>
</x-admin-layout>
