<?php

use App\Http\Controllers\API\Contacts\ContactController;

// prefix: api/contacts

Route::post('/', [ContactController::class, 'store']);
