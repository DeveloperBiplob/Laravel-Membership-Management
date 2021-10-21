<style>
    div#postTable_paginate {
        display: inline-block;
        float: right;
    }
    div#postTable_filter {
        display: inline-block;
        float: right;
    }
</style>

@extends('backend.layouts.backend_master')

@section('title', 'User List | Admin Panel')

@push('css')
<!-- Bootstrap Datatabel-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>
@endpush

@section('master-content')
<div class="card">
    <div class="card-header bg-gradient-light">
        <div class="d-flex justify-content-between">
        <h4 style="font-size:30px" class="card-title text-info">Manage Users</h4>
        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New User</a>
        </div>

    </div>
    <div class="card-body">
        <table class="table table-bordered" id="postTable">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                   <td>{{ $loop->index + 1 }}</td>
                   <td>{{ $user->name }}</td>
                   <td>{{ $user->email }}</td>
                   <td><img width="50px" src="{{ asset($user->image) }}" alt=""></td>
                   <td>{{ $user->phone }}</td>
                   <td>{{ $user->status }}</td>
                   <td>{{ $user->designation->name }}</td>
                   <td>
                       <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-xs btn-primary ">Edit</a>
                       <button type="button" class="btn btn-xs btn-danger d-inline-block" data-toggle="modal" data-target="#delete-user-{{ $user->id }}">
                        Delete
                      </button>
                   </td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>

  <!-- Delete Modal -->
    @foreach ($users as $user)
    <div class="modal fade" id="delete-user-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure to Delete?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </form>
          </div>
        </div>
      </div>
      </div>
    @endforeach

@endsection

@push('script')
<!-- Bootstrap datatable-->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@endpush
@push('script')
<script>
    $(document).ready( function () {
        $('#postTable').DataTable();
    } );
    </script>
@endpush

