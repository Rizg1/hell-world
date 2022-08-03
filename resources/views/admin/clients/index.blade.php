@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.clients.title')</h3>
    @can('client_create')
    <p>
     <a href="{{ route('admin.clients.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('client_delete')
        <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.clients.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li>
            |
            <li><a href="{{ route('admin.clients.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
        </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>
        <div class="panel-body table-responsive">
            <table id="myTable" class="table table-bordered table-striped {{ count($clients) > 0 ? 'datatable' : '' }} @can('client_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('client_delete')
                        @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>@endif
                    @endcan

                    <th>Company Name</th>
                    <th>KYC Form</th>
                    <th>Member Enrollment List</th>
                    <th>Signed Proposal</th>
                    <th>Sec Registration</th>
                    <th>Articles Of Incorporation</th>
                    <th>Copies of By-Laws</th>
                    <th>COC</th>
                    <th>Certified List</th>
                    <th>Copy of Valid IDs</th>
                    <th>Sworn Statement</th>
                    @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                    @else
                        <th>&nbsp;</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @if (count($clients) > 0)
                    @foreach ($clients as $client)
                        <tr data-entry-id="{{ $client->id }}">
                            @can('client_delete')
                                @if ( request('show_deleted') != 1 )
                                    <td></td>@endif
                            @endcan

                            <td field-key='name'>
                                @can('client_view')
                                    <a href="{{ route('admin.folders.show', $client->folder->id) }}">{{$client->folder->name}}</a>
                                    </td>
                                @endcan
                            <td field-key='kyc_form'>
                                @can('client_view')
                                    {{$client->mediaFiles->file_name}}
                                    </td>
                            @endcan
                            <td field-key='enrollment_list'>
                                @can('client_view')
                                    {{$client->enrollment_list}}
                                    </td>
                            @endcan
                            <td field-key='signed_proposal'>
                                @can('client_view')
                                    {{$client->signed_proposal}}
                                    </td>
                            @endcan
                            <td field-key='sec_articles'>
                                @can('client_view')
                                    {{$client->sec_articles}}
                                    </td>
                            @endcan
                            <td field-key='articles_incorp'>
                                @can('client_view')
                                    {{$client->articles_incorp}}
                                    </td>
                            @endcan
                            <td field-key='by_laws'>
                                @can('client_view')
                                    {{$client->by_laws}}
                                    </td>
                            @endcan
                            <td field-key='coc'>
                                @can('client_view')
                                    {{$client->coc}}
                                    </td>
                            @endcan
                            <td field-key='cert_list'>
                                @can('client_view')
                                    {{$client->cert_list}}
                                    </td>
                            @endcan
                            <td field-key='valid_id'>
                                @can('client_view')
                                    {{$client->valid_id}}
                                    </td>
                            @endcan
                            <td field-key='statement'>
                                @can('client_view')
                                    {{$client->statement}}
                                    </td>
                            @endcan
                            @if( request('show_deleted') == 1 )
                                <td>
                                    @can('client_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.clients.restore', $client->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('clients_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.clients.perma_del', $client->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan`
                                </td>
                            @else
                                <td>
                                    @can('client_edit')
                                        <a href="{{ route('admin.clients.edit',[$client->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('client_delete')
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.clients.destroy', $client->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="13">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    
    <script>
        @can('folder_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.clients.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection