@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.courses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.courses.fields.title')</th>
                            <td field-key='title'>{{ $course->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.instructor')</th>
                            <td field-key='instructor'>
                                @foreach ($course->instructor as $singleInstructor)
                                    <span class="label label-info label-many">{{ $singleInstructor->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.lessons')</th>
                            <td field-key='lessons'>
                                @foreach ($course->lessons as $singleLessons)
                                    <span class="label label-info label-many">{{ $singleLessons->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.categories')</th>
                            <td field-key='categories'>
                                @foreach ($course->categories as $singleCategories)
                                    <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.featured-image')</th>
                            <td field-key='featured_image'>@if($course->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->featured_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.description')</th>
                            <td field-key='description'>{!! $course->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.introduction')</th>
                            <td field-key='introduction'>{!! $course->introduction !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.courses.fields.duration')</th>
                            <td field-key='duration'>{{ $course->duration }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#datacourses" aria-controls="datacourses" role="tab" data-toggle="tab">Data Courses</a></li>
<li role="presentation" class=""><a href="#trails" aria-controls="trails" role="tab" data-toggle="tab">Trails</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="datacourses">
<table class="table table-bordered table-striped {{ count($datacourses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.datacourses.fields.course')</th>
                        <th>@lang('global.datacourses.fields.user')</th>
                        <th>@lang('global.datacourses.fields.view')</th>
                        <th>@lang('global.datacourses.fields.progress')</th>
                        <th>@lang('global.datacourses.fields.rating')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($datacourses) > 0)
            @foreach ($datacourses as $datacourse)
                <tr data-entry-id="{{ $datacourse->id }}">
                    <td field-key='course'>{{ $datacourse->course->title or '' }}</td>
                                <td field-key='user'>{{ $datacourse->user->name or '' }}</td>
                                <td field-key='view'>{{ Form::checkbox("view", 1, $datacourse->view == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='progress'>{{ $datacourse->progress }}</td>
                                <td field-key='rating'>{{ $datacourse->rating }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datacourses.restore', $datacourse->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datacourses.perma_del', $datacourse->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('datacourse_view')
                                    <a href="{{ route('admin.datacourses.show',[$datacourse->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('datacourse_edit')
                                    <a href="{{ route('admin.datacourses.edit',[$datacourse->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('datacourse_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.datacourses.destroy', $datacourse->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="trails">
<table class="table table-bordered table-striped {{ count($trails) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.trails.fields.title')</th>
                        <th>@lang('global.trails.fields.categories')</th>
                        <th>@lang('global.trails.fields.courses')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($trails) > 0)
            @foreach ($trails as $trail)
                <tr data-entry-id="{{ $trail->id }}">
                    <td field-key='title'>{{ $trail->title }}</td>
                                <td field-key='categories'>
                                    @foreach ($trail->categories as $singleCategories)
                                        <span class="label label-info label-many">{{ $singleCategories->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='courses'>
                                    @foreach ($trail->courses as $singleCourses)
                                        <span class="label label-info label-many">{{ $singleCourses->title }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.trails.restore', $trail->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.trails.perma_del', $trail->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('trail_view')
                                    <a href="{{ route('admin.trails.show',[$trail->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('trail_edit')
                                    <a href="{{ route('admin.trails.edit',[$trail->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('trail_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.trails.destroy', $trail->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.courses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
