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
                Votre compte <span style="font-style:bold;">yetecan.com</span> est maintenant activé.
                <br/><br/>
                Commencer votre expérience avec nous en créant votre première
                annonce
              </p>
              <p>
                <a href="{{ route('add.new.ad') }}">
                  <button style="color:white; background-color:#fe6700; font-size: 17px; padding:7px 10px; border:none; cursor:pointer;">
                    D&#233;poser une annonce
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