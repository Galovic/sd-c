{{ Form::model($configuration) }}

    <div class="form-group ">
        {{ Form::label($id = 'mv-view-input', 'View') }}
        {{ Form::select('view', $views, null, [
            'class' => 'form-control',
            'id' => $id
        ]) }}
    </div>

{{ Form::close() }}