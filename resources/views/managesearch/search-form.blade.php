@extends('layouts.main')


@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">


                <div class="card-body">

                    <form action="{{ route('PutSearchForm') }}" method="POST">
                     @csrf

                        <div class="form-group">
                            <label>Enter a keyword</label>
                            <textarea class="form-control" rows="3" name="search_keyword"></textarea>
                        </div>


                        <div class="form-actions right">
                            <button type="button" class="btn default">Cancel</button>
                            <button type="submit" class="btn green">Submit Keyword</button>
                        </div>

                    </form>


                    

                </div>

<br />

            </div>
        </div>

    </div>
</div>
@endsection
