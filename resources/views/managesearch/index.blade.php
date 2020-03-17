@extends('layouts.main')


@section('content')
<div class="container">

    <div class="row justify-content-center">

    @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

        <div class="col-md-12">

            <div class="card">


                <div class="card-body">

                    <form action="{{ route('SetSearchType') }}">
                      <button type="submit" class="btn green"> Add New Search</button>
                    </form>
                    
                <br />
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" cellspacing="0" width="70%">
                    <thead>
                            <tr><th> <span style="float:left">Recent Searches </th></tr>
                    </thead>

                      <tbody>
                      @if(isset($rs))
                        @foreach ($rs as $d)

                        <tr>
                           <td><span style="float:left;  padding-left:20px;"> <a style="cursor:pointer" href="{{ url('/managesearch-getByKeyword/'.$d) }}">{{ $d }}</a> </span></td> 
                        </tr>

                        @endforeach
                       @endif    

                      </tbody>

                </table>

                </div>

            </div>
        </div>

        <hr />

        <div class="col-md-12">

            <div class="card">


                <div class="card-body">

                    <form>



                    </form>

                </div>

            </div>
        </div>


    </div>
</div>
@endsection
