<x-layouts.admin title="Admin - Edit FAQ">
    <div class="mx-auto max-w-3xl">
        <h1 class="text-2xl font-bold mb-6">Edit FAQ</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.faqs.update', $item) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    @if ($errors->any())
                        <div class="alert alert-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-control">
                        <label class="label"><span class="label-text">Question</span></label>
                        <input type="text" name="question" value="{{ old('question', $item->question) }}" required class="input input-bordered w-full" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Answer</span></label>
                        <textarea name="answer" rows="6" class="textarea textarea-bordered w-full">{{ old('answer', $item->answer) }}</textarea>
                    </div>
                    <div class="flex items-center gap-4">
                        <label class="label cursor-pointer">
                            <input type="hidden" name="active" value="0">
                            <input type="checkbox" name="active" value="1" class="checkbox checkbox-sm mr-2" @checked(old('active', $item->active)) />
                            <span class="label-text">Active</span>
                        </label>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Order</span></label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" class="input input-bordered w-24" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.admin>
