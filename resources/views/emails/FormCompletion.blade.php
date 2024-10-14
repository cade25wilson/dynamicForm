Hi there,<br><br>

You’ve received a new submission for your form, {{$form->name}}.

Here are the details:

@foreach($responseData as $section => $fields) 
    <p>{{ $section ? $section : '' }}</p>
    <ul> 
        @foreach($fields as $fieldName => $value) 
            <li><strong>{{ $fieldName }}:</strong> 
                @if(is_array($value)) 
                    {{ implode(', ', $value) }} 
                @else 
                    {{ $value ?? 'N/A' }}
                @endif 
            </li> 
        @endforeach
    </ul> 
@endforeach

<p>You can view all submissions by <a href="https://buildmyform.com/responses/{{$form->id}}">clicking here</a>.</p>
<p>Best regards,</p> The BuildMyForm Team