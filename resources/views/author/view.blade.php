@extends('layouts.layout')

@section('container')
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="text-success h6 text-center"></p>
                <div class="card card-info card-outline">
                    <div class="card-body">

                        <div>
                            <x-notification />
                        </div>
                        @if(count($result['books']) <= 0) <div class="text-right mb-3">
                            <form method="post" action="{{ route('delete.author', $result['id']) }}" id="deleteForm">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger float-right">Delete Author</button>
                            </form>
                    </div>
                    @endif
                    <div class="row pb-3">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Name</label>
                                <div class="form-group clearfix bg-light  p-2 rounded ">
                                    <span>{{ $result['first_name'] . ' ' . $result['last_name'] ?? 'No Name'
                                        }}</span>
                                </div>

                                <input type="hidden" name="saleId" id="saleId" value="2283">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="form-group clearfix bg-light p-2 rounded ">
                                    <span>{{ $result['gender'] ?? 'Gender Not Selected' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="date">Birthday</label>
                                <div class="form-group clearfix bg-light  p-2 rounded ">
                                    <span>{{ date('Y-m-d', strtotime($result['birthday'])) ?? 'No Date' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="date">Place of Birth</label>
                                <div class="form-group clearfix bg-light  p-2 rounded ">
                                    <span>{{ $result['place_of_birth'] ?? 'No Date' }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-4">
                            <div id="paddress">
                                <label>Biography</label>
                                <div class="form-group clearfix bg-light p-2 rounded ">
                                    <span>{{$result['biography'] ?? 'No Date'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class=" card card-info card-outline">
                        <div class="card-title">
                            <div class="register-logo">
                                Books Authored By: &nbsp; <b> {{$result ['first_name'] . ' ' .
                                    $result['last_name']}}</b>
                            </div>
                        </div>
                        <div>
                            <table class="table tableSaleorder">
                                <thead>
                                    <tr>
                                        <th>Tittle</th>
                                        <th>Description</th>
                                        <th>Isbn.</th>
                                        <th>Format</th>
                                        <th>No. of Pages</th>
                                        <th>Release Date</th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('author.booksTable')
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>
</section>
@endsection
@section('optional_scripts')
<script>
    $(document).ready(function() {
      $("#deleteForm").submit(function(e) {
        e.preventDefault();
        var confirmStatus = confirm("Are you sure you want to delete this author?");
        if (confirmStatus) {
          this.submit();
        }
      });
      $("#deleteBookForm").submit(function(e) {
        e.preventDefault();
        var confirmStatus = confirm("Are you sure you want to delete this book?");
        if (confirmStatus) {
          this.submit();
        }
      })
    });

</script>
@endsection