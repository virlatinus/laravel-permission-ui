<?php

use Illuminate\Support\Facades\Route;
use virlatinus\PermissionsUI\Controllers\RoleController;
use virlatinus\PermissionsUI\Controllers\PermissionController;
use virlatinus\PermissionsUI\Controllers\UserController;

Route::redirect(config('permission_ui.url_prefix'), config('permission_ui.url_prefix') . '/users');

Route::group([
    'middleware' => config('permission_ui.middleware'),
    'prefix'     => config('permission_ui.url_prefix'),
    'as'         => config('permission_ui.route_name_prefix')],
    static function () {
        Route::resource('roles', RoleController::class)->except('show');
        Route::resource('permissions', PermissionController::class)->except('show');
        Route::resource('users', UserController::class)->except('show');

        Route::get('/users/delete/{user}/{role}', [UserController::class, 'deleteRole'])->name('users.delete_role');
        Route::post('/users/edit_multi', [UserController::class, 'editMultiple'])->name('users.edit_multi');
        Route::post('/users/update_multi', [UserController::class, 'updateMultiple'])->name('users.update_multi');
        Route::post('/users/delete_multi', [UserController::class, 'deleteMultiple'])->name('users.delete_multi');

        Route::get('/roles/delete/{role}/{permission}', [RoleController::class, 'deletePermission'])->name('roles.delete_permission');
        Route::post('/roles/edit_multi', [RoleController::class, 'editMultiple'])->name('roles.edit_multi');
        Route::post('/roles/update_multi', [RoleController::class, 'updateMultiple'])->name('roles.update_multi');
        Route::post('/roles/delete_multi', [RoleController::class, 'deleteMultiple'])->name('roles.delete_multi');

        Route::get('/permissions/delete/{permission}/{role}', [PermissionController::class, 'deleteRole'])->name('permissions.delete_role');
        Route::post('/permissions/edit_multi', [PermissionController::class, 'editMultiple'])->name('permissions.edit_multi');
        Route::post('/permissions/update_multi', [PermissionController::class, 'updateMultiple'])->name('permissions.update_multi');
        Route::post('/permissions/delete_multi', [PermissionController::class, 'deleteMultiple'])->name('permissions.delete_multi');

    });
