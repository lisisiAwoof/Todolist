<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todolist;
use Illuminate\Support\Facades\Auth;

class TodolistController extends Controller
{
    // Note to self:
    // Menampilkan daftar tugas ke user
    public function index()
    {
        // Fetch tugas milik user berdasarkan user_id 
        // kemudian semua tugas diurutkan secara ascending
        $tasks = Todolist::where('user_id', Auth::id())->orderBy('task_status', 'asc')->get();
        return view('dashboard', compact('tasks'));
    }

    // Tambah
    public function store(Request $request)
    {
        // Memvalidasi input teks, minimal harus diisi
        $request->validate([
            'task_text' => 'required|string|max:255',
        ]);
        // Kalo udah, teksnya nanti dimasukkan ke database dengan status 0 (tandanya blm dikerjakan)
        // dan juga user_id, siapa yg buat tugas itu
        Todolist::create([
            'task_text' => $request->task_text,
            'task_status' => 0, 
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Task added successfully');
    }

    // Update status
    public function updateStatus($task_id)
    {
        // Cari task berdasarkan task_id-nya, kemudian jika ada nanti statusnya diganti
        // menandakan tugas sudah dikerjakan
        $task = Todolist::findOrFail($task_id);

        $task->task_status = !$task->task_status;
        $task->save();

        return redirect()->back()->with('success', 'Task status updated');
    }

    // Hapus
    public function destroy($task_id)
    {
        // Cari task berdasarkan task_id-nya      
        $task = Todolist::findOrFail($task_id);
        // Kalo ketemu, task tersebut dihapus
        // Hanya jika task tersebut milik user yg sekarang sedang mengakses webnya
        if ($task->user_id == Auth::id()) {
            $task->delete();
            return redirect()->back()->with('success', 'Task deleted successfully');
        }

        return redirect()->back()->with('error', 'Unauthorized action');
    }
}
