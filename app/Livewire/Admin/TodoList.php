<?php

namespace App\Livewire\Admin;

use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{
    public $newTask = '';

    public function addTask()
    {
        $this->validate(['newTask' => 'required|string|max:255']);
        
        Todo::create([
            'task' => $this->newTask,
            'is_completed' => false,
        ]);

        $this->newTask = '';
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->update(['is_completed' => !$todo->is_completed]);
        }
    }

    public function delete($id)
    {
        Todo::destroy($id);
    }

    public function render()
    {
        return view('livewire.admin.todo-list', [
            'todos' => Todo::latest()->get()
        ]);
    }
}
