<h3>Добавить опцию</h3>

{!! Form::open(['route' => ['manager.shop.category.field.option.store'] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
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
                <td>{{$option->name}}</td>
                <td>{{$option->content}}</td>
                <td class="uk-text-right">

                    {!! Form::open(['route' => ['manager.shop.category.field.option.destroy',$option->id] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
                        <a href="#" class="uk-button uk-button-success add-sub-field" data-id="{{$option->id}}" data-uk-modal="{target:'#addOptionFieldModal'}"><i class="uk-icon-plus"></i></a>
                        <a href="#" class="uk-button uk-button-primary edit-option" data-edit="{{route('manager.shop.category.field.option.edit.form',$option->id)}}" data-uk-modal="{target:'#editOptionModal'}"><i class="uk-icon-edit"></i></a>
                        <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>

            @if(count($option->fields))

                @foreach($option->fields as $field)

                        <tr data-id="{{$field->id}}" class="sub-fields">
                            <td>-</td>
                            <td class="name">{{$field->name}}</td>
                            <td>
                            <td class="uk-text-right">
                                {!! Form::open(['route' => ['manager.shop.field.destroy',$field->id] ,'method'=>'delete'])!!}
                                @if($field->type == 'value_select')
                                    <a href="#" class="uk-button uk-button-primary edit-options" data-edit="{{route('manager.shop.category.field.option.form',$field->id)}}" data-uk-modal="{target:'#addFieldOptionsModal'}"><i class="uk-icon-navicon"></i> </a>
                                @endif

                                <a href="#" class="uk-button uk-button-primary edit-field" data-edit="{{route('manager.shop.field.edit',$field->id)}}" data-uk-modal="{target:'#editFieldModal'}"><i class="uk-icon uk-icon-edit"></i> </a>
                                <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i>
                                </button>
                                {!! Form::close() !!}
                            </td>

                        </tr>

                @endforeach

            @endif
        @endforeach
    @endif
    </tbody>
</table>

<script>
    $(".option.chosen-select").chosen({width: "180px"});
    $(document).on('click','.add-sub-field',function(){
        $('#addOptionFieldModal form').append('<input type="hidden" name="option_id" value="'+$(this).data('id')+'">')
    });
</script>

