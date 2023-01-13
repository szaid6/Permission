<?php

Route::get('checkStatus', function () {
    return 'Permission package is installed';
});

Route::group(['middleware' => 'permissions'], function () {

    Route::group(
        [
            'prefix' => 'user'
        ],
        function () {
            Route::post('/updateRole', [AdminController::class, 'updateUserRole']);
            Route::get('/permission/{username}', [AdminController::class, 'showUserPermissions']);
            Route::post('/assignPermission', [AdminController::class, 'assignUserPermissions']);
        }
    );

    // Roles 
    Route::group(
        [
            'prefix' => 'role'
        ],
        function () {
            Route::get('/', [AdminController::class, 'indexRole']);
            Route::get('/showAdd', [AdminController::class, 'showAddRole']);
            Route::post('/add', [AdminController::class, 'addRole']);
            Route::get('/view/{id}', [AdminController::class, 'viewRole']);
            Route::get('/viewUpdate/{name}', [AdminController::class, 'showUpdateRole']);
            Route::post('/update', [AdminController::class, 'updateRole']);
            Route::post('/delete', [AdminController::class, 'deleteRole']);
        }
    );

    // Permissions
    Route::group(
        [
            'prefix' => 'permission'
        ],
        function () {
            Route::get('/', [AdminController::class, 'indexPermission']);
            Route::post('/add', [AdminController::class, 'addPermission']);
            Route::post('/update', [AdminController::class, 'updatePermission']);
            Route::post('/delete', [AdminController::class, 'deletePermission']);
        }
    );
});
