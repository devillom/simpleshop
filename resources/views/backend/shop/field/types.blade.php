@foreach($fields as $field)
    <div class="uk-form-row">
        @if($field->type == 'value_str')
            <label class="uk-form-label">{{$field->name}}</label>

            {!! Form::text('field['.$field->id.'][value_str]',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_str:null) !!}
        @endif
        @if($field->type == 'value_text')
            <label class="uk-form-label">{{$field->name}}</label>
            {!! Form::textarea('field['.$field->id.'][value_text]',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_text:null) !!}
        @endif
        @if($field->type == 'value_int')
            <label class="uk-form-label">{{$field->name}}</label>
            {!! Form::number('field['.$field->id.'][value_int]',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_int:null) !!}
        @endif
        @if($field->type == 'value_dt')
            <label class="uk-form-label">{{$field->name}}</label>
            {!! Form::datetime('field['.$field->id.'][value_dt]',(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_dt:null) !!}
        @endif

            @if($field->type == 'value_select')
                <label class="uk-form-label">{{$field->name}}</label>
                {!! Form::select('field['.$field->id.'][value_select]',$field->options()->lists('name','id')->toArray(),(!is_null($productId) && !is_null($field->getValue($productId) ))?$field->getValue($productId)->value_select:null)!!}
            @endif
    </div>
@endforeach
