<div style="background-color: {{ $record->getStatus->color }}" class="font-bold rounded-full py-1 px-6 text-white text-center align-middle flex-initial">
    {{-- {{ $column->getValue($record->getStatus->name) }} --}}
    {{ $record->getStatus->name }}
</div>
