<table class="table table-hover shadow rounded overflow-hidden">
    <thead style="background-color: #919191; color: #000000;">
        <tr>
            @foreach ($columns as $column)
                <th class="text-center py-3">{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr 
                @if(isset($row['onclick']) && $row['onclick']) 
                    style="cursor: pointer;" 
                    onclick="{{ $row['onclick'] }}"
                @endif
            >
                @foreach ($row['data'] as $cell)
                    <td class="text-center py-2">{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
