@extends('layouts/app')
@section('content')
<div class="content">
    <div class="container">
        <div>
            <h1>Add Expense</h1>
        </div>
        <div class="row">
            <form action="{{route('add.store')}}" id="expense" method="POST">
                @csrf

                <div class="col">
                    <div class="form-group row">
                        <label for="Enter Amount" class="col-sm-5 col-form-label2">Enter Amount(₹)</label>
                        <div class="col-sm-7">
                            <input type="number" value="" class="form-control" id="expenseamount" name="expenseamount" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expensedate" class="col-sm-5 col-form-label"><b>Date</b></label>
                        <div class="col-md-7">
                            <input type="date" class="form-control col-sm-12" value=""
                                name="expensedate" id="expensedate" required>
                        </div>
                    </div>
                    
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-6 pt-0"><b>Category</b></legend>
                            <div class="col-md">
                                <fieldset class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            @foreach ($data as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory4" value="{{$category->name}}" >
                                                <label class="form-check-label" for="expensecategory4">
                                                {{$category->name}}
                                                </label>
                                            </div>    
                                            @endforeach     
                                        </div>
                                    </div>              
                                </fieldset>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row mt-3">
                            <label for="Enter Description" class="col-sm-5 col-form-label2">Description</label>
                            <div class="col-sm-7">
                                <textarea placeholder="Enter description" name="expensedescription"></textarea>
                            </div>
                    </div>
                    <div class="form-group row">
                          <div class="col-md-12 text-right">
                                  <button type="submit" name="add" class="btn btn-lg btn-block btn-success mt-2" style="border-radius: 0%;">Add Expense</button>
                          </div>
                      </div>
                </div>
            </form>

            <!-- /.row -->
        </div>
    </div>
</div>
@endsection