<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistem CFC : Pembukaan Akaun Konsesi </title>
    </head>
    <body>
    <table>
            <tr>
                <td>Salam {!! $user->name !!},</td>
            </tr>
            <tr>
                <td>Berikut dinyatakan maklumat akaun konsesi bagi sistem Carbon Footprint Calculator (CFC) bagi membenarkan log masuk ke sistem CFC.</td>
            </tr>
            <tr>
                <td>Nama Syarikat: {!! $user->name !!}</td>
            </tr>
            <tr>
                <td>No. Pendaftaran Syarikat: {!! $user->name !!}</td>
            </tr>
            <tr>
                <td>Emel Syarikat: {!! $user->email !!}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Tuan boleh log masuk ke sistem CFC melalui link dan akses di bawah</td>
            </tr>
            <tr>
                <td>URL Sistem CFC: <a href="{!! url('/login') !!}">{!! url('/login') !!}</a></td>
            </tr>
            <tr>
                <td>Username: {!! $user->email !!}</td>
            </tr>
            <tr>
                <td>Password: {!! $password !!}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Sekian, Terima Kasih</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Pentadbir Sistem Carbon Footprint Calculator (CFC)</td>
            </tr>
            <tr>
                <td>Lembaga Lebuhraya Malaysia</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <hr>
                        E-mel ini dijana secara automatik oleh Sistem CFC <br />
                    <hr>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        
    </body>
</html>