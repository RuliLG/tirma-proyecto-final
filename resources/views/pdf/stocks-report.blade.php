<table>
    <thead>
        <tr>
            @foreach ($columns as $column => $name)
            <th>{{ $name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
        <tr>
            @foreach ($columns as $column => $_)
            <td>{{ $row->{$column} }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
