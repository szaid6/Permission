@extends('layouts.admin')

@section('title','Roles')

@section('header')

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Roles Management</h1>
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="" class="text-muted text-hover-primary">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-dark">Roles</li>
</ul>
@endsection

@section('content')

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
    @foreach($roles as $data)
    @if(Auth::user()->rolee->slug == 'hyplap')
    @if($data->slug == 'hyplap')
    <div class="col-md-4">
        <div class="card card-flush h-md-100">
            <div class="card-header">
                <div class="card-title flex-column">
                    <h2>{{$data->name}}</h2>
                    <div class="fs-6 fw-semibold text-muted">Total users with this role:
                        <?php
                        $count = 0;
                        foreach ($userRoleCount as $userRole) {
                            if ($userRole['roleId'] == $data->slug) {
                                $count = $userRole['total'];
                            }
                        }
                        echo $count;
                        ?>
                    </div>
                </div>
            </div>
            <div class="card-body pt-1">
                <div class="fs-6 fw-semibold text-muted">Users Assigned:</div>
                <div style="max-height: 100px; overflow-y: auto;">
                    @foreach($users as $user)
                    @if($user->roleId == $data->slug)
                    <div class="d-flex flex-column text-gray-600">
                        <div class="d-flex align-items-center py-2">
                            <span class="bullet bg-primary me-3"></span>{{$user->employeeName}}
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="card-footer flex-wrap pt-0">
                <a href="{{url('role/view')}}/{{$data->id}}" class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                <a href="{{url('role/viewUpdate')}}/{{$data->slug}}" class="btn btn-light btn-active-light-primary my-1">Update Role</a>
            </div>
        </div>
    </div>
    @endif
    @endif
    @if($data->slug != 'hyplap')
    <div class="col-md-4">
        <div class="card card-flush h-md-100">
            <div class="card-header">
                <div class="card-title flex-column">
                    <h2>{{$data->name}}</h2>
                    <div class="fs-6 fw-semibold text-muted">Total users with this role:
                        <?php
                        $count = 0;
                        foreach ($userRoleCount as $userRole) {
                            if ($userRole['roleId'] == $data->slug) {
                                $count = $userRole['total'];
                            }
                        }
                        echo $count;
                        ?>
                    </div>
                </div>
            </div>
            <div class="card-body pt-1">
                <div class="fs-6 fw-semibold text-muted">Users Assigned:</div>
                <div style="max-height: 100px; overflow-y: auto;">
                    @foreach($users as $user)
                    @if($user->roleId == $data->slug)
                    <div class="d-flex flex-column text-gray-600">
                        <div class="d-flex align-items-center py-2">
                            <span class="bullet bg-primary me-3"></span>{{$user->employeeName}}
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="card-footer flex-wrap pt-0">
                <a href="{{url('role/view')}}/{{$data->id}}" class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                <a href="{{url('role/viewUpdate')}}/{{$data->slug}}" class="btn btn-light btn-active-light-primary my-1">Update Role</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <div class="col-md-4">
        <div class="card h-md-100">
            <div class="card-body d-flex flex-center">
                <a href="{{url('/role/showAdd')}}" class="btn btn-clear d-flex flex-column flex-center">
                    <img src="{{asset('assets/media/illustrations/sketchy-1/4.png')}}" alt="" class="mw-100 mh-150px mb-7" />

                    <div class="btn btn-primary btn-active-light-primary my-1">Add New Role</div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection