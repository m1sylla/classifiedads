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
                <p>
                    Bonjour,
                </p>
                <p>
                    Merci de cliquer sur ce lien pour changer votre mot de passe :
                </p>

                <p>
                    <a href="{{url('password/edit', $data->token)}}">
                        {{url('password/edit', $data->token)}}
                    </a>
                </p>

                <p>
                    Cordialement, <br /> <span style="font-weight:bold;">Equipe Yetecan.</span>
                </p>

            </div>

            @include('mails.includes.footer')

        </div>

    </div>

</body>

</html>