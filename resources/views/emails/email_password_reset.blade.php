<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Confirm Email</title>

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {font-family: 'Raleway', sans-serif;}
        table{display: table;border-collapse: separate;}table, td{box-sizing: border-box;}tb{display: table-cell}
    </style>
</head>

<body style="width: 100%; height: 100%; background: #a4a4a4; margin: 0; overflow-x: hidden; font-size: 16px;">
<table style="width: 600px; height: 100%; margin: 0 auto; background: #fff; border: 0;" cellpadding="0" cellspacing="0">
    <tbody>
    <!-- header start -->
    <tr>
        <td>
            <table style="background: #111; width: 100%; color: #fff; padding: 12px 16px; border: 0;" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td style="text-align: left; text-transform: uppercase;">{{config('app.name')}}</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <!-- body start -->
    <tr>
        <td style="width: 100%; padding: 32px 16px;">
            <table style="width: 100%; border: 0;" cellpadding="0" cellspacing="0">
                <tbody>
                <!-- account confirmation start -->
                <tr>
                    <td style="text-align: center;">
                        <table style="width: 100%; border: 0;" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <table style="width: 52px; height: 52px; background: #111; border-radius: 50%; margin: auto; margin-inline-start: auto; margin-inline-end: auto;"  cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td><img style="filter: invert(1);" src="{{asset('images')}}/user-profile.png" alt="cart"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; font-size: 24px; padding: 16px 0;">
                                    You are receiving this email because we received a password reset request for your account.
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 16px 0;">
                                    <a style="display: inline-block; background: #111; color: #fff; text-transform: uppercase; text-decoration: none; padding: 8px 16px;"
                                       href="{{url('password/reset/confirm/'.$token)}}">Reset Password</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    This password reset link will expire in 60 minutes.
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height: 22px; padding: 0 24px;">
                                    If you did not request a password reset, no further action is required.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>

</html>
