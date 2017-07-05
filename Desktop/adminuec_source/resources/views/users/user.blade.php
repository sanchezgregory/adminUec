@extends('layouts.app')

@section('styles')
    <!-- Include Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" />

    <!-- CSS to make Select2 fit in with Bootstrap 3.x -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.css" />

    <!-- Include Select2 JS -->

    <style type="text/css">
        #select2Form .form-control-feedback {
            /* To make the feedback icon visible */
            z-index: 100;
        }
    </style>
@endsection
@section('content')

    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Minimal</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Disabled</label>
                    <select class="form-control select2" disabled="disabled" style="width: 100%;">
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Multiple</label>
                    <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                        <option>Alabama</option>
                        <option>Alaska</option>
                        <option>California</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label>Disabled Result</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Alabama</option>
                        <option>Alaska</option>
                        <option disabled="disabled">California (disabled)</option>
                        <option>Delaware</option>
                        <option>Tennessee</option>
                        <option>Texas</option>
                        <option>Washington</option>
                    </select>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <select class="js-data-example-ajax">
        <option value="3620194" selected="selected">select2/select2</option>
    </select>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(".select2").select2();
        $('select').select2({
            ajax: {
                url: '/users/users',
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                }
            }
        });
        $(".js-data-example-ajax").select2({
            ajax: {
                url: "/users/users",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    console.log(data)
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    </script>

@endsection
