@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">Lista kontratave</div>
                {{-- form submit for search --}}
                <div class="p-1">
                   
                    <div>
                        <div class="mx-auto pull-right">
                            <div class="p-1">
                                <form action="{{ route('vme') }}" method="GET" role="search">
                
                                    <div class="input-group">
                                        {{-- reset --}}
                                        <a href="{{ route('vme') }}" class=" mr-5">
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger" type="button" title="Refresh page">
                                                    <span class="fas fa-sync-alt"></span>
                                                </button>
                                            </span>
                                        </a>
                                        {{-- searchbox --}}
                                        <input type="text" class="form-control mr-2" name="term" id="term" placeholder="Kerko kontrate" value="{{ $term }}">
                                        <input type="text" class="form-control mr-2" name="nr_serial" id="nr_serial" placeholder="Kerko nrserial" value="{{ $matesi }}">

                                        {{-- lloji sherbimit filter --}}
                                      
                                        <select name="llojisherbimi" class="custom-select">
                                            <option value="all">All sherbim</option>
                                            <option value="Verifikim(P)" {{ $llojisherbimi == 'Verifikim(P)' ? 'selected' : ''}} >Verifikim(P)</option>
                                            <option value="Verifikim(P) & BV" {{ $llojisherbimi == 'Verifikim(P) & BV' ? 'selected' : '' }} >Verifikim(P) & BV</option>
                                            <option value="BV Direkte" {{ $llojisherbimi == 'BV Direkte' ? 'selected' : '' }} >BV Direkte</option>
                                        </select>
                                   

                                        {{-- filter by status --}}

                                      
                                        <select name="status" class="custom-select">
                                            <option value="all">All</option>
                                            <option value="100" {{ $status == '100' ? 'selected' : ''}} >kontrata</option>
                                            <option value="50" {{ $status == '50' ? 'selected' : '' }} >sporteli</option>
                                            <option value="25" {{ $status == '25' ? 'selected' : '' }} >rajon</option>
                                            <option value="" {{ $status == '' ? 'selected' : '' }} >nuk ka</option>
                                        </select>
                                  
                    
                                        {{-- submit btn --}}

                                        <span class="input-group-btn ml-5">
                                            <button class="btn btn-info" type="submit" title="Search projects" name="searchStuff">
                                                <span class="fas fa-search"></span>
                                            </button>
                                        </span>
                                        <span class="input-group-btn ml-5">
                                            <button class="btn btn-info" type="submit" title="Export projects" name="exportData">
                                                <span class="fas fa-download"></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

                {{-- Table start --}}
                
                @empty($products)
                <h2 class="p-2 text-center">Nuk ka rezultate</h2>
                @else
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <th>id</th>
                            <th>data</th>
                            <th>rajoni</th>
                            <th>agjensia</th>
                            <th>lloji_i_sherbim</th>
                            <th>kodi_i_testimit</th>
                            <th>kontrata</th>
                            <th>nr_serial_i_mat</th>
                            <th>numri_i_fazeve</th>
                            <th>tipi</th>
                            <th>modeli</th>
                            <th>klasa</th>
                            <th>in_a</th>
                            <th>gabimi_perq</th>
                            <th>final</th>
                            <th>leximi_pas</th>
                            <th>vula_e_makineri</th>
                            <th>etiketa_ok</th>
                            <th>etiketa_fail</th>
                            <th>vula_e_mors_e_3</th>
                            <th>vula_e_mors_e_o</th>
                            <th>personeli_3g</th>
                            <th>personeli_ossh</th>
                            <th>match_z_billing</th>
                        </thead>
                        <tbody>

                            @foreach ($products as $product) 
                                <tr>
                                    <td>{{ $product->id}}</td>
                                    <td>{{ $product->date_1}}</td>
                                    <td>{{ $product->rajoni}}</td>
                                    <td>{{ $product->agjensia}}</td>
                                    <td>{{ $product->lloji_sherbimit}}</td>
                                    <td>{{ $product->kodi_testimit}}</td>
                                    <td>{{ $product->id_klientit}}</td>
                                    <td>{{ $product->nr_serial_i_matesit_el}}</td>
                                    <td>{{ $product->nr_fazeve}}</td>
                                    <td>{{ $product->tipi}}</td>
                                    <td>{{ $product->modeli}}</td>
                                    <td>{{ $product->klasa}}</td>
                                    <td>{{ $product->i_a}}</td>
                                    <td>{{ $product->gabimi_pq}}</td>
                                    <td>{{ $product->finalja}}</td>
                                    <td>{{ $product->leximi_pas}}</td>
                                    <td>{{ $product->vula_makinerise}}</td>
                                    <td>{{ $product->etiketa_ok}}</td>
                                    <td>{{ $product->etiketa_fail}}</td>
                                    <td>{{ $product->vula_e_mors_e_vme}}</td>
                                    <td>{{ $product->vula_e_mors_e_oshee}}</td>
                                    <td>{{ $product->personeli_vme}}</td>
                                    <td>{{ $product->personeli_i_oshee}}</td>
                                    <td>{{ $product->match_z_billing}}</td>
                                </tr>
                            @endforeach    
                        </tbody>
                    </table>
                    </div>
                    <div class="pt-3 pl-3">  
                        {{ $products->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
