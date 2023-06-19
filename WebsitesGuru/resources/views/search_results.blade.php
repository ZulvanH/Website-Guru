<h2>Search Results:</h2>

@if (count($results) > 0)
    <ul>
        @foreach ($results as $result)
            <li>{{ $result['name'] }}</li>
        @endforeach
    </ul>
@else
    <p>No results found.</p>
@endif
