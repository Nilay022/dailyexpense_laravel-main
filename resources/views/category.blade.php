@extends('layouts/app')
@section('content')

<div class="content">
    <div class="container">
        
          <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Category</h3>
                            <div class="col-12" style="text-align: right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                  Add
                                </button>

                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" id="printableArea">
                            <table id="example2" class="table table-bordered table-hover text-center">
                                <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @if(!@empty($data))
                                @foreach ($data as $e)
                                    <tr>
                                        <td> {{$loop->iteration}}</td>
                                        <td> {{$e->name}}</td>
                                        <td> {{$e->limit}}</td>
                                        <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="openPostModal({{$e->id}})">Edit
                                        </button>    
                                        <button class="btn btn-danger"><a href="{{ route('deleteCategory', $e->id)}}" style="color: white;">Delete</a></button>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                  <td>no data found</td>
                                </tr>
                                @endif
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
        <form method="POST" action="{{route('updateCategory')}}">
          @csrf
          <input type="hidden" name="cid" id="catid"/>
          <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <input type="text" class="form-control" id="categorydata" name="catename" aria-describedby="emailHelp" />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Limit</label>
            <input type="number" class="form-control" name="limitamt" id="limitdata" />
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('AddCategory')}}">
          @csrf
          <input type="hidden" name="uid" value="{{Auth::id()}}" hidden/>
          <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <input type="text" class="form-control"  name="catename" aria-describedby="emailHelp" />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Limit</label>
            <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" class="form-control" name="limitamt" />
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
function openPostModal(id)
{
   $.ajax({
            url: "{{url('posts/')}}/"+id,
            type: 'GET',
            statusCode:{
              200: function (response) {
                $('#categorydata').val(response.name);
                $('#limitdata').val(response.limit);
                $('#catid').val(response.id);
                $('#exampleModal').modal('show');
            }
            },
            error: function (error) {
                console.log(error);
            }
      });
   }

  </script>
  @endsection
