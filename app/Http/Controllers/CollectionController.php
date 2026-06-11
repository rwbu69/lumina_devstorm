<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();

        $books = Book::query()
            ->whereHas('orderDetails.order', function ($query) use ($userId): void {
                $query->where('user_id', $userId)
                    ->where('status', 'verified');
            })
            ->with('category')
            ->get();

        return view('collection.index', [
            'books' => $books,
        ]);
    }

    public function download(Book $book)
    {
        $userId = Auth::id();

        // Verifikasi kepemilikan
        $hasAccess = $book->orderDetails()->whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('status', 'verified');
        })->exists();

        if (! $hasAccess) {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh buku ini.');
        }

        // Kalau ada file fisiknya, gunakan file fisik
        if ($book->file_buku && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->file_buku)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->download($book->file_buku, \Illuminate\Support\Str::slug($book->judul).'.pdf');
        }

        // Karena ini demo dan file fisik tidak ada dari seeder, kembalikan dummy PDF on the fly
        $pdfContent = "%PDF-1.4\n%...\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /MediaBox [0 0 612 792] /Contents 5 0 R >>\nendobj\n4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n5 0 obj\n<< /Length 53 >>\nstream\nBT\n/F1 24 Tf\n100 700 Td\n(".strtoupper($book->judul).")\nTj\nET\nendstream\nendobj\nxref\n0 6\n0000000000 65535 f \n0000000015 00000 n \n0000000064 00000 n \n0000000122 00000 n \n0000000234 00000 n \n0000000322 00000 n \ntrailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n426\n%%EOF";

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.\Illuminate\Support\Str::slug($book->judul).'.pdf"',
        ]);
    }

    public function read(Book $book)
    {
        $userId = Auth::id();

        // Verifikasi kepemilikan
        $hasAccess = $book->orderDetails()->whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('status', 'verified');
        })->exists();

        if (! $hasAccess) {
            abort(403, 'Anda tidak memiliki akses untuk membaca buku ini.');
        }

        // Kalau ada file fisiknya, gunakan file fisik
        if ($book->file_buku && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->file_buku)) {
            $path = \Illuminate\Support\Facades\Storage::disk('public')->path($book->file_buku);

            return response()->file($path, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.\Illuminate\Support\Str::slug($book->judul).'.pdf"',
            ]);
        }

        // Dummy PDF on the fly
        $pdfContent = "%PDF-1.4\n%...\n1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n3 0 obj\n<< /Type /Page /Parent 2 0 R /Resources << /Font << /F1 4 0 R >> >> /MediaBox [0 0 612 792] /Contents 5 0 R >>\nendobj\n4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n5 0 obj\n<< /Length 53 >>\nstream\nBT\n/F1 24 Tf\n100 700 Td\n(".strtoupper($book->judul).")\nTj\nET\nendstream\nendobj\nxref\n0 6\n0000000000 65535 f \n0000000015 00000 n \n0000000064 00000 n \n0000000122 00000 n \n0000000234 00000 n \n0000000322 00000 n \ntrailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n426\n%%EOF";

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.\Illuminate\Support\Str::slug($book->judul).'.pdf"',
        ]);
    }
}
