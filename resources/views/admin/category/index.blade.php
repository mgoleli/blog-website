@extends('layout')
@section('meta_desc',$meta_desc)
@section('title',$title)
@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Dashboard</a>
    </li>
  </ol>


  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> Kategoriler
      <a href="{{url('admin/category/create')}}" class="float-right btn btn-sm btn-dark">Kategori Ekle</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Başlık</th>
              <th>Görsel</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Başlık</th>
              <th>Görsel</th>
            </tr>
          </tfoot>
          <tbody>
              @foreach($data as $cat)
              <tr>
                <td>{{$cat->id}}</td>
                <td>{{$cat->title}}</td>
                <td><img src="{{ asset('imgs').'/'.$cat->image }}" width="100" /></td>
                <td>
                  <a class="btn btn-info btn-sm" href="{{url('admin/category/'.$cat->id.'/edit')}}">Güncelle</a>
                  <a onclick="return confirm('silmek istediğinize emin misiniz?')" class="btn btn-danger btn-sm" href="{{url('admin/category/'.$cat->id.'/delete')}}">Sil</a>
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection
