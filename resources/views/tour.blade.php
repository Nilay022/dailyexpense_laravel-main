@extends('layouts/app')
@section('content')

<div class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <p>Total Contact</p>
                    <div>
                      <h3>{{$contactcount}}</h3>
                    </div>
                </div>

                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                   <p>Total Trip</p>
                   <div>
                      <h3>{{$tourconut}}</h3>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
            </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                <p>New Trip</p>
                 <div>
                  <h3>&nbsp;</h3>
                  
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-plus"></i>
                </div>
                <a href="#" type="button" class="btn btn-tool small-box-footer" data-toggle="modal" data-target="#addTour"  >Add Tour <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
         <div class="container-fluid">
          <div class="row">
              <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Members</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#addModal" >
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach ($contact as $con)
                      
                      <li>
                        <img src="dist/img/user1-128x128.jpg" >
                        <a class="remove-image" href="{{route('memberdelete' ,$con->cid)}}" style="display: inline; color: red; font-size: 25px;">&#215;</a>
                        <p class="users-list-name" href="#">{{$con->name}}</p>
                      </li>
                      @endforeach
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="javascript:">View All Users</a>
                  </div>
                  <!-- /.card-footer -->
              
                </div>
                <!--/.card -->
              </div>
               <div class="col-md-6">
                   <div class="card">
                       <div class="card-header">
                    <h3 class="card-title">Tour List</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#addTour" >
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Tour</th>
                          <th>Total Expense</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($amount as $t)
                       
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td><a href="{{route('tourdetail',$t->tid)}}" style="color: black">{{$t->name}}</a></td>
                          <td>{{$t->amount ?? 0}}</td>
                        </tr>
                      
                        @endforeach
              
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div>
          </div>
          </div>
         </div>
              <!-- /.card-body -->

            </div>
    </div>
</div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('addContact')}}">
          @csrf
          <input type="hidden" name="uid" value="{{Auth::id()}}" hidden/>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control"  name="cname" aria-describedby="emailHelp" />
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addTour" tabindex="-1" role="dialog" aria-labelledby="addTourLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add New Tour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('addTourMember')}}">
          @csrf
          <input type="hidden" name="uid" value="{{Auth::id()}}" hidden/>
          <div class="form-group">
            <label>Tour Name</label>
            <input type="text" class="form-control"  name="cname" aria-describedby="emailHelp" />
          </div>
          <div class="form-group">
            <label>Select Members</label>
            <select class="form-control" id="membername" name="membername[]" aria-label="Default select example" multiple>
              @foreach ($contact as $con)
                
              <option value="{{$con->cid}}">{{$con->name}}</option>
              @endforeach
              
              </select>
            </div>
            <div class="form-group">
              <label>Select All</label>
              <input type="checkbox" style="margin-left: 3%" name="selectall" id="selectall">
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
function openpostmethod(id)
{
   $.ajax({
            url: "{{url('memberdelete/')}}/"+id,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            statusCode:{
              200: function (response) {

              }
            },
            error: function (error) {
                console.log(error);
            }
      });
   }


$('#selectall').click(function() {
  var data = $('#selectall').val();
  console.log(data);
    $('#membername option').prop('selected', true);
});

  </script>
  @endsection
