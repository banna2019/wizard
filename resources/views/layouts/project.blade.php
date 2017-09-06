@extends('layouts.default')
@section('container-style', 'container')
@section('title', $project->name)
@section('content')
    @include('layouts.navbar')

    <div class="row marketing">
        <div class="col-lg-12">
            <div class="col-lg-3">

                <ul class="nav nav-pills nav-stacked wz-left-nav">
                    <li class="{{ $pageID === 0 ? 'active' : '' }}">
                        <a href="{{ wzRoute('project:home', ['id' => $project->id]) }}" class="wz-nav-item">
                            <span class="glyphicon glyphicon-th-large"></span>
                            {{ $project->name }}
                            @include('components.project-tag', ['proj' => $project])
                        </a>
                    </li>
                    @include('components.navbar', ['navbars' => $navigators])
                </ul>
            </div>
            <div class="col-lg-9">
                <nav class="wz-page-control clearfix">
                    <div class="btn-group wz-nav-control">
                        @can('page-add', $project)
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    @lang('common.btn_add') <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{!! wzRoute('project:doc:new:show', ['id' => $project->id, 'pid' => $pageID]) !!}">@lang('common.document')</a>
                                    </li>
                                    <li>
                                        <a href="{!! wzRoute('project:doc:new:show', ['id' => $project->id, 'type' => 'swagger', 'pid' => $pageID]) !!}">@lang('common.swagger')</a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                        @can('project-edit', $project)
                            <a class="btn btn-default"
                               href="{{ wzRoute('project:setting:show', ['id' => $project->id]) }}">@lang('project.setting')</a>
                        @endcan
                    </div>

                    @yield('project-control')
                </nav>
                <div class="panel panel-default">
                    <div class="panel-body">
                        @yield('page-content')
                    </div>
                </div>
                @stack('page-panel')
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="/assets/js/navigator-tree.js"></script>
    <script>
        // 侧边导航自动折叠
        $(function () {
            $.wz.navigator_tree($('.wz-left-nav'));
        });
    </script>
@endpush