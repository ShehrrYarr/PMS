document.addEventListener('alpine:init', () => {
    Alpine.data('cameraCapture', () => ({
        stream: null,
        cameraOpen: false,
        photoDataUrl: null,
        error: null,

        async openCamera() {
            this.error = null;

            if (! navigator.mediaDevices?.getUserMedia) {
                this.error = this.$el.dataset.unsupportedMessage;

                return;
            }

            try {
                this.stream = await navigator.mediaDevices.getUserMedia({ video: true });
            } catch (e) {
                this.error = this.$el.dataset.deniedMessage;

                return;
            }

            this.cameraOpen = true;

            this.$nextTick(() => {
                this.$refs.video.srcObject = this.stream;
            });
        },

        closeCamera() {
            this.stream?.getTracks().forEach((track) => track.stop());
            this.stream = null;
            this.cameraOpen = false;
        },

        takeSnapshot() {
            const video = this.$refs.video;
            const canvas = this.$refs.canvas;
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            canvas.toBlob((blob) => {
                if (! blob) {
                    return;
                }

                this.photoDataUrl = URL.createObjectURL(blob);

                const file = new File([blob], 'customer-photo.jpg', { type: 'image/jpeg' });
                this.$wire.upload('capturedPhoto', file);
            }, 'image/jpeg', 0.85);

            this.closeCamera();
        },

        retake() {
            this.photoDataUrl = null;
            this.$wire.set('capturedPhoto', null);
            this.openCamera();
        },

        removePhoto() {
            this.photoDataUrl = null;
            this.$wire.removePhoto();
        },
    }));
});
