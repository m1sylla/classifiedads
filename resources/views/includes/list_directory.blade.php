<div class="row">
    <div class="col">
        <div class="my-2 pl-2">
            @if ($list_ville)
            <a class="color-blue hover-color-blue font-weight-bold"
            href="{{ route('ads.search', ['location' => $list_region.';'.$list_ville, 'category' => '']) }}">
            {{$list_ville}}
            </a>
            @elseif ($list_region)
            <a class="color-blue hover-color-blue font-weight-bold"
            href="{{ route('ads.search', ['location' => $list_region.';', 'category' => '']) }}">
            {{$list_region}}
            </a> 
            @else
            <a class="color-blue hover-color-blue font-weight-bold"
            href="{{ route('ads.search', ['location' => '', 'category' => '']) }}">
            Guinée
            </a> 
            @endif

            @if ($list_category)
                <i class="fa fa-chevron-right text-muted mx-2" style="font-size:10px;"></i> 
                <a class="color-blue hover-color-blue font-weight-bold"
                href="{{ route('ads.search', ['location' => $list_ville? ';'.$list_ville:'', 'category' => $list_category.';']) }}">
                {{$list_category}}
                </a>
                @if ($list_subcategory)
                <i class="fa fa-chevron-right text-muted mx-2" style="font-size:10px;"></i>
                <a class="color-blue hover-color-blue font-weight-bold"
                href="{{ route('ads.search', ['location' => $list_ville? ';'.$list_ville:'', 'category' => $list_category.';'.$list_subcategory]) }}">
                {{$list_subcategory}}
                </a> 
                @endif
            @else
            <i class="fa fa-chevron-right text-muted mx-2" style="font-size:10px;"></i>
            <a class="color-blue hover-color-blue font-weight-bold"
                href="{{ route('ads.search', ['location' => '', 'category' => '']) }}">
                Toutes les annonces
            </a> 
            @endif
            
        </div>
    </div>
</div>