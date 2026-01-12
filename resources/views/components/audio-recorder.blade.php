<div x-data="{
    mediaRecorder: null,
    audioChunks: [],
    isRecording: false,
    audioFile: null, // Holds the generated File object

    startRecording() {
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                this.mediaRecorder = new MediaRecorder(stream);
                this.isRecording = true;
                this.audioChunks = [];
                this.mediaRecorder.start();

                this.mediaRecorder.addEventListener('dataavailable', event => {
                    this.audioChunks.push(event.data);
                });

                this.mediaRecorder.addEventListener('stop', () => {
                    const audioBlob = new Blob(this.audioChunks, { type: 'audio/webm' });
                    const audioUrl = URL.createObjectURL(audioBlob);

                    // Set the audio playback source
                    this.$refs.audioPlayback.src = audioUrl;

                    // Create a File object for form submission
                    this.audioFile = new File([audioBlob], 'voice-recording.webm', { type: 'audio/webm' });
                    this.$refs.fileInput.files = this.createFileList(this.audioFile);
                    this.$refs.fileInput.dispatchEvent(new Event('change'));

                    // Show the download link
                    const downloadLink = this.$refs.downloadLink;
                    downloadLink.href = audioUrl;
                    downloadLink.style.visibility = 'visible';
                });
            })
            .catch(error => {
                console.error('Error accessing microphone:', error);
                alert('Microphone access is required to record audio.');
            });
    },

    stopRecording() {
        if (this.mediaRecorder) {
            this.mediaRecorder.stop();
            this.isRecording = false;
        }
    },

    resetRecording() {
        // Reset all recording-related states
        this.audioChunks = [];
        this.audioFile = null;
        this.$refs.fileInput.dispatchEvent(new Event('change'));
        this.$refs.audioPlayback.src = '';
        this.$refs.fileInput.value = '';
    },

    createFileList(file) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        return dataTransfer.files;
    }
}" class="flex items-center  gap-1 p-3 pb-0">

    <div class="w-fit flex items-center gap-1">
        <!-- Start Recording Button -->
        <x-icon name='o-microphone' x-on:click="startRecording" x-show="!isRecording" />

        <!-- Stop Recording Button -->
        <x-icon name='o-stop-circle' x-on:click="stopRecording" x-show="isRecording" />

        <!-- Trash/Reset Button -->
        <x-icon name='o-trash' x-on:click="resetRecording" x-show="!isRecording && audioChunks.length" />
    </div>

    <div class="w-full">
        <!-- Audio Playback -->
        <audio x-ref="audioPlayback" controls x-show="!isRecording && audioChunks.length" class="w-full"></audio>

        <!-- Hidden File Input -->
        <input x-ref="fileInput" type="file" name="audio" style="display: none;" {{ $attributes }}>

        <!-- Loading Animation -->
        <x-loading class="loading-bars" x-show="isRecording" />
    </div>

</div>
