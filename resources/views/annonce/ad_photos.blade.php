<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Petites annonces en Guinée &#124; Yetecan </title>

    <!----  favicon  --->
    <link rel="shortcut icon" type="image/png" href="/uploads/favicon-192.png">
    <link rel="shortcut icon" sizes="192x192" href="/uploads/favicon-192.png">
    <link rel="apple-touch-icon" href="/uploads/favicon-192.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <script src="/js/app.js"> </script>
    <script src="/js/custom.js"> </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>

    <!-- header -->
    <header class="">
        @include('includes.navbar')
        @include('includes.search_ad')
    </header>
    <!-- end header -->

    <main class="">

        <div class="row text-center my-5">
            <div class="col">
                <h2>Postez vos annonces! C'est gratuit</h2>
            </div>
        </div>

        <!-- <form class="bg-white pb-3" id="form-upload-ad-photos" enctype="multipart/form-data"> -->
            
        <fieldset class="bg-white pb-3" id="form-ad-photos">
            <legend class="text-center text-white font-weight-bold py-2 background-blue">
                Ajouter des photos
            </legend>
            
            
            <!-- Photos -->
            <div class="form-group">

                <input type="hidden" id="annonce_id" name="annonce_id" value="{{$id}}">


                <label for="price_option" class="col-sm-6 text-sm-center px-sm-1 px-4 col-form-label">
                    <span class="font-weight-bold">Ajouter des photos :</span>
                    <small class=" text-muted">(Jusqu'à 12)</small>
                </label>
                <div class="w-100"></div>
                <div class="col-md-10 mx-md-auto my-3 d-flex flex-wrap border" id="ad_photos_wrapper">
                
                    <div class="d-inline-block bg-light my-1 mr-2" id="preview_image_div">
                        <div class="position-relative border ad-photo-list" id="preview1">
                            <img title="" class="h-100 w-100" id="preview-photo1"> 
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Principale</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo1" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo1').click()" id="add-photo1">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate1" id="rotate1" value="0" style="display: none;">    
                            <input type="file" name="photo1" id="ad-photo1" style="display: none;" accept="image/*">    
                        </div>
                    </div>
                
                    <div class="d-inline-block bg-light my-1 mr-2" id="preview_image_div">
                        <div class="position-relative border ad-photo-list" id="preview2">
                            <img title="" class="h-100 w-100" id="preview-photo2">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 2</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo2" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo2').click()" id="add-photo2">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate2" id="rotate2" value="0" style="display: none;"> 
                            <input type="file" name="photo2" id="ad-photo2" style="display: none;" accept="image/*">    
                        </div>
                    </div>
                
                    <div class="d-inline-block bg-light my-1 mr-2" id="preview_image_div">
                        <div class="position-relative border ad-photo-list" id="preview3">
                            <img title="" class="h-100 w-100" id="preview-photo3">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 3</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo3" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo3').click()" id="add-photo3">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate3" id="rotate3" value="0" style="display: none;"> 
                            <input type="file" name="photo3" id="ad-photo3" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview4">
                            <img title="" class="h-100 w-100" id="preview-photo4">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 4</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo4" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo4').click()" id="add-photo4">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate4" id="rotate4" value="0" style="display: none;"> 
                            <input type="file" name="photo4" id="ad-photo4" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview5">
                            <img title="" class="h-100 w-100" id="preview-photo5">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 5</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo5" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo5').click()" id="add-photo5">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate5" id="rotate5" value="0" style="display: none;"> 
                            <input type="file" name="photo5" id="ad-photo5" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview6">
                            <img title="" class="h-100 w-100" id="preview-photo6">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 6</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo6" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo6').click()" id="add-photo6">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate6" id="rotate6" value="0" style="display: none;"> 
                            <input type="file" name="photo6" id="ad-photo6" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview7">
                            <img title="" class="h-100 w-100" id="preview-photo7">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 7</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo7" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo7').click()" id="add-photo7">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate7" id="rotate7" value="0" style="display: none;"> 
                            <input type="file" name="photo7" id="ad-photo7" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview8">
                            <img title="" class="h-100 w-100" id="preview-photo8">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 8</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo8" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo8').click()" id="add-photo8">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate8" id="rotate8" value="0" style="display: none;"> 
                            <input type="file" name="photo8" id="ad-photo8" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview9">
                            <img title="" class="h-100 w-100" id="preview-photo9">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 9</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo9" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo9').click()" id="add-photo9">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate9" id="rotate9" value="0" style="display: none;"> 
                            <input type="file" name="photo9" id="ad-photo9" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview10">
                            <img title="" class="h-100 w-100" id="preview-photo10">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 10</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo10" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo10').click()" id="add-photo10">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate10" id="rotate10" value="0" style="display: none;"> 
                            <input type="file" name="photo10" id="ad-photo10" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview11">
                            <img title="" class="h-100 w-100" id="preview-photo11">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 11</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo11" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo11').click()" id="add-photo11">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate11" id="rotate11" value="0" style="display: none;"> 
                            <input type="file" name="photo11" id="ad-photo11" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="bg-light my-1 mr-2" id="preview_image_div" style="display:none">
                        <div class="position-relative border ad-photo-list" id="preview12">
                            <img title="" class="h-100 w-100" id="preview-photo12">
                            <span class="position-absolute d-block w-100 text-center text-white bg-secondary">Photo 12</span>
                            <img src="/uploads/rotate-image-right.png" height="25" width="25" class="position-absolute el-center" 
                            style="cursor:pointer; display:none;" id="rotate-photo12" name="rotateImage">
                            <a class="position-absolute d-inline-block" href="javascript:void(0)" onclick="$('#ad-photo12').click()" id="add-photo12">
                                <img src="/uploads/add-camera.png" height="35" width="35" class="" alt="">
                            </a>
                            <input type="hidden" name="rotate12" id="rotate12" value="0" style="display: none;"> 
                            <input type="file" name="photo12" id="ad-photo12" style="display: none;">    
                        </div>
                    </div>
                
                    <div class="border my-1 mr-2" id="morePhoto" style="display:inline-block">
                        <div class="position-relative border ad-photo-list">
                            <button type="button" id="morePhotos" class="btn btn-dark el-center">
                                <i class="fa fa-plus" style="font-size:36px"></i><br><span></span> 
                            </button>
                        </div>
                    </div>
                
                </div>
        
            </div>

            <!-- Submit Button -->
            <div class="form-group mt-4">

                <div class="col-sm-7 col-md-6 mx-auto d-flex">
                    <div>
                        <button class="btn text-white background-blue darken-blue" title="Ajouter"
                        type="submit" name="submit" value="end">
                            Terminer
                        </button>
                    </div>
                    <div class="ml-auto">
                        <button class="btn text-white background-blue darken-blue ml-5" title="Ajouter des attributs"
                        type="submit" name="submit" value="attribute">
                            Ajouter des critères
                        </button>
                    </div>
                </div>

            </div>
        </fieldset>
        <!--</form>

        <img id='blob_img'>-->

    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>