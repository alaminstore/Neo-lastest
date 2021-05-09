<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEO Bazaar </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');

        table,
        td {
            border: 0;
        }
    </style>
</head>

<body style="padding: 0; margin: 0;">
    <table style="width: 100%; border-spacing: 0; margin-bottom: 0; padding: 0;">
        <tbody>
            <tr>
                <td style="background-color: #fff; padding: 0;">
                    <table
                        style="max-width: 602px; width: 100%; border-spacing: 0; margin-left: auto; margin-right: auto; margin-bottom: 0;">
                        <tbody>
                            <tr>
                                <td style="background-color: #3084bb; padding: 16px 16px 8px 16px;">
                                    <table style="width: 100%; border-spacing: 0; margin-bottom: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center; padding: 0;">
                                                    <h1
                                                        style="font-family: 'Jost', sans-serif; font-size: 24px; color: #fff; font-weight: 600; text-transform: uppercase; margin: 0;">
                                                        order tracking: <span>{{$email_info['order_id']}} </span></h1>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #f5f5f5; padding: 0;">
                                    <table style="width: 100%; border-spacing: 0;">
                                        <tbody>
                                        @if($email_info['order_status'] == 'order confirmed')
                                            <tr>
                                                <td style="width: 100%">
                                                    <img style="width: 100%;"
                                                        src="https://neo-bazaar.com/images/emailimages/ot-4.png"
                                                        alt="">
                                                </td>
                                            </tr>
                                        @endif 
                                        @if($email_info['order_status'] == 'order shipping')
                                            <tr style="">
                                                <td style="width: 100%">
                                                    <img style="width: 100%;"
                                                        src="https://neo-bazaar.com/images/emailimages/ot-2.png"
                                                        alt="">
                                                </td>
                                            </tr>
                                        @endif 
                                        @if($email_info['order_status'] == 'order delivered')
                                            <tr style="">
                                                <td style="width: 100%">
                                                    <img style="width: 100%;"
                                                        src="https://neo-bazaar.com/images/emailimages/ot-1.png"
                                                        alt="">
                                                </td>
                                            </tr>
                                        @endif
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
