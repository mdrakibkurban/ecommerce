@extends('admin.layouts.app')

@section('content-title') 
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Category</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Category</li>
      </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Category Create</h3>
        
              <div class="card-tools">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Category List</a>
              </div>
            </div>
            <form method="post" action="{{ route('admin.categories.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" name="name" value="{{ old('name')}}" id="name" placeholder="Enter Name">
                    @error('name')
                         <span style="color: red">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                    <label for="section_id">Section</label>
                    <select name="section_id" id="section_id" class="form-control">
                        <option value="">--select section--</option>
                        @foreach ($section as $value => $description)
                        <option value="{{ $value }}"{{ old('section_id') == strval($value) ? 'selected' : ' ' }}>{{ $description }}</option>
                        @endforeach
                    </select>
                    @error('section_id')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="status">Status</label><br>
                    <div class="icheck-success d-inline">
                      <input type="radio" name="status" id="active" value="1" {{(old('status') == '1') ? 'checked' : ''}}>
                      <label for="active">
                        Active
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      <input type="radio" name="status" id="inactive" value="0" {{(old('status') == '0') ? 'checked' : ''}}>
                      <label for="inactive">
                        Inactive
                      </label>
                    </div>
                  </div>
                    @error('status')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
        </div>
    </div>
</div>
@endsection

