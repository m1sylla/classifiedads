<!DOCTYPE html>
<html>
  <head>
    <title>Votre compte yetecan.com est activé</title>
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
                Votre compte administrateur sur <span style="font-style:bold;">yetecan.com</span> est maintenant activé.
                <br/><br/>
                Veuillez réinitialiser votre mot de passe en cliquant sur ce lien.
              </p>
              <p>
                <a href="{{url('admin_yetek224/password/reset_link', $data->token)}}">
                  <button style="color:white; background-color:#fe6700; font-size: 17px; padding:7px 10px; border:none; cursor:pointer;">
                    Réinitialiser le mot de passe
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