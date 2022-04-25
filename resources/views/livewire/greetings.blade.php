<div>
    Instant: <input wire:model="name" type="text"><br>
    Debounce 1s.: <input wire:model.debounce.1000ms="name" type="text"><br>
    Lazy: <input wire:model.lazy="name" type="text"><br>
    <input wire:model="loud" type="checkbox">
    <select wire:model="greeting" multiple>
        <option>Hello</option>
        <option>Goodbye</option>
        <option>Adios</option>
    </select>
    {{ implode(', ', $greeting) }} {{strtoupper($name)}} @if ($loud) ! @endif

    {{--    $event.target.innerText--}}
    {{--    resetName()--}}

    <form action="#" wire:submit.prevent="$set('name', ' Bingo')">
        <button>Reset name</button>
    </form>
</div>
