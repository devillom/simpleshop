<h3>Добавить опцию</h3>

{!! Form::open(['route' => ['category.field.option.store'] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
<div class="uk-form-row">
    <label class="uk-form-label">Список опции</label>
    {!! Form::textarea('field_options',null,['class'=>'uk-width-1-1']) !!}
</div>
<div class="uk-modal-footer">
    <input type="hidden" name="field_id" value="{{$field->id}}">
    <button class="uk-button uk-button-primary">Добавить</button>
</div>
{!! Form::close() !!}

<h3>Существующие опции</h3>
<table class="uk-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    @if(count($options))
        @foreach( $options as $option)
            <tr>
                <td>{{$option->id}}</td>
                <td>{{$option->name}} <br>
                    {!! Form::select('child_field_id', $fields,$option->child_field_id, ['multiple'=>'multiple','class'=>'option chosen-select']) !!}
                </td>
                <td>{{$option->content}}</td>
                <td>

                    {!! Form::open(['route' => ['category.field.option.destroy',$option->id] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
                        <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<script>
    $(".option.chosen-select").chosen({width: "3" +
    "00px"});
</script>

