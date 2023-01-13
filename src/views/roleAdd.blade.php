@extends('layouts.admin')

@section('title','Add Role')

@section('header')

@endsection

@section('breadcrumb')
<h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Add Role</h1>
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
    <li class="breadcrumb-item text-dark">Add Role</li>
</ul>
@endsection

@section('content')

<form action="{{url('/role/add')}}" id="kt_modal_add_form" method="post">
    @csrf
    <div class="card card-flush mb-10">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="fv-row mb-10">
                        <label class="fs-5 fw-bold form-label mb-2">
                            <span class="required" id="rolename">Role name</span>
                        </label>
                        <input class="form-control form-control-solid" placeholder="Enter a role name" name="name" />
                    </div>
                    <div class="fv-row mb-10">
                        <label class="fs-5 fw-bold form-label mb-2">
                            <span class="required" id="rolename">Attendance Flag</span>
                        </label>
                        <select name="attendanceFlag" class="form-control " data-control="select2" data-hide-search="true">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="fs-5 fw-bold form-label mb-5">
                        <span class="required">Select User Permissions </span>
                    </label>
                    <div class="form-check form-check-custom form-check-solid mb-3">
                        <input class="form-check-input" type="checkbox" id="select-all">
                        <label class="form-check-label" for="userPermission">
                            Select All Permissions
                        </label>
                    </div>
                    <label class="fs-5 fw-bold form-label mb-5">
                        <span class="required">Select Primary Permissions </span>
                    </label>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="text-center">ADMIN PANEL</div>
                            <hr>
                            @foreach($permissions as $permission)
                            @if($permission->panel == 'admin')
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#{{$permission->slug}}" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">{{$permission->tab}}
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{$permission->slug}}" class="collapse">
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="view-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">View</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="add-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Add</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="update-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Update</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="delete-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center">MASTER PANEL</div>
                            <hr>
                            @foreach($permissions as $permission)
                            @if($permission->panel == 'master')
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#{{$permission->slug}}" role="button" aria-expanded="false" aria-controls="{{$permission->slug}}">{{$permission->tab}}
                                    <span class="ms-2 rotate-180 ">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{$permission->slug}}" class="collapse">
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="view-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">View</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="add-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Add</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="update-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Update</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="delete-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center">NABL PANEL</div>
                            <hr>
                            @foreach($permissions as $permission)
                            @if($permission->panel == 'nabl')
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#{{$permission->slug}}" role="button" aria-expanded="false" aria-controls="{{$permission->slug}}">{{$permission->tab}}
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{$permission->slug}}" class="collapse">
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="view-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">View</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="add-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Add</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="update-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Update</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="delete-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center">TRANSACTION PANEL</div>
                            <hr>
                            @foreach($permissions as $permission)
                            @if($permission->panel == 'trx')
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#{{$permission->slug}}" role="button" aria-expanded="false" aria-controls="{{$permission->slug}}">{{$permission->tab}}
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{$permission->slug}}" class="collapse">
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="view-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">View</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="add-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Add</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="update-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Update</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="delete-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center">REPORT PANEL</div>
                            <hr>
                            @foreach($permissions as $permission)
                            @if($permission->panel == 'report')
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#{{$permission->slug}}" role="button" aria-expanded="false" aria-controls="{{$permission->slug}}">{{$permission->tab}}
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{$permission->slug}}" class="collapse">
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="view-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">View</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="add-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Add</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="update-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Update</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="delete-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center">INVENTORY PANEL</div>
                            <hr>
                            @foreach($permissions as $permission)
                            @if($permission->panel == 'inventory')
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse" href="#{{$permission->slug}}" role="button" aria-expanded="false" aria-controls="{{$permission->slug}}">{{$permission->tab}}
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div id="{{$permission->slug}}" class="collapse">
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="view-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">View</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="add-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Add</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="update-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Update</label>
                                    </div>
                                </div>
                                <div class="fs-6 my-2 ">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="delete-{{$permission->slug}}" name="permissions[]" />
                                        <label class="form-check-label">Delete</label>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary" id="kt_modal_add_submit">Save</button>
    </div>
</form>
@endsection

@section('scripts')

<script>
    $('.adminpermission').change(function(e) {
        e.preventDefault();
        console.log(documnent.getElementById('adminpermission').value);
    });
</script>

<script>
    var KTModalAdd = function() {
        var t, e, o, n, r, i;
        return {
            init: function() {
                r = document.querySelector("#kt_modal_add_form"),
                    t = r.querySelector("#kt_modal_add_submit"),
                    n = FormValidation.formValidation(r, {
                        fields: {
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: "Name is required",
                                    },

                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    }), t.addEventListener("click", (function(e) {
                        e.preventDefault(), n && n.validate().then((function(e) {

                            console.log("validated!"), "Valid" == e ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function() {
                                t.removeAttribute("data-kt-indicator")
                                e.isConfirmed && (t.disabled = !1)

                                // Submit form
                                r.submit();

                            }), 2e3)) : Swal.fire({
                                text: "Sorry, looks like there are some missing fields, please try again.",
                                icon: "error",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            })
                        }))
                    }))
            }
        }
    }();
    KTUtil.onDOMContentLoaded((function() {
        KTModalAdd.init()
    }));
</script>

<script>
    $('#select-all').click(function(e) {
        var checkboxes = document.getElementsByName('permissions[]');
        if (this.checked) {
            alert('Caution! You are about to grant all permissions to this user.');
            for (var checkbox of checkboxes) {
                checkbox.checked = true;

            }
        } else {
            alert('Caution! You are about to remove all permissions from this user.');
            for (var checkbox of checkboxes) {
                checkbox.checked = false;
            }
        }
    });
</script>

@endsection