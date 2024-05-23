@extends('layouts.layout')

@section('container')

<div class="container">

    <h1>List of Authors</h1>
    <div class="row">
        <div class="col-4">
            <x-notification />
        </div>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Place Of DOB</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @include('author.table')

                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>
@endsection