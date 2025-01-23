<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            @foreach ($columns as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>
