@if(count($result)>0)
@foreach ($result as $key => $author)
<tr>
    <td>{{($author['first_name'] .' '.$author['last_name'])??'--'}}</td>
    <td>{{$author['gender']??'--'}}</td>
    <td>{{ date( 'Y-m-d', strtotime($author['birthday']))??'--'}}</td>
    <td>{{$author['place_of_birth']??'--'}}</td>
    <td>
        <div class="row">
            <div class="col-6" style="text-align: end;"> <a href="{{route('view.author',$author['id'])}}"
                    class="btn btn-primary">View</a></div>
        </div>
    </td>
</tr>
@endforeach

@else
<tr>
    <td colspan="4" class="text-center">
        No Record Avalible
    </td>
</tr>
@endif