<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function markAsRead(Reminder $reminder)
    {
        // Pastikan keamanan: hanya pemilik reminder yang bisa menandainya
        if ($reminder->user_id !== auth()->id()) {
            abort(403);
        }

        // Ubah status menjadi sudah dibaca (true)
        $reminder->update(['is_read' => true]);

        return back()->with('success', 'Notifikasi berhasil ditandai sudah dibaca.');
    }
}
