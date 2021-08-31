<div class="row">
    <div class="col col-md-8">
        <div class="d-flex flex-wrap px-lg-0 mb-2 filter1">
            <div class="py-1 ml-2">
                Résultats : @if ($annonces->isNotEmpty())
                {{ $annonces->total()}}@else {{ $annonces->count()}} 
                @endif 
            </div>
            <!--
            <div class="checkbox checkbox-orange py-1 mr-sm-1">
                <input id="professionnel" class="styled border" type="checkbox" checked>
                <label for="professionnel">
                    Professionnel
                </label>
            </div>
            <div class="checkbox checkbox-orange py-1 mr-sm-1 border">
                <input id="particulier" class="styled" type="checkbox" checked>
                <label for="particulier">
                    Particulier
                </label>
            </div>
            
            <div class="checkbox checkbox-orange py-1 mr-1">
                <input id="nouveau" class="styled" type="checkbox" checked>
                <label for="nouveau"><span class="mr-1">Nouveau</span><span class="">23</span> </label>
            </div>
            <div class="checkbox checkbox-orange py-1 mr-3">
                <input id="ancien" class="styled" type="checkbox" checked>
                <label for="ancien"><span class="mr-1">Ancien</span><span class="">28</span> </label>
            </div> 
            -->
            
            <div id="sortBy" class="ml-auto p-0 position-relative border" style="width:150px;">
                <button id="sortBymenutoggle" class="btn shadow-none px-2 w-100">
                    <span class="float-left">{{ $sort_type ? $sort_type : 'Tri : Défaut'}}</span>
                    <i class="fa fa-angle-down float-right" style="font-size:20px;"></i>
                </button>
                <ul id="sortBymenu" class="list-group position-absolute my-0 w-100" 
                style="z-index:10000; display:none;">

                    <li class="list-group-item px-0 py-1">
                        <a href="{{ Request::url() }}" class="d-block px-2 m-0 text-decoration-none a-grey">
                            Tri : Défaut
                        </a>
                    </li>

                    <li class="list-group-item px-0 py-1">
                        <a class="d-block px-2 m-0 text-decoration-none a-grey"
                        href="{{ Request::fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'desc']) }}">
                            Plus recent
                        </a>
                    </li>

                    <li class="list-group-item px-0 py-1">
                        <a class="d-block px-2 m-0 text-decoration-none a-grey"
                        href="{{ Request::fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'asc']) }}">
                            Plus ancien
                        </a>
                    </li>

                    <li class="list-group-item px-0 py-1">
                        <a class="d-block px-2 m-0 text-decoration-none a-grey"
                        href="{{ Request::fullUrlWithQuery(['sort' => 'price', 'direction' => 'desc']) }}">
                            Plus cher
                        </a>
                    </li>

                    <li class="list-group-item px-0 py-1">
                        <a class="d-block px-2 m-0 text-decoration-none a-grey"
                        href="{{ Request::fullUrlWithQuery(['sort' => 'price', 'direction' => 'asc']) }}">
                            Moins cher
                        </a>
                    </li>
                </ul>
            </div> 
            
        </div>
    </div>
</div>