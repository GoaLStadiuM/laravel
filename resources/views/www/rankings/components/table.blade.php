<table class="table-center clasification">
    <thead style="text-align: center;">
        <tr style="font-size: 30px; color: {{ $color }};">
            <th><span>Ranking</span></th>
            <th>{{ $header[0] }}</th>
            <th>{{ $header[1] }}</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        @foreach($rows as $row)
        <tr>
            <td><span>{{ $row->ranking }}</span></td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->stuff }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
