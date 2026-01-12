@props(['multiple'])
<div x-data="imageInput({
    multiple: true,
    onChangeGetFiles: files => console.log(files), // Callback for file change
    onImageRemove: url => console.log('Removed:', url), // Callback for file removal
})" class="input block border overflow-hidden" @dragover.prevent="dragging = true"
    @dragleave.prevent="dragging = false" @drop.prevent="handleDrop($event)">
    <label>
        <input type="file" x-ref="fileInput" @change="handleChange($event)" class="hidden" multiple />
        <div class="text-xs p-3 cursor-pointer">
            Drag or Drop your files or
            <span class="text-[--primary]" @click="$refs.fileInput.click()"> Browse</span>
        </div>
    </label>

    <!-- File Previews -->
    <div>
        <template x-for="(file, index) in files" :key="file.url">
            <div class="relative bg-black">
                <!-- Remove Button -->
                <button class="absolute top-3 right-3 bg-black p-1 rounded-full text-white" @click="removeFile(index)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Image Preview -->
                <img :src="file.url" class="w-full mx-auto max-w-sm" />
            </div>
        </template>
    </div>
</div>

<script>
    function imageInput({
        multiple = false,
        onChangeGetFiles = () => {},
        onImageRemove = () => {}
    }) {
        return {
            files: [], // Array to store file objects with URLs
            dragging: false,

            handleChange(event) {
                const fileInput = event.target;
                const fileList = Array.from(fileInput.files || []);

                this.addFiles(fileList);
                fileInput.value = ""; // Clear input value after selection
            },

            handleDrop(event) {
                const fileList = Array.from(event.dataTransfer.files || []);
                this.addFiles(fileList);
                this.dragging = false; // Reset dragging state
            },

            addFiles(fileList) {
                const newFiles = fileList.map(file => ({
                    file,
                    url: URL.createObjectURL(file),
                }));

                this.files = multiple ? [...this.files, ...newFiles] : [newFiles[0]];
                onChangeGetFiles(this.files.map(f => f.file)); // Trigger callback with files
            },

            removeFile(index) {
                const file = this.files[index];
                this.files.splice(index, 1);

                onImageRemove(file.url); // Trigger removal callback
                URL.revokeObjectURL(file.url); // Revoke URL to free memory
            },
        };
    }
</script>
