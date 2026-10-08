/**
 * Image picker that shrinks a photo in the browser before Livewire uploads it.
 *
 * A phone photo is routinely 3-6 MB, while cPanel's stock PHP limit is
 * upload_max_filesize = 2M — the upload would simply fail on the live server.
 * Scaling to ~800px on the long edge brings a product photo down to roughly
 * 50-200 KB, which is also what keeps the POS grid and the offline till's
 * image cache light.
 */

const ACCEPTED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

async function loadBitmap(file) {
    if ('createImageBitmap' in window) {
        // 'from-image' applies the EXIF rotation, so portrait phone shots
        // don't come out lying on their side.
        return createImageBitmap(file, { imageOrientation: 'from-image' });
    }

    const url = URL.createObjectURL(file);

    try {
        const image = new Image();
        image.src = url;
        await image.decode();

        return image;
    } finally {
        URL.revokeObjectURL(url);
    }
}

function canvasToBlob(canvas, type, quality) {
    return new Promise((resolve) => canvas.toBlob(resolve, type, quality));
}

/**
 * Returns a File no larger than maxDimension on its long edge. Prefers WebP,
 * falling back to JPEG on browsers whose canvas can't encode WebP (older
 * Safari silently hands back a PNG instead, which would be larger, not
 * smaller). An image that is already small enough is returned untouched.
 */
export async function resizeImage(file, maxDimension = 800) {
    const bitmap = await loadBitmap(file);
    const width = bitmap.width;
    const height = bitmap.height;
    const scale = Math.min(1, maxDimension / Math.max(width, height));

    if (scale === 1 && file.size <= 300 * 1024) {
        return file;
    }

    const canvas = document.createElement('canvas');
    canvas.width = Math.round(width * scale);
    canvas.height = Math.round(height * scale);

    const context = canvas.getContext('2d');
    // White backdrop: a transparent PNG flattened to JPEG would otherwise
    // turn its transparent areas black.
    context.fillStyle = '#ffffff';
    context.fillRect(0, 0, canvas.width, canvas.height);
    context.drawImage(bitmap, 0, 0, canvas.width, canvas.height);
    bitmap.close?.();

    let blob = await canvasToBlob(canvas, 'image/webp', 0.85);
    let extension = 'webp';

    if (!blob || blob.type !== 'image/webp') {
        blob = await canvasToBlob(canvas, 'image/jpeg', 0.85);
        extension = 'jpg';
    }

    if (!blob || blob.size >= file.size) {
        return file;
    }

    const baseName = file.name.replace(/\.[^.]+$/, '') || 'image';

    return new File([blob], `${baseName}.${extension}`, { type: blob.type });
}

document.addEventListener('alpine:init', () => {
    Alpine.data('imageUpload', (config) => ({
        localPreview: null,
        uploading: false,
        progress: 0,
        error: '',

        async pick(event) {
            const file = event.target.files?.[0];
            // Cleared so picking the same file again still fires change.
            event.target.value = '';

            if (!file) {
                return;
            }

            this.error = '';

            if (!ACCEPTED_TYPES.includes(file.type)) {
                this.error = config.invalidTypeMessage;

                return;
            }

            let upload = file;

            try {
                upload = await resizeImage(file, config.maxDimension ?? 800);
            } catch {
                // Couldn't decode it here — let the server's own validation
                // have the final say rather than refusing outright.
                upload = file;
            }

            this.clearPreview();
            this.localPreview = URL.createObjectURL(upload);
            this.uploading = true;
            this.progress = 0;

            this.$wire.upload(
                config.model,
                upload,
                () => {
                    this.uploading = false;
                },
                () => {
                    this.uploading = false;
                    this.clearPreview();
                    this.error = config.failedMessage;
                },
                (progressEvent) => {
                    this.progress = progressEvent.detail.progress;
                },
            );
        },

        remove() {
            this.clearPreview();
            this.error = '';
            this.$wire.call(config.removeMethod);
        },

        clearPreview() {
            if (this.localPreview) {
                URL.revokeObjectURL(this.localPreview);
            }

            this.localPreview = null;
        },
    }));
});
