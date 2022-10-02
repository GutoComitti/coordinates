<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Affiliates</title>

        <style>
            table, th, td {
                border: 1px solid;
            }
        </style>
    </head>
    <body class="antialiased">
        <h3>Affiliates close to the office</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Id</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($affiliates as $affiliate)
                    <tr>
                        <td>{{ $affiliate->name }}</td>
                        <td>{{ $affiliate->affiliate_id }}</td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
