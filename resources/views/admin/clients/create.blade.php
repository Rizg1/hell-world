@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.clients.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.clients.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {{-- {!! Form::label('folder_id', trans('quickadmin.files.fields.folder').'*', ['class' => 'control-label', 'id' => 'company_id']) !!}
                    {!! Form::select('folder_id', $folders, old('folder_id'), ['class' => 'form-control select2', 'required' => '']) !!} --}}
                    <select name="folder_id" id="company" class="form-control select2" required>
                        @foreach ($folders as $key => $folder)
                            <option value="{{ $key }}">{{ $folder }}</option>
                        @endforeach
                    </select>
                    
                    <p class="help-block"></p>
                    @if($errors->has('folder_id'))
                        <p class="help-block">
                            {{ $errors->first('folder_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('kyc_form', trans('quickadmin.clients.fields.kyc_form').'', ['class' => 'control-label']) !!}
                    {!! Form::text('kyc_form', old('kyc_form'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('enrollment_list', trans('quickadmin.clients.fields.enrollment_list').'', ['class' => 'control-label']) !!}
                    {!! Form::text('enrollment_list', old('enrollment_list'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('signed_proposal', trans('quickadmin.clients.fields.signed_proposal').'', ['class' => 'control-label']) !!}
                    {!! Form::text('signed_proposal', old('signed_proposal'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sec_articles', trans('quickadmin.clients.fields.sec_articles').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sec_articles', old('sec_articles'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('articles_incorp', trans('quickadmin.clients.fields.articles_incorp').'', ['class' => 'control-label']) !!}
                    {!! Form::text('articles_incorp', old('articles_incorp'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('by_laws', trans('quickadmin.clients.fields.by_laws').'', ['class' => 'control-label']) !!}
                    {!! Form::text('by_laws', old('by_laws'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('coc', trans('quickadmin.clients.fields.coc').'', ['class' => 'control-label']) !!}
                    {!! Form::text('coc', old('coc'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cert_list', trans('quickadmin.clients.fields.cert_list').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cert_list', old('cert_list'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('valid_id', trans('quickadmin.clients.fields.valid_id').'', ['class' => 'control-label']) !!}
                    {!! Form::text('valid_id', old('valid_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('statement', trans('quickadmin.clients.fields.statement').'', ['class' => 'control-label']) !!}
                    {!! Form::text('statement', old('statement'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@push('javascript')
    <script>
        $(document).ready(function(){
            $('#company').on('change', function () {
                var company_id = $('#company').val()

                $.ajax({
                url: "{{ route('admin.clients.get.files') }}",
                dataType: 'json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    company_id: company_id
                },
                success: function( data, textStatus, jQxhr ){
                    console.log(data)
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
            })
        })
    </script>
@endpush

