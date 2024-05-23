<?php
define('SELECT2_CSS', "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css");
define('SELECT2_CSS_BS', "https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css");
define('SELECT2_JS', "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js");

?>

<select class="form-control select2bs4 {{$cls??''}}" style="width: 100%;" @isset($name) name="{{$name}}" @endisset
    @isset($id) id="{{$id}}" @endisset @isset($multiple) multiple="" @endisset {{ $attributes}}>

    <option value="-1" selected="selected">Select Option</option>

    @if(isset($arrayforeach) && count($arrayforeach)>0)
    @foreach ( $arrayforeach as $option)

    @isset($selectitem)
    <option value="{{$option->id}}" @if($option->id == $selectitem) selected @endif >{{$option->title}}</option>
    @else
    <option value="{{$option->id}}">{{$option->title}}</option>

    @endisset


    @endforeach

    @endif
</select>



@push('push_js')
@once
<script>
    if ($('link[href="{{SELECT2_CSS}}"]').length == 0) {
        // if not present, add the CSS file dynamically
        $('head').append('<link rel="stylesheet" href="{{SELECT2_CSS}}">');
    }

    if ($('link[href="{{SELECT2_CSS_BS}}"]').length == 0) {
        // if not present, add the CSS file dynamically
        $('head').append('<link rel="stylesheet" href="{{SELECT2_CSS_BS}}">');
    }


    // check if a CSS class is already present in the head section
    if ($('head').find('style:contains(".select2-container--bootstrap4")').length == 0) {
        // if not present, add the CSS class dynamically
        $('head').append('<style type="text/css">.select2-container--bootstrap4 .select2-results__option--highlighted, .select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected="true"] {color: #fff;background-color: #922c88;}.select2-container--bootstrap4.select2-container--focus .select2-selection {border-color: #922c88;-webkit-box-shadow: 0 0 0 .2rem rgba(163,209,51,0.25);box-shadow: 0 0 0 .2rem rgba(163,209,51,0.25);}.select2-container--default .select2-selection--multiple .select2-selection__choice {background-color: #922c88; color:black;}</style>');

    }



    if ($('script[src="{{SELECT2_JS}}"]').length == 0) {


        $.getScript("{{SELECT2_JS}}", function() {
            // the code inside this function will execute only after the JavaScript file is loaded
            // and the relevant function is defined

            select2_fn();
        });
    }

    function select2_fn() {

        var csrftokenval = $('meta[name="csrf-token"]').attr('content');
        $('.select2bs4').select2(

            {
                @isset($ajaxroute)
                ajax: {
                    url: "{{$ajaxroute}}"
                    , type: "post"
                    , dataType: 'json'
                    , delay: 250
                    , data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    }
                    , headers: {
                        'X-CSRF-TOKEN': csrftokenval
                    }
                    , processResults: function(response) {
                        return {
                            results: response
                        };
                    }
                    , cache: true
                }
                , placeholder: 'Search for a Author'
                , minimumInputLength: 3
                , @endisset
                @isset($multiple)
                @else
                theme: 'bootstrap4'
                @endisset
            });
    }
</script>

@endonce
@endpush