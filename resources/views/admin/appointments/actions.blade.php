@php
use Illuminate\Support\Facades\Route;
@endphp

<div class="flex items-center space-x-2">

    @if($appointment->trashed())
        @if(Route::has('appointments.restore'))
            <form action="{{ route('appointments.restore', $appointment->id) }}" method="POST" class="inline">
                @csrf
                <x-wire-button type="submit" green xs>
                    <i class="fa-solid fa-rotate-left"></i>
                </x-wire-button>
            </form>
        @endif
        @if(Route::has('appointments.destroy'))
            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <x-wire-button type="submit" red xs>
                    <i class="fa-solid fa-trash-can"></i>
                </x-wire-button>
            </form>
        @endif
    @else
        @if(Route::has('appointments.edit'))
            <x-wire-button href="{{ route('appointments.edit', $appointment) }}" blue xs>
                <i class="fa-solid fa-pen-to-square"></i>
            </x-wire-button>
        @endif
        @if(Route::has('appointments.delete'))
            <form action="{{ route('appointments.delete', $appointment) }}" method="POST" class="delete-form">
                @csrf
                <x-wire-button type="submit" red xs>
                    <i class="fa-solid fa-trash"></i>
                </x-wire-button>
            </form>
        @endif
    @endif

</div>
