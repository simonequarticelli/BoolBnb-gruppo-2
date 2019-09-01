@foreach ( $house_user as $house )
    <ul>
        <li>
            {{ $house->title }}
        </li>
    </ul>
@endforeach