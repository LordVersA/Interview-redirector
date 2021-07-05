@extends('layouts.app')

@section('title', __("m.add_link"))

@section('content')
    <div class="box box-primary">
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" action="
        @if($mode=='update')
        {{route("link.update",$link->id)}}
        @else
        {{route("link.store")}}
        @endif">
            @csrf
            @if($mode=='update')
                <input hidden name="id" value="{{$link->id}}"/>
                @method('patch')
            @endif
            <div class="box-body">
                <div class="form-group @error('link') has-error @enderror">
                    <label for="link">{{__("m.link")}}</label>
                    <input type="text" class="form-control" id="link" placeholder="{{__("m.link")}}" name="link"
                           value="@if($mode=='update'){{$link->link}}@else{{ old('link') }}@endif">
                    <label class="control-label" for="inputError">
                        @error('link')
                        <i class="fa fa-times-circle-o"></i>
                        {{$message }}
                        @enderror
                    </label>
                </div>
                <div class="form-group @error('label') has-error @enderror">
                    <label for="label">{{__("m.label")}}</label>
                    <input type="text" class="form-control" id="label" placeholder="{{__("m.label")}}" name="label"
                           value="@if($mode=='update'){{$link->label}}@else{{ old('label') }}@endif">
                    <label class="control-label" for="inputError">

                        @error('label')
                        <i class="fa fa-times-circle-o"></i>
                        {{$message }}
                        @enderror
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @error('status_code') has-error @enderror">
                            <label for="status_code">{{__("m.http_code")}}</label> <strong> (Status Code) </strong>
                            <input type="number" class="form-control" id="status_code" placeholder="Status Code"
                                   name="status_code"
                                   value="@if($mode=='update'){{$link->status_code}}@else{{ old('status_code') }}@endif">
                            <label class="control-label" for="inputError">
                                @error('status_code')
                                <i class="fa fa-times-circle-o"></i>
                                {{$message }}
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group @error('category') has-error @enderror">
                            <label for="category">{{__("m.category")}}</label>
                            <select class="form-control select2" id="category" name="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if($mode=='update')
                                            @if($category->id == $link->category->id)
                                            selected
                                        @endif
                                        @endif
                                    >{{$category->title}}</option>
                                @endforeach
                            </select>
                            <label class="control-label" for="inputError">
                                @error('category')
                                <i class="fa fa-times-circle-o"></i>
                                {{$message }}
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_active" id="is_active"
                               @if($mode=='update')
                               @if($link->is_active)
                               checked
                            @endif
                            @endif
                        >{{__('m.active_deactive')}}
                    </label>
                </div>
            </div>


            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{__("m.send")}}</button>
            </div>
        </form>
    </div>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section("script")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
