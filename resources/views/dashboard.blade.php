<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('To-Do List') }}
        </h2>
    </x-slot>

    <div class="py-10">
        {{-- card warna abu-abu as the background --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg"
            style="max-width: 700px; display: flex; justify-content: center; margin:auto; max-height: fit-content;">

            {{-- div untuk form tambah tugas --}}
            <div class="text-gray-900 dark:text-gray-100" style="width: 80%;">
                <form action="{{ route('tasks.store') }}" method="post">
                    @csrf
                    <p class="text-center" style="font-size:20px; font-weight: bolder; margin-top: 10px">Tasks For Today!
                    </p>
                    <input type="text" id="addtask" name="task_text" placeholder="Things to do..." required
                        class="form-control bg-light rounded-pill ps-3 mb-3" style="width: 85%; border-radius: 5px; color:rgb(79, 79, 79);">
                    <button type="submit" id="addtask-btn" class="btn text-white mt-4 mb-4 ms-2"
                        style="background-color:rgb(61, 84, 255); border-radius: 5px; padding:8.5px 20px;" onmouseover="this.style.backgroundColor='#2418ac';" onmouseout="this.style.backgroundColor='rgb(61, 84, 255)';">
                        Add
                    </button>
                </form>
                <br>
                {{-- div untuk daftar tugas --}}
                <div class="overflow-auto" style="max-height: 330px">
                    <ul class="list">
                        @foreach ($tasks as $task)
                            <li class="d-flex align-items-center justify-content-between mb-2"
                                style="background-color: white; padding-left: 13px; border-radius: 3px; max-width: 555px; color:rgb(79, 79, 79); margin-bottom:15px">

                                {{-- Text tugas--}}
                                <div class="flex items-center justify-between">
                                    <p id="item"
                                        style="padding: 8px; text-decoration: {{ $task->task_status ? 'line-through' : 'none' }}">
                                        {{ $task->task_text }}
                                    </p>
                                    {{-- Finish Delete buttons --}}
                                    <div style="padding-right: 10px">
                                        <form action="{{ route('tasks.updateStatus', $task->task_id) }}" method="post"
                                            style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn text-white me-2"
                                                style="background-color: rgb(37, 165, 88); border-radius: 2px; padding:1px 10px;" onmouseover="this.style.backgroundColor='#018428';" onmouseout="this.style.backgroundColor='rgb(37, 165, 88)';">
                                                {{ $task->task_status ? 'Undo' : 'Finish' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('tasks.destroy', $task->task_id) }}" method="post"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-white"
                                                style="background-color: rgb(188, 36, 36); border-radius: 2px; padding:1px 10px;" onmouseover="this.style.backgroundColor='#900000';" onmouseout="this.style.backgroundColor='rgb(188, 36, 36)';">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
