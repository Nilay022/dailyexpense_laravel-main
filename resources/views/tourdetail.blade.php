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
               <div>
              <form action="{{route('Addtourdetail')}}" method="post">
                            @csrf

                <input type="hidden" name="tdid" id="tdid">    
                <input type="hidden" name="tourid" id="id" value="{{$tname->tid}}">
                <div class="form-group">
                <label for="exampleInputEmail1">Enter date</label>
                <input type="date" name="date" id="date" class="form-control">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Amount(₹)</label>
                <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Details</label>
                <input type="text" class="form-control" id="detail" required name="detail" placeholder="Enter details">
              </div>
              <div class="form-group form-check">
              </div>
              <button type="submit" class="btn btn-primary">Add</button>
            </form>
            </div>
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
                            @foreach ($data as $details)
                              <tr>
                                <td>1</td>
                                <td>{{$details->date}}</td>
                                <td>{{$details->amount}}</td>
                                <td>{{$details->detail}}</td>
                                <td>
                                  <a href="#" onclick="updatetourdetail({{$details}});" class="btn btn-primary">Edit</a>
                                  <a href="{{route('Deletetourdetail',$details->tdid)}}" class="btn btn-danger">Delete</a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
          </div>
  </div>
</div>

@endsection

@section('js')

<script>

  function updatetourdetail(data)
  {
      document.getElementById('tdid').value = data.tdid;
      document.getElementById('date').value = data.date;
      document.getElementById('amount').value = data.amount;
      document.getElementById('detail').value = data.detail;
      
  }
  </script>
@endsection