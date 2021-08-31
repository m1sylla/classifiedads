<?php
use Illuminate\Support\Facades\DB;
$search_cats = DB::table('categories')->get();
$search_subcats = DB::table('category_items')->get();
$search_regions = DB::table('regions')->get();
$search_villes = DB::table('villes')->get();
?>

<div class="row mx-0 search-ad p-3">
    <form class="mx-auto align-self-center w-100" method="GET" action="{{ route('ads.search') }}">
        
        <div class="form-row">
            <div class="col-12 col-sm-6 col-md-4">
                <input type="text" class="form-control" name="title" placeholder="Que cherchez-vous?">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mt-sm-0">
                <select class="form-control p-1" name="category">
                    <option value="" disabled="disabled" selected="selected" class="d-none">
                        Toutes les catégories
                    </option>
                    @foreach($search_cats as $search_cat)
                        <option value="{{$search_cat->name}};" class="p-1">
                            {{ $search_cat->name }}
                        </option>
                        @foreach($search_subcats as $search_subcat)
                        @if($search_cat->id==$search_subcat->category_id)
                            <option value="{{$search_cat->name}};{{$search_subcat->name}}" class="p-1">
                                &nbsp;&nbsp;&nbsp;{{ $search_subcat->name }}
                            </option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 mt-md-0">
                <select class="form-control p-1" name="location">
                    <option value="" disabled="disabled" selected="selected" class="d-none">
                        Toute la Guinée
                    </option>
                    @foreach($search_regions as $search_region)
                        <option value="{{$search_region->name}};" class="p-1">
                            Tout {{ $search_region->name }}
                        </option>
                        @foreach($search_villes as $search_ville)
                        @if($search_region->id==$search_ville->region_id)
                            <option value="{{$search_region->name}};{{$search_ville->name}}" class="p-1">
                                &nbsp;&nbsp;&nbsp;{{ $search_ville->name }}
                            </option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6 col-md-12 col-lg-2 mt-2 mt-lg-0">
                <button type="submit" class="btn border-0 w-100 shadow-none font-weight-bold text-white"><i class="fa fa-search"></i> CHERCHER</button>
            </div>
        </div>
    </form>
</div>