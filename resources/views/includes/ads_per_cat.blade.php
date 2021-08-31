{{-- @if (!$list_category)
<div class="list-inline mb-2">
    @foreach ($number_per_catsubcats as $number_per_catsubcat)
        @if ($number_per_catsubcat->total_ads > 0)
        <a href="{{ route('ads.search', ['location' => $list_ville? ';'.$list_ville :'', 'category' => $number_per_catsubcat->name.';']) }}" 
        class="list-inline-item ml-2 border-bottom border-secondary my-1 text-decoration-none text-dark">
            {{$number_per_catsubcat->name}}
            <span>({{$number_per_catsubcat->total_ads}})</span>
        </a>
        @endif
    @endforeach

</div> 
@elseif (!$list_subcategory)
<div class="list-inline mb-2">
    @foreach ($number_per_catsubcats as $number_per_catsubcat)
        @if ($number_per_catsubcat->total_ads > 0)
        <a href="{{ route('ads.search', ['location' => $list_ville? ';'.$list_ville :'', 'category' => ';'.$number_per_catsubcat->name]) }}" 
        class="list-inline-item ml-2 border-bottom border-secondary my-1 text-decoration-none text-dark">
            {{$number_per_catsubcat->name}}
            <span>({{$number_per_catsubcat->total_ads}})</span>
        </a>
        @endif
    @endforeach

</div> 
@endif --}}