<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\CorrespondenceSystem\Controllers\LetterController;
use Mkhodroo\CorrespondenceSystem\Controllers\NumberingFormatController;
use Mkhodroo\CorrespondenceSystem\Controllers\ReceiverController;
use Mkhodroo\CorrespondenceSystem\Controllers\RoleController;
use Mkhodroo\CorrespondenceSystem\Controllers\TemplateAccessController;
use Mkhodroo\CorrespondenceSystem\Controllers\TemplateController;
use Mkhodroo\CorrespondenceSystem\Controllers\UserRoleController;
use PhpOffice\PhpWord\TemplateProcessor;

Route::name('atmn.')->prefix('atmn')->middleware(['web', 'auth'])->group(function () {
    Route::name('download.')->prefix('download')->group(function () {
        Route::get('', function () {
            
            $file = fopen(public_path('file.docx'), 'wb');
            fwrite($file, base64_decode(TemplateController::get(4)->file));
            fclose($file);
            $phpword = new TemplateProcessor(public_path('file.docx'));
            $phpword->setValue('{Receivers}','Santosh');
            $phpword->saveAs(public_path('edited.docx'));
        });
    });

    Route::name('role.')->prefix('role')->group(function () {
        Route::get('list-form', [RoleController::class, 'listForm'])->name('listForm');
        Route::get('list', [RoleController::class, 'list'])->name('list');
        Route::get('create-form', [RoleController::class, 'createForm'])->name('createForm');
        Route::post('create', [RoleController::class, 'create'])->name('create');
        Route::post('edit-form', [RoleController::class, 'editForm'])->name('editForm');
        Route::post('edit', [RoleController::class, 'edit'])->name('edit');
    });

    Route::name('userRole.')->prefix('user-role')->group(function () {
        Route::get('list-form', [UserRoleController::class, 'listForm'])->name('listForm');
        Route::get('list', [UserRoleController::class, 'list'])->name('list');
        Route::get('create-form', [UserRoleController::class, 'createForm'])->name('createForm');
        Route::post('create', [UserRoleController::class, 'create'])->name('create');
        Route::post('edit-form', [UserRoleController::class, 'editForm'])->name('editForm');
        Route::post('edit', [UserRoleController::class, 'edit'])->name('edit');
    });

    Route::name('numberingFormat.')->prefix('numbering-format')->group(function () {
        Route::get('list-form', [NumberingFormatController::class, 'listForm'])->name('listForm');
        Route::get('list', [NumberingFormatController::class, 'list'])->name('list');
        Route::get('create-form', [NumberingFormatController::class, 'createForm'])->name('createForm');
        Route::post('create', [NumberingFormatController::class, 'create'])->name('create');
        Route::post('edit-form', [NumberingFormatController::class, 'editForm'])->name('editForm');
        Route::post('edit', [NumberingFormatController::class, 'edit'])->name('edit');
    });

    Route::name('template.')->prefix('template')->group(function () {
        Route::get('list-form', [TemplateController::class, 'listForm'])->name('listForm');
        Route::get('list', [TemplateController::class, 'list'])->name('list');
        Route::get('create-form', [TemplateController::class, 'createForm'])->name('createForm');
        Route::post('create', [TemplateController::class, 'create'])->name('create');
        Route::post('edit-form', [TemplateController::class, 'editForm'])->name('editForm');
        Route::post('edit', [TemplateController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [TemplateController::class, 'download'])->name('download');
    });

    Route::name('templateAccess.')->prefix('template-access')->group(function () {
        Route::get('list-form', [TemplateAccessController::class, 'listForm'])->name('listForm');
        Route::get('list', [TemplateAccessController::class, 'list'])->name('list');
        Route::get('create-form', [TemplateAccessController::class, 'createForm'])->name('createForm');
        Route::post('create', [TemplateAccessController::class, 'create'])->name('create');
        Route::post('edit-form', [TemplateAccessController::class, 'editForm'])->name('editForm');
        Route::post('edit', [TemplateAccessController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [TemplateAccessController::class, 'download'])->name('download');
    });

    Route::name('letter.')->prefix('letter')->group(function () {
        Route::get('select-template-form', [LetterController::class, 'selectLetterTemplateForm'])->name('selectLetterTemplateForm');
        Route::get('select-template', [LetterController::class, 'selectLetterTemplate'])->name('selectLetterTemplate');
        Route::post('create-form', [LetterController::class, 'createForm'])->name('createForm');
        Route::post('create', [LetterController::class, 'create'])->name('create');
        Route::post('edit-form', [LetterController::class, 'editForm'])->name('editForm');
        Route::post('edit', [LetterController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [LetterController::class, 'download'])->name('download');
    });

    Route::name('letterReceiver.')->prefix('letter-receiver')->group(function () {
        Route::get('list-form', [ReceiverController::class, 'listForm'])->name('listForm');
        Route::get('list', [ReceiverController::class, 'list'])->name('list');
        Route::get('create-form', [ReceiverController::class, 'createForm'])->name('createForm');
        Route::post('create', [ReceiverController::class, 'create'])->name('create');
        Route::post('edit-form', [ReceiverController::class, 'editForm'])->name('editForm');
        Route::post('edit', [ReceiverController::class, 'edit'])->name('edit');
        Route::get('download/{id}', [ReceiverController::class, 'download'])->name('download');
    });
});
