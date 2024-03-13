<!DOCTYPE html>
<html>
    <head>
        <title>Data User</title>
    </head>
    <body>
        <h1>Data User</h1>
        <table border="1" cellpading="2" cellspacing="0">
            <tr>
                <td>Jumlah Pengguna</td>
                {{-- <th>ID</th>
                <th>Usernama</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th> --}}
            </tr>
            <tr>
                <td>{{$data}}</td>
                {{-- <td>{{ $data->user_id }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->id_level }}</td> --}}
            </tr>
        </table>
    </body>
</html>

