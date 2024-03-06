@extends('layouts/app')
@section('content')

<div class="content">
  <div class="container">
      <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header widget-user-header bg-primary">
                              <div class="d-flex">
                                <svg class="" xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24"><path d="M20 23.003L19.497 23C12.59 22.958 1 22.514 1 20c0-1.09 1.756-1.416 4.187-1.866 1.193-.22 3.677-.682 3.814-1.138-.116-.368-2.117-.889-4.523-.997L4 15.979V15l1 .026c2.06.128 5 .56 5 1.974 0 1.259-2.146 1.656-4.632 2.117-1.18.219-3.153.584-3.382.94.309.97 8.324 1.887 17.515 1.943H20zM9 5.133C9 7.412 6.814 10.5 5 14c-1.814-3.5-4-6.587-4-8.868A4.04 4.04 0 0 1 5 1a4.04 4.04 0 0 1 4 4.132zm-3.435 5.752C6.817 8.66 8 6.562 8 5.132A3.035 3.035 0 0 0 5 2a3.035 3.035 0 0 0-3 3.132c0 1.43 1.183 3.53 2.435 5.753.186.332.376.668.565 1.01.19-.342.379-.678.565-1.01zM7 5a2 2 0 1 1-2-2 2 2 0 0 1 2 2zM6 5a1 1 0 1 0-1 1 1 1 0 0 0 1-1zm17 7.132c0 2.281-2.186 5.368-4 8.868-1.814-3.5-4-6.587-4-8.868a4.002 4.002 0 1 1 8 0zm-3.435 5.753C20.817 15.66 22 13.562 22 12.132a3.003 3.003 0 1 0-6 0c0 1.43 1.183 3.53 2.435 5.753.186.332.376.668.565 1.01.19-.342.379-.678.565-1.01zM21 12a2 2 0 1 1-2-2 2 2 0 0 1 2 2zm-1 0a1 1 0 1 0-1 1 1 1 0 0 0 1-1z"/><path fill="none" d="M0 0h24v24H0z"/></svg>
                                  <h2 class="ml-3 mt-1 justify-content-center">{{$tname->name}}</h2>
                              </div>
                          </div>
                           <div class="card-footer p-0">
                  <ul class="nav flex-column">
                    @foreach ($tour as $con)
                      
                    <li class="nav-item">
                      <span class="nav-link">{{$con->name}}</span>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <!-- /.card -->
            </div>
            
            <div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
              <form>
            </div>
            
            <div class="content col-12 ">
                  <div class="container-fluid">
                    <div class="card-body" id="printableArea">
                      <table id="example2" class="table table-bordered table-hover text-center">
                          <thead>
                          <tr class="text-center">
                              <th>#</th>
                              <th>Date</th>
                              <th>Amount</th>
                              <th>Details</th>
                              <th colspan="2">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>12</td>
                                  <td>232</td>
                                  <td>2112</td>
                                  <td>2323</td>
                              </tr>
                          </tbody>
                      </table>
                      
                  </div>
                </div>
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
            <input type="number" class="form-control" name="limitamt" />
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection