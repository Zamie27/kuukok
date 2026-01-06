<x-layouts.admin title="Admin - Create Portfolio">
    <div class="mx-auto max-w-5xl" x-data="portfolioForm()">
        <h1 class="text-2xl font-bold mb-6">Create Portfolio Item</h1>

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column: Basic Info -->
                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Title</span></label>
                                <input type="text" name="title" required class="input input-bordered w-full" value="{{ old('title') }}" />
                                @error('title') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Slug</span> <span class="label-text-alt">(Optional)</span></label>
                                <input type="text" name="slug" class="input input-bordered w-full" value="{{ old('slug') }}" />
                                @error('slug') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Client Name</span></label>
                                <div class="flex gap-2 items-center">
                                    <input type="text" name="client_name" id="client_name" class="input input-bordered w-full" value="{{ old('client_name') }}" placeholder="Company or Person Name" />
                                    <label class="cursor-pointer label border rounded px-2 hover:bg-base-200">
                                        <input type="checkbox" name="is_personal_project" value="1" id="personal_project" class="checkbox checkbox-sm checkbox-secondary" onchange="togglePersonalProject(this)" {{ old('is_personal_project') ? 'checked' : '' }} />
                                        <span class="label-text ml-2 whitespace-nowrap text-xs font-semibold">Personal Project</span>
                                    </label>
                                </div>
                                @error('client_name') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-4">
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Start Date</span></label>
                                    <div class="flex gap-2">
                                        <select name="start_month" class="select select-bordered w-1/2">
                                            <option value="">Month</option>
                                            @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ old('start_month') == $m ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                                            @endforeach
                                        </select>
                                        <select name="start_year" class="select select-bordered w-1/2">
                                            <option value="">Year</option>
                                            @foreach(range(date('Y'), 2000) as $y)
                                            <option value="{{ $y }}" {{ old('start_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">End Date</span> <span class="label-text-alt">(Leave empty if Ongoing)</span></label>
                                    <div class="flex gap-2">
                                        <select name="end_month" class="select select-bordered w-1/2">
                                            <option value="">Month</option>
                                            @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ old('end_month') == $m ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                                            @endforeach
                                        </select>
                                        <select name="end_year" class="select select-bordered w-1/2">
                                            <option value="">Year</option>
                                            @foreach(range(date('Y') + 1, 2000) as $y)
                                            <option value="{{ $y }}" {{ old('end_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Project Status</span></label>
                                    <select name="project_status" class="select select-bordered w-full">
                                        <option value="Dalam Pengerjaan" {{ old('project_status') == 'Dalam Pengerjaan' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                                        <option value="Selesai" {{ old('project_status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Ditunda" {{ old('project_status') == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Total Team Size</span> <span class="label-text-alt text-info">(Auto-calculated)</span></label>
                                    <input type="number" name="team_size" class="input input-bordered w-full bg-base-200" :value="members.length > 0 ? members.length : 1" readonly tabindex="-1" />
                                    <p class="text-xs text-base-content/60 mt-1">Based on members added in Project Team section below.</p>
                                </div>
                            </div>

                            <div class="form-control" x-data="{
                                roles: ['Frontend Developer', 'Backend Developer', 'Full Stack Developer', 'UI/UX Designer', 'Project Manager', 'QA Engineer', 'DevOps Engineer', 'Mobile Developer'],
                                selectedRoles: {{ json_encode(old('project_roles', [])) }},
                                roleInput: '',
                                addRole(role) {
                                    if (role && !this.selectedRoles.includes(role)) {
                                        this.selectedRoles.push(role);
                                    }
                                    this.roleInput = '';
                                },
                                removeRole(role) {
                                    this.selectedRoles = this.selectedRoles.filter(r => r !== role);
                                }
                            }">
                                <label class="label"><span class="label-text">Project Roles Involved</span> <span class="label-text-alt">(Select or Type)</span></label>

                                <template x-for="role in selectedRoles" :key="role">
                                    <input type="hidden" name="project_roles[]" :value="role">
                                </template>

                                <div class="p-2 border rounded-lg bg-base-100 focus-within:ring-2 focus-within:ring-primary focus-within:border-primary">
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <template x-for="role in selectedRoles" :key="role">
                                            <div class="badge badge-secondary badge-lg gap-1 text-white">
                                                <span x-text="role"></span>
                                                <button type="button" @click="removeRole(role)" class="btn btn-xs btn-circle btn-ghost text-white h-4 w-4 min-h-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                        <input type="text" x-model="roleInput" placeholder="Type role & enter..." class="input input-ghost input-sm flex-1 min-w-[150px] focus:outline-none p-0 h-auto" @keydown.enter.prevent="addRole(roleInput.trim())" />
                                    </div>

                                    <div class="border-t pt-2 mt-2">
                                        <div class="text-xs text-base-content/60 mb-2">Suggested:</div>
                                        <div class="flex flex-wrap gap-1">
                                            <template x-for="role in roles" :key="role">
                                                <button type="button" @click="addRole(role)" class="badge badge-outline hover:bg-base-200 cursor-pointer transition-colors" :class="{'opacity-50 cursor-not-allowed': selectedRoles.includes(role)}">
                                                    <span x-text="role"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                @error('project_roles') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Right Column: Media & Status -->
                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Status (Publish)</span></label>
                                <select name="status" class="select select-bordered w-full">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Live Demo Link</span></label>
                                <input type="url" name="live_demo_link" class="input input-bordered w-full" value="{{ old('live_demo_link') }}" placeholder="https://" />
                                @error('live_demo_link') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Cover Image</span> <span class="label-text-alt">(Max 5MB, JPG/PNG/WEBP)</span></label>
                                <input type="file" name="cover_image" class="file-input file-input-bordered w-full" accept="image/jpeg,image/png,image/webp" />
                                @error('cover_image') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label"><span class="label-text">Gallery Media (Images/Videos)</span> <span class="label-text-alt">(Multiple, Max 50MB each)</span></label>
                                <input type="file" name="gallery[]" multiple class="file-input file-input-bordered w-full" accept="image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime" />
                                @error('gallery.*') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tags & Tech Stack -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control" x-data="{
                                tags: {{ json_encode(array_values($availableTags)) }},
                                selected: {{ json_encode(old('tags', [])) }},
                                query: '',
                                filteredTags() {
                                    if (this.query === '') return [];
                                    return this.tags.filter(t => t.toLowerCase().includes(this.query.toLowerCase()) && !this.selected.includes(t));
                                },
                                addTag(tag) {
                                    if (!this.selected.includes(tag)) {
                                        this.selected.push(tag);
                                    }
                                    this.query = '';
                                },
                                removeTag(tag) {
                                    this.selected = this.selected.filter(t => t !== tag);
                                }
                            }">
                            <label class="label"><span class="label-text">Tags</span> <span class="label-text-alt">(Search & Select)</span></label>

                            <!-- Hidden inputs for form submission -->
                            <template x-for="tag in selected" :key="tag">
                                <input type="hidden" name="tags[]" :value="tag">
                            </template>

                            <div class="p-2 border rounded-lg bg-base-100 focus-within:ring-2 focus-within:ring-primary focus-within:border-primary relative">
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="tag in selected" :key="tag">
                                        <div class="badge badge-primary badge-lg gap-1 text-white">
                                            <span x-text="tag"></span>
                                            <button type="button" @click="removeTag(tag)" class="btn btn-xs btn-circle btn-ghost text-white h-4 w-4 min-h-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <input type="text" x-model="query" placeholder="Type to search tags..." class="input input-ghost input-sm flex-1 min-w-[150px] focus:outline-none p-0 h-auto" @keydown.enter.prevent="if(filteredTags().length > 0) addTag(filteredTags()[0])" />
                                </div>

                                <!-- Dropdown results -->
                                <div x-show="query.length > 0" class="absolute left-0 right-0 top-full mt-1 border rounded-lg max-h-40 overflow-y-auto bg-base-100 shadow-xl z-50">
                                    <template x-for="tag in filteredTags()" :key="tag">
                                        <div @click="addTag(tag)" class="p-2 hover:bg-base-200 cursor-pointer transition-colors" x-text="tag"></div>
                                    </template>
                                    <div x-show="filteredTags().length === 0" class="p-2 text-sm opacity-50">No matching tags found</div>
                                </div>
                            </div>
                            <div class="label">
                                <span class="label-text-alt text-info">Type to search. Click to add.</span>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text">Tech Stacks</span></label>
                            <div class="flex flex-wrap gap-2 p-3 border rounded-lg bg-base-100 h-32 overflow-y-auto">
                                @foreach($techStacks as $stack)
                                <label class="cursor-pointer label justify-start gap-2">
                                    <input type="checkbox" name="tech_stacks[]" value="{{ $stack->id }}" class="checkbox checkbox-sm checkbox-secondary"
                                        {{ in_array($stack->id, old('tech_stacks', [])) ? 'checked' : '' }} />
                                    <div class="flex items-center gap-2">
                                        @if($stack->logo) <img src="{{ asset('storage/'.$stack->logo) }}" class="w-4 h-4 object-contain"> @endif
                                        <span class="label-text">{{ $stack->name }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Short Excerpt</span></label>
                        <textarea name="excerpt" rows="2" class="textarea textarea-bordered w-full" placeholder="Brief summary for cards...">{{ old('excerpt') }}</textarea>
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text">Description / Content</span></label>
                        <textarea name="description" rows="8" class="textarea textarea-bordered w-full font-mono">{{ old('description') }}</textarea>
                        @error('description') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Team Members Repeater -->
                    <div class="divider">Team Members</div>
                    <div class="bg-base-200 p-4 rounded-box">
                        <div class="mb-4 flex justify-between items-center">
                            <h3 class="font-bold">Project Team</h3>
                            <button type="button" @click="addMember" class="btn btn-sm btn-outline btn-primary">+ Add Member</button>
                        </div>

                        <div class="space-y-3">
                            <template x-for="(member, index) in members" :key="index">
                                <div class="flex gap-4 items-end bg-base-100 p-3 rounded-lg shadow-sm">
                                    <div class="form-control flex-1">
                                        <label class="label label-text-alt" x-show="index === 0">Profile</label>
                                        <select :name="`team_members[${index}][profile_id]`" x-model="member.profile_id" class="select select-bordered select-sm w-full" required>
                                            <option value="">Select Member</option>
                                            @foreach($profiles as $profile)
                                            <option value="{{ $profile->id }}">{{ $profile->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-control flex-1">
                                        <label class="label label-text-alt" x-show="index === 0">Role in Project</label>
                                        <input type="text" :name="`team_members[${index}][role]`" x-model="member.role" class="input input-bordered input-sm w-full" placeholder="e.g. Lead Developer" required />
                                    </div>
                                    <button type="button" @click="removeMember(index)" class="btn btn-square btn-sm btn-error text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                            <div x-show="members.length === 0" class="text-center text-sm opacity-50 py-4">
                                No team members added yet.
                            </div>
                        </div>
                    </div>



                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.portfolios.index') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" name="action" value="preview" class="btn btn-outline btn-secondary">Save & Preview</button>
                        <button type="submit" class="btn btn-primary text-white">Save Portfolio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePersonalProject(cb) {
            const input = document.getElementById('client_name');
            if (cb.checked) {
                input.dataset.oldValue = input.value;
                input.value = 'Personal Project';
                input.readOnly = true;
            } else {
                input.value = input.dataset.oldValue || '';
                input.readOnly = false;
            }
        }

        function portfolioForm() {
            return {
                members: [],
                addMember() {
                    this.members.push({
                        profile_id: '',
                        role: ''
                    });
                },
                removeMember(index) {
                    this.members.splice(index, 1);
                },
                // Basic Autosave
                init() {
                    const key = 'portfolio_create_autosave';

                    // Attempt to restore
                    const saved = localStorage.getItem(key);
                    if (saved) {
                        try {
                            const data = JSON.parse(saved);
                            const fields = ['title', 'slug', 'client_name', 'description', 'excerpt', 'team_size', 'live_demo_link', 'project_status'];

                            fields.forEach(field => {
                                const el = document.querySelector(`[name="${field}"]`);
                                if (el && el.value === '' && data[field]) {
                                    el.value = data[field];
                                }
                            });

                            // Restore Personal Project Checkbox
                            if (data.is_personal_project) {
                                const cb = document.getElementById('personal_project');
                                if (cb && !cb.checked) {
                                    cb.checked = true;
                                    togglePersonalProject(cb);
                                }
                            }

                        } catch (e) {
                            console.error('Autosave restore failed', e);
                        }
                    }

                    // Auto-save every 5 seconds
                    setInterval(() => {
                        const data = {};
                        const fields = ['title', 'slug', 'client_name', 'description', 'excerpt', 'team_size', 'live_demo_link', 'project_status'];

                        fields.forEach(field => {
                            const el = document.querySelector(`[name="${field}"]`);
                            if (el) data[field] = el.value;
                        });

                        const cb = document.getElementById('personal_project');
                        if (cb) data.is_personal_project = cb.checked;

                        localStorage.setItem(key, JSON.stringify(data));

                        // Optional: Visual indicator could go here
                    }, 5000);

                    // Clear autosave on submit
                    this.$el.closest('form').addEventListener('submit', () => {
                        localStorage.removeItem(key);
                    });
                }
            }
        }
    </script>
</x-layouts.admin>
