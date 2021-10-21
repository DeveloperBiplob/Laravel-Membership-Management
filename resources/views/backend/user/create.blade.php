@extends('backend.layouts.backend_master')

@section('title', 'User Create | Admin Panel')

@section('master-content')
    <div class="card mt-2">
        <div class="card-body">
            <h4 class="text-info float-left">Create New User</h4>
            <a class="btn btn-primary btn-sm float-right" href="{{ route('admin.user.index') }}">Back Dashboard</a>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row m-2 py-3">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="" class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="userName">User Name</label>
                      <input type="text" name="userName" id="" class="form-control" placeholder="Enter User Name" value="{{ old('userName') }}">
                    </div>
                    @error('userName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="" class="form-control" placeholder="Enter Email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="email">Desination</label>
                      <select name="designation_id" id="" class="form-control">
                          @foreach ($designations as $designation)
                            <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    @error('designation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                      <label for="email">Status</label>
                      <select name="status" id="" class="form-control">
                          <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                          <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="" class="form-control" placeholder="Enter Password" >
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" name="phone" id="" class="form-control" placeholder="Enter Phone" value="{{ old('phone') }}">
                    </div>
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Confirm Password</label>
                      <input type="password" name="con_password" id="" class="form-control" placeholder="Enter Confirm Password" >
                    </div>
                    @error('con_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">Present Address</label>
                      <input type="text" name="present_address" id="" class="form-control" placeholder="Enter Present Address" value="{{ old('present_address') }}">
                    </div>
                    @error('present_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">Parmanent Address</label>
                      <input type="text" name="parmanet_address" id="" class="form-control" placeholder="Enter Parmanent Address" value="{{ old('parmanet_address') }}">
                    </div>
                    @error('parmanet_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="image">Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                      </div>
                      @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
