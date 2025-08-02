<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing; 

class BorrowingController extends Controller
{
    public function store(Request $request, Book $book)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Verifica se já existe empréstimo aberto para o livro
    $openBorrowing = Borrowing::where('book_id', $book->id)
                    ->whereNull('returned_at')
                    ->first();

    if ($openBorrowing) {
        return redirect()->route('books.show', $book)
                         ->withErrors(['book_unavailable' => 'Este livro já está emprestado e ainda não foi devolvido.']);
    }

    // Se não tiver empréstimo aberto, cria o novo empréstimo
    Borrowing::create([
        'user_id' => $request->user_id,
        'book_id' => $book->id,
        'borrowed_at' => now(),
    ]);

    return redirect()->route('books.show', $book)->with('success', 'Empréstimo registrado com sucesso.');
}


    
public function returnBook(Borrowing $borrowing)
{
    $borrowing->update([
        'returned_at' => now(),
    ]);

    return redirect()->route('books.show', $borrowing->book_id)->with('success', 'Devolução registrada com sucesso.');
}
public function userBorrowings(User $user)
{
    $borrowings = $user->books()->withPivot('borrowed_at', 'returned_at')->get();

    return view('users.borrowings', compact('user', 'borrowings'));
}
public function index()
{
    $this->authorize('viewAny', Borrowing::class); // se usar policy

    // Pega todos os empréstimos com info do usuário e livro
    $borrowings = Borrowing::with(['user', 'book'])->paginate(20);

    return view('borrowings.index', compact('borrowings'));
}


}
