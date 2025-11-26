@php
use Illuminate\Support\Facades\Route;
@endphp

<div class="flex items-center space-x-2">

    @if($treatment->trashed())
        @if(Route::has('treatments.restore'))
            <form action="{{ route('treatments.restore', $treatment->id) }}" method="POST" class="inline">
                @csrf
                <x-wire-button type="submit" green xs>
                    <i class="fa-solid fa-rotate-left"></i>
                </x-wire-button>
            </form>
        @endif
        @if(Route::has('treatments.destroy'))
            <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <x-wire-button type="submit" red xs>
                    <i class="fa-solid fa-trash-can"></i>
                </x-wire-button>
            </form>
        @endif
    @else
        @if(Route::has('treatments.edit'))
            <x-wire-button href="{{ route('treatments.edit', $treatment) }}" blue xs>
                <i class="fa-solid fa-pen-to-square"></i>
            </x-wire-button>
        @endif
        @if(Route::has('treatments.delete'))
            <form action="{{ route('treatments.delete', $treatment) }}" method="POST" class="delete-form">
                @csrf
                <x-wire-button type="submit" red xs>
                    <i class="fa-solid fa-trash"></i>
                </x-wire-button>
            </form>
        @endif
    @endif

</div>
