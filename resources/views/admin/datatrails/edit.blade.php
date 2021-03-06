@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.datatrails.title')</h3>
    
    {!! Form::model($datatrail, ['method' => 'PUT', 'route' => ['admin.datatrails.update', $datatrail->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('trail_id', trans('global.datatrails.fields.trail').'', ['class' => 'control-label']) !!}
                    {!! Form::select('trail_id', $trails, old('trail_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('trail_id'))
                        <p class="help-block">
                            {{ $errors->first('trail_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('global.datatrails.fields.user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('view', trans('global.datatrails.fields.view').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('view', 0) !!}
                    {!! Form::checkbox('view', 1, old('view', old('view')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('view'))
                        <p class="help-block">
                            {{ $errors->first('view') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('progress', trans('global.datatrails.fields.progress').'', ['class' => 'control-label']) !!}
                    {!! Form::number('progress', old('progress'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('progress'))
                        <p class="help-block">
                            {{ $errors->first('progress') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('rating', trans('global.datatrails.fields.rating').'', ['class' => 'control-label']) !!}
                    {!! Form::number('rating', old('rating'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('rating'))
                        <p class="help-block">
                            {{ $errors->first('rating') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

