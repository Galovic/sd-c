@extends('admin.layouts.master')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box-body">

                {!! Form::open( ['route' => 'admin.references.store', 'id' => 'form_edit_user', 'files' => true] ) !!}

                @include('admin.references._form')

                <div class="form-group mt15">
                    {!! Form::button( 'Vytvořit', ['class' => 'btn bg-teal-400', 'type' => 'submit', 'id' => 'btn-submit-edit'] ) !!}
                    <a href="{!! route('admin.references.index') !!}" title="Zrušit" class='btn btn-default'>Zrušit</a>
                </div>

                {!! Form::close() !!}

            </div><!-- /.box-body -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection