<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sistem CFC : Permohonan Penilaian Projek</title>
    </head>
    <body>
        <table>
            <tr>
                <td>Nama Syarikat: {!! $concessionaire->name !!}</td>
            </tr>
            <tr>
                <td>No. Pendaftaran Syarikat: {!! $concessionaire->reg_no !!}</td>
            </tr>
            <tr>
                <td>Emel Syarikat: {!! $concessionaire->email !!}</td>
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
                <td>Status: Konsesi telah menghantar satu permohonan penilaian untuk mendapatkan kelulusan</td>
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