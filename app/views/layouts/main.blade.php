{{--
    Created by Elmar <aka Ramires> Abdurayimov <e.abdurayimov@gmail.com>
    @copyright (C)Copyright 2014 eatech.org
    Date: 12/13/14
    Time: 5:59 PM
--}}

@extends('layouts.base')

@section('header')
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/'); }}">Work</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        @if(Auth::user()->role->slug == 'developer')
                            <li><a href="{{ route('hours.index') }}"><i class="fa fa-bars"></i> Hours</a></li>
                        @endif

                        @if(in_array(Auth::user()->role->slug, array('admin', 'manager', 'super')))
                            <li><a href="{{ route('reports.index') }}"><i class="fa fa-file"></i> Reports</a></li>
                            <li><a href="{{ route('projects.index') }}"><i class="fa fa-folder"></i> Projects</a></li>
                        @endif

                        @if(Auth::user()->role->slug == 'admin' || Auth::user()->role->slug == 'super')
                            <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> Users</a></li>
                        @endif

                        <li>{{ HTML::link('reset', Auth::user()->first_name .' ' . Auth::user()->last_name) }}</li>
                        <li>{{ HTML::link('logout', 'Logout') }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@stop

@section('footer')
    <footer class="footer">
        <div class="container">
            <p class="text-muted text-center">2014</p>
        </div>
    </footer>
@stop

@section('content')
    @yield('content')
@stop