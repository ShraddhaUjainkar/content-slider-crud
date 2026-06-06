<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

final class Upload
{
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
        'image/svg+xml' => 'svg',
    ];

    public static function image(array $file, ?string $currentFile = null): ?string
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return $currentFile;
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Upload failed. Please try again.');
        }

        if (($file['size'] ?? 0) > MAX_UPLOAD_SIZE) {
            throw new RuntimeException('Image must be smaller than 2MB.');
        }

        $tmpName = (string) $file['tmp_name'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($tmpName);

        if (!isset(self::ALLOWED_MIME_TYPES[$mimeType])) {
            throw new RuntimeException('Only JPG, PNG, WEBP, GIF, and SVG images are allowed.');
        }

        if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0755, true)) {
            throw new RuntimeException('Upload directory could not be created.');
        }

        $extension = self::ALLOWED_MIME_TYPES[$mimeType];
        $fileName = bin2hex(random_bytes(16)) . '.' . $extension;
        $destination = UPLOAD_DIR . $fileName;

        if (!move_uploaded_file($tmpName, $destination)) {
            throw new RuntimeException('Image could not be saved.');
        }

        if ($currentFile && str_starts_with($currentFile, UPLOAD_URL)) {
            $oldPath = __DIR__ . '/../' . $currentFile;
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        return UPLOAD_URL . $fileName;
    }
}

