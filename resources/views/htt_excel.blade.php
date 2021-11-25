@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center" >Lista kontratave</div>
                {{-- form submit for search --}}
                <div class="p-1 ">
                    <div class="panel panel-primary text-center">
                        <div class="panel-heading">Ngarko excel ne databaze</>. <p class="alert alert-danger"><b>Kujdes!</b> Vetem 1 kolone duhet, kontrata.</p> </div>  
                              <form  action={{ route('import_csv_htt') }} method="post" enctype="multipart/form-data">
                               <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-3 ">
                                    <div class="form-row" >
                                        <input type="file" name="upload_htt" class="form-control" value="zgjidhni excel" required>
                                    </div>
                                   </div>
                                   <div>
                                    <button class="btn btn-primary d-inline" type="submit">Ngarko excel</button>
                                   </div>
                               </div>
                               @csrf
                               @method('post')
                              </form>
                                <div class="p-2 text-center">
                                        <a class="mr-2 btn btn-warning" href="{{route('unmatched_htt_excel')}} ">Unmatched</a>
                                        <a class="ml-2 btn btn-success" href="{{route('matched_htt_excel')}} ">Matched</a>
                                </div>
                                <div>
                                    <h3>{{ $not_found }}</h3>
                                </div>
                       </div>
                </div>

                {{-- Table start --}}
                

            </div>
        </div>
    </div>
</div>
@endsection
