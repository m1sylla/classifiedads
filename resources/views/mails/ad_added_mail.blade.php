<!DOCTYPE html>
<html>
  <head>
    <title>Votre annonce a été ajoutée</title>
  </head>
  <body>

    <div style="background-color:GhostWhite; margin:0;">

      <div style="margin: 20px 5%; background-color:White;">
        @include('mails.includes.header')
  
          <div style="padding:10px;">
            
              <h2>Félicitations!</h2>
              
              <p>
                Bonjour,
              </p>
              <p>
                Votre <span style="font-style:bold;">annonce</span> 
                a été avec succès.
              </p>
              <p>Visitez votre annonce &nbsp; &nbsp;         
                <a href="{{ route('ad.detail', ['ville' => str_slug($annonce[0]->ville_name,'-') , 'category' => str_slug($annonce[0]->category,'-') , 'slug' => $annonce[0]->slug]) }}">
                  <button style="color:white; background-color:#fe6700; font-size: 17px; padding:7px 10px; border:none; cursor:pointer;">
                    Voir annonce
                  </button>
                </a>
              </p>
              
              <p>
                Cordialement, <br/> <span style="font-style:bold;">Equipe Yetecan.</span>
              </p>
            
          </div>
          
      @include('mails.includes.footer')
  
      </div>

    </div>

        
  </body>
</html>