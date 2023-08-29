

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>

    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        @foreach($data as $key => $item)
            <tr>
                <td>{{$key}}</td>
                <td>{{$item}}</td>
            </tr>
        @endforeach
    </table>

    </body>
</html>
