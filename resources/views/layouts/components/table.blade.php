<table class="table table-hover shadow rounded overflow-hidden">
    <thead style="background-color: #919191; color: #000000;">
        <tr>
            @foreach ($columns as $column)
                <th class="text-center py-3">{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>
