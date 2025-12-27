<div class="card bg-base-100 shadow-xl h-full">
    <div class="card-body p-4">
        <h2 class="card-title text-lg mb-4 flex justify-between items-center">
            Shared Todo List
            <span class="badge badge-primary badge-lg text-xs font-semibold whitespace-nowrap">{{ $todos->where('is_completed', false)->count() }} Pending</span>
        </h2>

        <form wire:submit.prevent="addTask" class="flex gap-2 mb-4">
            <input type="text" wire:model="newTask" placeholder="Add new task..." class="input input-bordered input-sm w-full" />
            <button type="submit" class="btn btn-sm btn-primary text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </form>

        <div class="overflow-y-auto h-80 space-y-2">
            @forelse($todos as $todo)
            <div class="flex items-center justify-between group p-2 hover:bg-base-200 rounded-lg transition-colors">
                <div class="flex items-center gap-3">
                    <input type="checkbox" wire:click="toggle({{ $todo->id }})" @checked($todo->is_completed) class="checkbox checkbox-sm checkbox-primary" />
                    <span class="{{ $todo->is_completed ? 'line-through text-base-content/50' : '' }}">{{ $todo->task }}</span>
                </div>
                <button wire:click="delete({{ $todo->id }})" class="btn btn-ghost btn-xs text-error opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
            @empty
            <div class="text-center py-4 text-base-content/50 text-sm">No tasks yet.</div>
            @endforelse
        </div>
    </div>
</div>
