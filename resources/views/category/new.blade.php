@extends('layouts.app')

@section('title', __('m.add_category'))

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="
        @if($mode=='update')
        {{route("category.update",$category->id)}}
        @else
        {{route("category.store")}}
        @endif">
            @csrf
            @if($mode=='update')
                @method('patch')
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="title">{{__('m.title')}}</label>
                            <input type="text" class="form-control" id="title" placeholder="{{__('m.title')}}"
                                   name="title"
                                   value="@if($mode=='update'){{$category->title}}@else{{ old('title') }}@endif">
                            <label class="control-label" for="inputError">
                                @error('title')
                                <i class="fa fa-times-circle-o"></i>
                                {{$message }}
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group @error('label') has-error @enderror">
                            <label for="label">{{__('m.label')}}</label>
                            <input type="text" class="form-control" id="label" placeholder="{{__('m.label')}}"
                                   name="label"
                                   value="@if($mode=='update'){{$category->label}}@else{{ old('label') }}@endif">
                            <label class="control-label" for="inputError">

                                @error('label')
                                <i class="fa fa-times-circle-o"></i>
                                {{$message }}
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{__('m.send')}}</button>
            </div>
        </form>
    </div>
@endsection
