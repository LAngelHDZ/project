<div>
    @foreach($subtemas as $item)
        <p class="mx-5 text-sm text-gray-500">{{ $item->subindice.' .- '.$item->nombre_subindice }}</p>
    @endforeach
</div>
