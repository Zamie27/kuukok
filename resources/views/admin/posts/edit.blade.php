<x-layouts.admin title="Admin - Edit Post">
    <div class="mx-auto max-w-4xl">
        <h1 class="text-2xl font-bold mb-6">Edit Post</h1>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6" x-data="blockEditor()">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Inputs for Block Editor -->
                    <input type="hidden" name="content" :value="htmlContent">
                    <input type="hidden" name="content_blocks" :value="jsonBlocks">

                    <!-- Title & Slug -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Title</span></label>
                            <input type="text" name="title" value="{{ $post->title }}" required class="input input-bordered w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Slug</span></label>
                            <input type="text" name="slug" value="{{ $post->slug }}" class="input input-bordered w-full" />
                        </div>
                    </div>

                    <!-- Category & Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text">Category</span></label>
                            <input type="text" name="category" value="{{ $post->category }}" class="input input-bordered w-full" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text">Status</span></label>
                            <select name="status" class="select select-bordered w-full">
                                <option value="draft" @selected($post->status==='draft')>Draft</option>
                                <option value="published" @selected($post->status==='published')>Published</option>
                            </select>
                        </div>
                    </div>

                    <!-- Block Editor Area -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold">Content Editor</span>
                            <span class="label-text-alt text-xs">Drag & Drop supported via Up/Down</span>
                        </label>

                        <div class="border rounded-box bg-base-200/30 p-4 space-y-4 min-h-[300px]">
                            <template x-for="(block, index) in blocks" :key="block.id">
                                <div class="card bg-base-100 shadow-sm border border-base-200 group relative transition-all duration-200 hover:shadow-md">
                                    <div class="card-body p-4">
                                        <!-- Block Header / Controls -->
                                        <div class="flex justify-between items-center mb-2">
                                            <div class="badge badge-sm badge-ghost uppercase font-bold text-xs" x-text="block.type"></div>
                                            <div class="flex gap-1 opacity-50 group-hover:opacity-100 transition-opacity">
                                                <button type="button" @click="moveUp(index)" class="btn btn-xs btn-square btn-ghost" :disabled="index === 0" title="Move Up">↑</button>
                                                <button type="button" @click="moveDown(index)" class="btn btn-xs btn-square btn-ghost" :disabled="index === blocks.length - 1" title="Move Down">↓</button>
                                                <button type="button" @click="removeBlock(index)" class="btn btn-xs btn-square btn-error btn-outline text-error hover:text-white" title="Remove Block">×</button>
                                            </div>
                                        </div>

                                        <!-- HEADING Block -->
                                        <template x-if="block.type === 'heading'">
                                            <div class="flex gap-2">
                                                <select x-model="block.data.level" class="select select-bordered select-sm w-24">
                                                    <option value="h2">H2</option>
                                                    <option value="h3">H3</option>
                                                </select>
                                                <input type="text" x-model="block.data.text" class="input input-bordered input-sm w-full font-bold" placeholder="Heading Text" />
                                            </div>
                                        </template>

                                        <!-- PARAGRAPH Block -->
                                        <template x-if="block.type === 'paragraph'">
                                            <textarea x-model="block.data.text" class="textarea textarea-bordered w-full leading-relaxed" rows="3" placeholder="Write your paragraph here..."></textarea>
                                        </template>

                                        <!-- QUOTE Block -->
                                        <template x-if="block.type === 'quote'">
                                            <div class="space-y-2">
                                                <textarea x-model="block.data.text" class="textarea textarea-bordered w-full italic" rows="2" placeholder="Quote text..."></textarea>
                                                <input type="text" x-model="block.data.cite" class="input input-bordered input-sm w-full" placeholder="Citation / Source (Optional)" />
                                            </div>
                                        </template>

                                        <!-- CODE Block -->
                                        <template x-if="block.type === 'code'">
                                            <div class="space-y-2">
                                                <div class="flex justify-end">
                                                    <select x-model="block.data.language" class="select select-bordered select-xs">
                                                        <option value="php">PHP</option>
                                                        <option value="javascript">JavaScript</option>
                                                        <option value="html">HTML</option>
                                                        <option value="css">CSS</option>
                                                        <option value="bash">Bash</option>
                                                        <option value="sql">SQL</option>
                                                    </select>
                                                </div>
                                                <textarea x-model="block.data.code" class="textarea textarea-bordered w-full font-mono text-sm bg-base-300" rows="4" placeholder="// Write code here..."></textarea>
                                            </div>
                                        </template>

                                        <!-- IMAGE Block -->
                                        <template x-if="block.type === 'image'">
                                            <div class="space-y-2">
                                                <div class="flex items-center gap-4">
                                                    <div class="flex-1">
                                                        <template x-if="!block.data.url">
                                                            <input type="file" @change="uploadImage($event, block)" class="file-input file-input-bordered file-input-sm w-full" accept="image/*" />
                                                        </template>
                                                        <template x-if="block.data.url">
                                                            <div class="relative group/img inline-block">
                                                                <img :src="block.data.url" class="h-32 rounded border bg-base-200 object-cover" />
                                                                <button type="button" @click="block.data.url = ''" class="btn btn-xs btn-circle btn-error absolute -top-2 -right-2">×</button>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                                <input type="text" x-model="block.data.caption" class="input input-bordered input-sm w-full" placeholder="Image Caption (Optional)" />
                                            </div>
                                        </template>

                                        <!-- ALERT Block -->
                                        <template x-if="block.type === 'alert'">
                                            <div class="alert p-3 shadow-none border border-base-300 bg-base-100">
                                                <div class="w-full space-y-2">
                                                    <select x-model="block.data.type"
                                                            :class="{
                                                                'select-info text-info border-info': block.data.type === 'info',
                                                                'select-success text-success border-success': block.data.type === 'success',
                                                                'select-warning text-warning border-warning': block.data.type === 'warning',
                                                                'select-error text-error border-error': block.data.type === 'error'
                                                            }"
                                                            class="select select-bordered select-xs w-full max-w-xs font-bold">
                                                        <option value="info" class="text-info">Info</option>
                                                        <option value="success" class="text-success">Success</option>
                                                        <option value="warning" class="text-warning">Warning</option>
                                                        <option value="error" class="text-error">Error</option>
                                                    </select>
                                                    <textarea x-model="block.data.text" class="textarea textarea-bordered w-full" rows="2" placeholder="Alert message..."></textarea>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>
                            </template>

                            <!-- Add Block Toolbar -->
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 pt-4">
                                <button type="button" @click="addBlock('paragraph')" class="btn btn-sm btn-outline btn-ghost hover:bg-base-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 5H5" />
                                        <path d="M19 12H5" />
                                        <path d="M19 19H5" />
                                    </svg>
                                    Paragraph
                                </button>
                                <button type="button" @click="addBlock('heading')" class="btn btn-sm btn-outline btn-ghost hover:bg-base-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 12h12" />
                                        <path d="M6 20V4" />
                                        <path d="M18 20V4" />
                                    </svg>
                                    Heading
                                </button>
                                <button type="button" @click="addBlock('quote')" class="btn btn-sm btn-outline btn-ghost hover:bg-base-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
                                        <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
                                    </svg>
                                    Quote
                                </button>
                                <button type="button" @click="addBlock('code')" class="btn btn-sm btn-outline btn-ghost hover:bg-base-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="16 18 22 12 16 6" />
                                        <polyline points="8 6 2 12 8 18" />
                                    </svg>
                                    Code
                                </button>
                                <button type="button" @click="addBlock('image')" class="btn btn-sm btn-outline btn-ghost hover:bg-base-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    Image
                                </button>
                                <button type="button" @click="addBlock('alert')" class="btn btn-sm btn-outline btn-ghost hover:bg-base-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>
                                    Alert
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Metadata -->
                    <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
                        <input type="checkbox" />
                        <div class="collapse-title text-xl font-medium">
                            SEO & Metadata
                        </div>
                        <div class="collapse-content space-y-4 pt-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Cover Image</span></label>
                                <input type="file" name="cover_image" class="file-input file-input-bordered w-full" accept="image/*" />
                                @if($post->cover_image)
                                <div class="mt-2 text-sm">Current: <a href="{{ asset('storage/'.$post->cover_image) }}" class="link link-hover">view</a></div>
                                @endif
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Meta Title</span></label>
                                    <input type="text" name="meta_title" value="{{ $post->meta_title }}" class="input input-bordered w-full" placeholder="Optional SEO Title" />
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Keywords</span></label>
                                    <input type="text" name="keywords" value="{{ $post->keywords }}" class="input input-bordered w-full" placeholder="comma, separated, tags" />
                                </div>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Meta Description</span></label>
                                <textarea name="meta_description" class="textarea textarea-bordered h-24" placeholder="SEO Description">{{ $post->meta_description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-6">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-primary text-white px-8">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function blockEditor() {
            return {
                blocks: @if($post->content_blocks) @json($post->content_blocks) @else [{
                    id: Date.now(),
                    type: 'paragraph',
                    data: {
                        text: @json($post->content ?? '')
                    }
                }] @endif,
                get jsonBlocks() {
                    return JSON.stringify(this.blocks);
                },
                get htmlContent() {
                    return this.blocks.map(block => {
                        if (block.type === 'paragraph') return `<p>${this.escapeHtml(block.data.text)}</p>`;
                        if (block.type === 'heading') return `<${block.data.level}>${this.escapeHtml(block.data.text)}</${block.data.level}>`;
                        if (block.type === 'quote') return `<blockquote>${this.escapeHtml(block.data.text)}<cite>${this.escapeHtml(block.data.cite)}</cite></blockquote>`;
                        if (block.type === 'code') return `<pre><code class="language-${block.data.language}">${this.escapeHtml(block.data.code)}</code></pre>`;
                        if (block.type === 'image') return `<figure><img src="${block.data.url}" alt="${this.escapeHtml(block.data.caption)}"><figcaption>${this.escapeHtml(block.data.caption)}</figcaption></figure>`;
                        if (block.type === 'alert') return `<div class="alert alert-${block.data.type}">${this.escapeHtml(block.data.text)}</div>`;
                        return '';
                    }).join('');
                },
                escapeHtml(text) {
                    if (!text) return '';
                    return text
                        .replace(/&/g, "&amp;")
                        .replace(/</g, "&lt;")
                        .replace(/>/g, "&gt;")
                        .replace(/"/g, "&quot;")
                        .replace(/'/g, "&#039;");
                },
                addBlock(type) {
                    let data = {};
                    if (type === 'heading') data = {
                        level: 'h2',
                        text: ''
                    };
                    if (type === 'paragraph') data = {
                        text: ''
                    };
                    if (type === 'quote') data = {
                        text: '',
                        cite: ''
                    };
                    if (type === 'code') data = {
                        code: '',
                        language: 'php'
                    };
                    if (type === 'image') data = {
                        url: '',
                        caption: ''
                    };
                    if (type === 'alert') data = {
                        type: 'info',
                        text: ''
                    };

                    this.blocks.push({
                        id: Date.now(),
                        type: type,
                        data: data
                    });

                    // Auto scroll to bottom
                    this.$nextTick(() => {
                        window.scrollTo({
                            top: document.body.scrollHeight,
                            behavior: 'smooth'
                        });
                    });
                },
                removeBlock(index) {
                    if (confirm('Are you sure you want to remove this block?')) {
                        this.blocks.splice(index, 1);
                    }
                },
                moveUp(index) {
                    if (index > 0) {
                        const block = this.blocks[index];
                        this.blocks.splice(index, 1);
                        this.blocks.splice(index - 1, 0, block);
                    }
                },
                moveDown(index) {
                    if (index < this.blocks.length - 1) {
                        const block = this.blocks[index];
                        this.blocks.splice(index, 1);
                        this.blocks.splice(index + 1, 0, block);
                    }
                },
                async uploadImage(event, block) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('image', file);

                    const originalText = event.target.nextElementSibling?.innerText;

                    try {
                        const response = await fetch('{{ route('admin.posts.upload-image') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    'Accept': 'application/json'
                                }
                            });

                        if (!response.ok) throw new Error('Upload failed');

                        const data = await response.json();
                        if (data.url) {
                            block.data.url = data.url;
                        }
                    } catch (e) {
                        console.error('Upload failed', e);
                        alert('Upload failed: ' + e.message);
                    }
                }
            }
        }
    </script>
</x-layouts.admin>
