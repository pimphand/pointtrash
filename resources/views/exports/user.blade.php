<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama User</th>
        <th>Kontak</th>
        <th>Alamat</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>
                {{ $user->phone }} <br>
                {{ $user->email }}
            </td>
            <td>{{ $user->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
