@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">404 Page Not Found</div>

                    <div class="panel-body">
                        <h2>Page not found.</h2>

                        <h3>The page you requested was not found.</h3>

                        <ul>
                            <li>If you typed the URL directly, please make sure the spelling is correct.</li>
                            <li>If you clicked on a link to get here, the link is outdated.</li>
                        </ul>

                        <h3>What can you do?</h3>
                        <ul>
                            <li>Click on the back button of your browser to go back to the previous page.</li>
                            <li>Click <a href="/home">here</a> to go to the home page.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
