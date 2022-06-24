<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistem CFC : Status Permohonan Penilaian Projek</title>
    </head>
    <body>
        <table>
            <tr>
                <td>Salam {!! $concessionaire->name !!}</td>
            </tr>
            <tr>
                <td>Nama Lebuhraya:  {!! $project->highway_name !!}</td>
            </tr>
            <tr>
                <td>Nama Wilayah: {!! $project->region !!}</td>
            </tr>
            <tr>
                <td>Chainage/Kilometer: {!! $project-> kilometer_from !!}, {!! $project-> kilometer_to !!}</td>
            </tr>
            <tr>
                <td>Status: Permohonan Penilaian Projek telah diluluskan</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Tuan boleh log masuk ke sistem CFC untuk mula mengisi maklumat</td>
            </tr>
            <tr>
            <td>URL Sistem CFC: <a href="{!! url('/login') !!}">{!! url('/login') !!}</a></td>
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