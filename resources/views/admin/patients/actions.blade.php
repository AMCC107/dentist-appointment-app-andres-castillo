@php
use Illuminate\Support\Facades\Route;
@endphp

<div class="flex items-center space-x-2">

    @if($patient->trashed())
        @if(Route::has('patients.restore'))
            <form action="{{ route('patients.restore', $patient->id) }}" method="POST" class="inline">
                @csrf
                <x-wire-button type="submit" green xs>
                    <i class="fa-solid fa-rotate-left"></i>
                </x-wire-button>
            </form>
        @endif
        @if(Route::has('patients.destroy'))
            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <x-wire-button type="submit" red xs>
                    <i class="fa-solid fa-trash-can"></i>
                </x-wire-button>
            </form>
        @endif
    @else
        @if(Route::has('patients.edit'))
            <x-wire-button href="{{ route('patients.edit', $patient) }}" blue xs>
                <i class="fa-solid fa-pen-to-square"></i>
            </x-wire-button>
        @endif
        @if(Route::has('patients.delete'))
            <form action="{{ route('patients.delete', $patient) }}" method="POST" class="delete-form">
                @csrf
                <x-wire-button type="submit" red xs>
                    <i class="fa-solid fa-trash"></i>
                </x-wire-button>
            </form>
        @endif
    @endif

</div>
