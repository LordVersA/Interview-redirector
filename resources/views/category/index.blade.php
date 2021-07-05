@extends('layouts.app')

@section('title', __('m.category_list'))

@section("content")
    <div class="box">


        <div class="box-body">
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <p>{{__('m.click_to_see_links')}}</p>
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:5%">ID</th>
                            <th style="width:20%">{{__('m.title')}}</th>
                            <th class="d-none d-sm-table-cell">{{__('m.label')}}</th>
                            <th>{{__('m.user')}}</th>
                            <th>{{__('m.links_count')}}</th>
                            <th>{{__('m.last_change')}}</th>
                            <th style="width:10%">...</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr role="row" class="odd">
                                <td>{{$category->id}}</td>
                                <td><a href="{{route("getByCategory",[$category->label])}}">{{$category->title}}</a>
                                </td>
                                <td>{{$category->label}}</td>
                                <td>{{$category->user->name}}</td>
                                <td>{{count($category->links)}}</td>
                                <td>{{$category->updated_at->diffForHumans()}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a class="btn btn-block btn-primary"
                                               href="{{route("category.edit",[$category])}}">{{__('m.edit')}}</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <form method="post" action="{{route("category.destroy",$category->id)}}">
                                                @method("delete")
                                                @csrf
                                                <button type="submit" class="btn btn-block btn-danger">{{__('m.delete')}}</button>
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

