@extends('layouts.app')

@if($is_category)
    @section('title', 'لینک های دسته بندی '.$links[0]->category->title)
@else
    @section('title', __("m.links"))
@endif

@section("content")
    <div class="box">


        <div class="box-body">
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:5%">ID</th>
                            <th style="width:20%"> {{__('m.link')}}</th>
                            <th class="d-none d-sm-table-cell"> {{__('m.label')}}</th>
                            <th> {{__('m.user')}}</th>
                            <th> {{__('m.category')}}</th>
                            <th class="d-none d-sm-table-cell"> {{__('m.http_code')}}</th>
                            <th> {{__('m.status')}}</th>
                            <th> {{__('m.click_count')}}</th>
                            <th> {{__('m.last_visited')}}</th>
                            <th style="width:10%">...</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($links as $link)
                            <tr role="row" class="odd">
                                <td>{{$link->id}}</td>
                                <td><p style="width:500px;
                                    white-space:nowrap;
                                    overflow:hidden;
                                    text-overflow:ellipsis;"><a href="{{$link->link}}">{{$link->link}}</a></p></td>
                                <td><a href="{{route("redirect",$link->label)}}">{{$link->label}}</a></td>
                                <td>{{$link->user->name}}</td>
                                <td>
                                    <a href="{{route("getByCategory",[$link->category->label])}}">{{$link->category->title}}</a>
                                </td>
                                <td>{{$link->status_code}}</td>
                                <td>@if($link->is_active)
                                        <p class="text-blue">Enable</p>
                                    @else
                                        <p class="badge">Disable</p>
                                    @endif
                                </td>
                                <td>{{$link->click_count}}</td>
                                <td>@if($link->click_count>0)
                                        {{$link->updated_at->diffForHumans()}}
                                    @else
                                        {{__('m.not_visited')}}
                                    @endif
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a class="btn btn-block btn-primary"
                                               href="{{route("link.edit",[$link])}}"> {{__('m.edit')}}</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <form method="post" action="{{route("link.destroy",$link->id)}}">
                                                @method("delete")
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-block btn-danger"> {{__('m.delete')}}</button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset("plugins/datatables/dataTables.bootstrap4.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css")}}">
@endsection


@section('script')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>

    <!-- Page JS Code -->
    <script src="{{asset('js/be_tables_datatables.min.js')}}"></script>
@endsection

