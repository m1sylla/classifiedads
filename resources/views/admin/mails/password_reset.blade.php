<!DOCTYPE html>
<html>

<head>
    <title>RĂ©initialisation du mot passe administrateur</title>
</head>

<body>

    <div style="background-color:GhostWhite; margin:0;">

        <div style="margin: 20px 5%; background-color:White;">
            @include('mails.includes.header')

            <div style="padding:10px;">
                <p>
                    Bonjour,
                </p>
                <p>
                    Veuillez cliquer sur ce lien pour RĂ©initialiser votre mot de passe.
                </p>
                <p>
                    <a href="{{url('admin_yetek224/password/reset_link', $data->token)}}">
                        <button
                            style="color:white; background-color:#fe6700; font-size: 17px; padding:7px 10px; border:none; cursor:pointer;">
                            RĂ©initialiser le mot de passe
                        </button>
                    </a>
                </p>

                <p>
                    Cordialement, <br /> <span style="font-style:bold;">Equipe Yetecan.</span>
                </p>

            </div>

            @include('mails.includes.footer')

        </div>

    </div>

</body>

</html>