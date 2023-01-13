@extends('layouts.admin')

@section('title','Role Details')

@section('header')

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Role Details</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/role')}}" class="text-muted text-hover-primary">Roles</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Role Details</li>
</ul>
@endsection

@section('content')

<div class="d-flex flex-column flex-lg-row">
    <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
        <div class="card card-flush">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="mb-0">{{$role->name}}</h2>
                </div>

            </div>
            @if(in_array('update-admin-role', config('updatePermissions')))
            <div class="card-footer pt-0">
                <a href="{{url('/role/viewUpdate')}}/{{$role->slug}}" class="btn btn-light btn-active-primary w-100" >Update Role</a>
            </div>
            @endif

        </div>
    </div>
    <div class="flex-lg-row-fluid ms-lg-10">
        <div class="card card-flush mb-6 mb-xl-9">
            <div class="card-header pt-5">
                <div class="card-title">
                    <h2 class="d-flex align-items-center">Users Assigned
                        <span class="text-gray-600 fs-6 ms-1">({{$users->count()}})</span>
                    </h2>
                </div>

            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_roles_view_table">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-50px text-center ">Username</th>
                            <th class="min-w-150px">User</th>
                            <th class="min-w-125px text-center ">Joined Date</th>
                            <th class="text-center min-w-100px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @foreach ($users as $data)
                        <tr>
                            <td class="text-center">{{$data->username}}</td>
                            <td class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <div class="symbol-label">
                                        <img src="{{$data->profileImage != null ? $data->profileImage : 'assets/media/blank.png'}}" alt="Emma Smith" class="w-100" />
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a class="text-gray-800 text-hover-primary mb-1">{{$data->employeeName}}</a>
                                    <span>{{$data->email}}</span>
                                </div>
                            </td>

                            <td class="text-center">{{date('d M ,Y', strtotime($data->created_at))}}</td>
                            <td class="text-center">
                                @if(in_array('update-admin-user', config('updatePermissions')))
                                <a href="{{url('/user/view')}}/{{$data->username}}" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </a>
                                @endif

                                @if(in_array('delete-admin-user', config('deletePermissions')))
                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}">
                                    <span class="svg-icon svg-icon-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </button>
                                @endif
                            </td>
                        </tr>
                        <!--delete modal start-->
                        <div class="modal fade" id="deleteModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete User</h5>
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <form action="{{url('user/delete')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$data->id}}" name="hiddenId">
                                        <div class="modal-body">
                                            <span>Are you sure you want to delete {{$data->emplyeeName}}? <br> Action cannot be reverted</span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="delYes" class="btn btn-danger">Yes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--delete modal end-->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection