@foreach($fields as $field)
    <div class="uk-form-row">
        @if($field->type == 'value_str')
            <label class="uk-form-label">{{$field->name}}</label>

            {!! Form::text('field['.$field->id.']',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_str:null) !!}
        @endif
        @if($field->type == 'value_text')
            <label class="uk-form-label">{{$field->name}}</label>
            {!! Form::textarea('field['.$field->id.']',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_text:null) !!}
        @endif
        @if($field->type == 'value_int')
            <label class="uk-form-label">{{$field->name}}</label>
            {!! Form::number('field['.$field->id.']',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_int:null) !!}
        @endif
        @if($field->type == 'value_dt')
            <label class="uk-form-label">{{$field->name}}</label>
            {!! Form::datetime('field['.$field->id.']',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_dt:null) !!}
        @endif
    </div>
@endforeach
