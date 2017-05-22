
@foreach($values as $fieldValue)

    <strong>{{ $fieldValue->name }}:</strong><br>
    {{ $fieldValue->value }}<br>
    <br>

@endforeach