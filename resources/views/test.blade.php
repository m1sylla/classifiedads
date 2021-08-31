<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Guinée, Annonces, Petites annonces, Voitures, maisons, Téléphones, Ordinateurs">
    <meta name="description"
        content="Petites annonces en Guinée - Vente et achat de voitures, d'ordinateurs, de téléphones, de maisons, d'électroménagers, de chaussures, de vêtements">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Petites annonces en Guinée, voiture, mode, maison et plus &#124; Yetecan </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <script src="/js/app.js"> </script>
    <script src="/js/custom.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>

<body>

    <main class="">

        <form class="bg-white py-3 my-4" method="POST" action="{{ action('ManagePhotoController@adPhotoCreate') }}">
            @csrf
            <input type="text" name="annonce_id">
            
            <!-- Titre -->
           
            
            <!-- Description -->
            

            <!-- Submit Button -->
            <div class="form-group">
                <div class="col-3 col-md-4 col-lg-offset-2 mx-auto">
                    <button class="btn btn-lg text-white background-blue" type="submit">
                        Envoyer
                    </button>
                </div>
            </div>
        
        </form>
    

        <script type="text/javascript">
            /*var steps = Math.ceil(Math.log(2000 / 900) / Math.log(2));
            $(window).on('load', function(){
                console.log(steps);
            // }); */
            
        </script>



    </main>


</body>

</html>