@php
use Illuminate\Support\Facades\Route;
@endphp

<div class="flex items-center space-x-2">

    @if(Route::has('appointments.edit'))
        <x-wire-button href="{{ route('appointments.edit', $appointment) }}" blue xs>
            <i class="fa-solid fa-pen-to-square"></i>
        </x-wire-button>
    @endif

    @if(Route::has('appointments.destroy'))
        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <x-wire-button type="submit" red xs>
                <i class="fa-solid fa-trash"></i>
            </x-wire-button>
        </form>
    @endif

</div>
