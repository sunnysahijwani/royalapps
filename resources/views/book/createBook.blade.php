@extends('layouts.layout')

@section('container')

<div class="container ">

    <div class="card card-outline card-info">
        <div class="card-body row justify-content-center align-items-center">
            <div class="">
                <div class="register-logo">
                    <b>Create </b>&nbsp;Book
                </div>
                <div class="row">
                    <div class="col-4">
                        <x-notification />
                    </div>
                </div>
                <div class="card">
                    <div class="card-body register-card-body">
                        <form action="{{route('store.book')}}" method="POST">
                            @csrf
                            <div class="row  rounded ">
                                <div class="mb-3 col-4">
                                    <label for="author" class="form-label">Author *</label>
                                    <x-authorCombo name="author" id="author" />

                                </div>
                                <div class="mb-3 col-4 ">
                                    <label for="title" class="form-label">Tittle *</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{old('title')??''}}" required>
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-4 ">
                                    <label for="release_date" class="form-label">Release Date *</label>
                                    <input type="date" class="form-control" id="release_date" name="release_date"
                                        value="{{old('release_date')??''}}" required>
                                    @error('release_date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="isbn" class="form-label">Isbn *</label>
                                    <input type="text" id="isbn" name="isbn" class="form-control "
                                        value="{{old('isbn')??''}}" required>
                                    @error('isbn')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="format" class="form-label">Format *</label>
                                    <input type="text" id="format" name="format" class="form-control"
                                        value="{{old('format')??''}}" required>
                                    @error('format')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="number_of_pages" class="form-label">No of Pages *</label>
                                    <input type="number" id="number_of_pages" name="number_of_pages"
                                        class="form-control" required>
                                    @error('number_of_pages')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="description" class="form-label">Description </label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3"></textarea>
                                </div>

                                <div class="col-12"> <button class="btn-sm btn-dark mb-3 ">Create</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection