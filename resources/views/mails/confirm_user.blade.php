<!DOCTYPE html>
<html>
  <head>
    
    <title>Activation de votre compte yetecan.com</title>
  </head>
  <body>
  
    <div style="background-color:GhostWhite; margin:0;">

      <div style="margin: 20px 5%; background-color:White;">

        @include('mails.includes.header')
    
        <div style="padding:10px;">
  
          <h2>Bienvenue!</h2>
              
          <p>
            Bonjour,
          </p>
          <p>
            Félicitations votre compte <span style="font-weight:bold;">yetecan.com</span> est maintenant créé.
          </p>
          <p>
            Merci de confirmer votre compte en cliquant sur ce lien :
          </p>
  
          <p>
          <a href="{{url('compte/verification', $data->token)}}">
            <button style="color:white; background-color:#fe6700; font-size: 17px; padding:7px 10px; border:none; cursor:pointer;">
              Confirmer votre compte
            </button>
          </a>
          </p> 
  
          <p>
            Cordialement, <br/> <span style="font-weight:bold;">Equipe Yetecan.</span>
          </p>
      
        </div>
          
        @include('mails.includes.footer')
        
      </div>

    </div>

  </body>
</html>


{{-- 
@component('mail::message')
Hello **{{$name}}**,   use double space for line break 
Thank you for choosing Mailtrap!

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,  
Mailtrap team.
@endcomponent
--}}