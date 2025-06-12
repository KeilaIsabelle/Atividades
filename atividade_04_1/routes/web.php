<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/media-ano', function () {
    $mediaAno = Book::avg('published_year');
    return "Ano médio de publicação: $mediaAno";
});
