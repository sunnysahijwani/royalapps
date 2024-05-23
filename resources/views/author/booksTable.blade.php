@if(count($result['books'])>0)
@foreach ($result['books'] as $key => $book)
<tr>
    <td>{{($book['title'])??'--'}}</td>
    <td>{{$book['description']??'--'}}</td>
    <td>{{$book['isbn']??'--'}}</td>
    <td>{{$book['format']??'--'}}</td>
    <td>{{$book['number_of_pages']??'0'}}</td>
    <td>{{ date( 'Y-m-d', strtotime($book['release_date']))??'--'}}</td>
    <td>
        <form method="post" id="deleteBookForm" action="{{route('delete.book',$book['id'])}}">
            @csrf
            @method('delete')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach

@else
<tr>
    <td colspan="6" class="text-center">
        No Record Avalible
    </td>
</tr>
@endif