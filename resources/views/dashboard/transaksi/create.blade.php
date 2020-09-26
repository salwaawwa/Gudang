@extends('layouts.admin-master')

@section('title')
    Transaksi
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Transaksi</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Transaksi</h4>
                </div>
                <div class="card-body">

                    @if(session()->has('info'))
                        <div class="alert alert-primary">
                            {{ session()->get('info') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-4">

                        </div>

                        <div class="col-lg-4">

                            <form action="{{route('transaksi.store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Barang</label>
                                    <select name="barang_id" id="" class="form-control">
                                        @foreach ($barang as $item)
                                    <option value="{{$item->id}}">{{$item->nama_barang}}  ({{Awa::Rupiah($item->harga)}})</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group">
                                    <label for="">Qty</label>
                                    <input type="number" name="qty" class="form-control" >
                                </div>
    
                                <div class="form-group">
                                    <label for="">Status Bayar</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="sudah_bayar">Sudah Bayar</option>
                                        <option value="belum_bayar">Belum Bayar</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            
                        </div>

                        <div class="col-lg-4">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection