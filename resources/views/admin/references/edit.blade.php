@extends('admin.layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">
                {!! Form::model( $reference, ['route' => ['admin.services.update', $reference->id], 'id' => 'form_edit_permission', 'files' => true, 'method' => 'PATCH' ]) !!}

                @include('admin.references._form')

                <div class="form-group mt15">
                    {!! Form::button('Upravit', ['class' => 'btn bg-teal-400', 'id' => 'btn-submit-edit', 'type' => 'submit'] ) !!}
                    <a href="{!! route('admin.references.index') !!}" title="Zrušit" class='btn btn-default'>Zrušit</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection