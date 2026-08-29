<?php
/**
 * Secure File Upload Helper / Service
 * 
 * Centralized service to manage image uploads for Products and Gallery items.
 * Implements strict type checks, safe permissions, directory separation, and
 * prevents remote script execution.
 */
class UploadHelper {
    
    // Whitelisted extensions
    private static $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    
    // Whitelisted MIME types mapped to their valid extensions
    private static $allowedMimes = [
        'image/jpeg' => ['jpg', 'jpeg'],
        'image/png'  => ['png'],
        'image/webp' => ['webp']
    ];
    
    // Maximum file size (5MB)
    private static $maxSize = 5242880; // 5 * 1024 * 1024

    /**
     * Securely validates and processes an uploaded image.
     * 
     * @param array $file The $_FILES element (e.g. $_FILES['image'])
     * @param string $subfolder Subfolder inside public/uploads (e.g. 'products' or 'gallery')
     * @param string $prefix Prefix for the unique filename (e.g. 'stone' or 'gal')
     * @return string|null Generated filename on success, null on failure/validation error
     */
    public static function upload($file, $subfolder, $prefix = 'upload') {
        // 1. Verify file upload array integrity and error status
        if (!isset($file['error']) || is_array($file['error'])) {
            $_SESSION['flash_error'] = "Invalid upload parameters.";
            return null;
        }

        // 2. Evaluate PHP file upload errors
        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                // No file was selected, return null (caller handles optional fields)
                return null;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['flash_error'] = "The uploaded file exceeds the maximum allowed file size.";
                return null;
            case UPLOAD_ERR_PARTIAL:
                $_SESSION['flash_error'] = "The file was only partially uploaded. Please try again.";
                return null;
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION['flash_error'] = "Missing temporary upload directory on server.";
                return null;
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION['flash_error'] = "Failed to write file to server disk.";
                return null;
            default:
                $_SESSION['flash_error'] = "File upload failed with error code: " . $file['error'];
                return null;
        }

        // 3. Validate file size (must be > 0 and <= 5MB)
        if ($file['size'] > self::$maxSize || $file['size'] === 0) {
            $_SESSION['flash_error'] = "Uploaded file size exceeds maximum limit of 5MB.";
            return null;
        }

        // 4. Verify that the file was indeed uploaded via HTTP POST
        $tempPath = $file['tmp_name'];
        if (!is_uploaded_file($tempPath)) {
            $_SESSION['flash_error'] = "Invalid HTTP POST upload request.";
            return null;
        }

        // 5. Retrieve and validate original file extension
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::$allowedExtensions)) {
            $_SESSION['flash_error'] = "Invalid file extension. Only JPG, JPEG, PNG, and WEBP files are allowed.";
            return null;
        }

        // 6. Securely extract MIME type via binary content signatures (finfo)
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $tempPath);
        finfo_close($finfo);

        if (!array_key_exists($mime, self::$allowedMimes)) {
            $_SESSION['flash_error'] = "Invalid file type. The uploaded file is not a valid image.";
            return null;
        }

        // 7. Enforce extension cross-checking to prevent MIME spoofing (e.g. php file renamed as jpg)
        if (!in_array($ext, self::$allowedMimes[$mime])) {
            $_SESSION['flash_error'] = "MIME type and file extension mismatch. Spoofing detected.";
            return null;
        }

        // 8. Establish target subfolder directory path
        $targetDir = APPROOT . '/public/uploads/' . trim($subfolder, '/') . '/';
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                $_SESSION['flash_error'] = "Failed to create destination upload directory.";
                return null;
            }
        }

        // 9. Generate unique filename to mitigate collisions and folder traversal
        $filename = $prefix . '_' . time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
        $targetPath = $targetDir . $filename;

        // 10. Relocate temp file to target directory
        if (move_uploaded_file($tempPath, $targetPath)) {
            // Set file permissions to non-executable (0644: Owner write, everyone read)
            chmod($targetPath, 0644);
            return $filename;
        }

        $_SESSION['flash_error'] = "Failed to store the uploaded file securely.";
        return null;
    }

    /**
     * Securely deletes an uploaded file from disk.
     * 
     * @param string $filename The image filename to delete
     * @param string $subfolder Subfolder inside public/uploads
     * @return bool True on success, false if file does not exist or deletion fails
     */
    public static function delete($filename, $subfolder) {
        if (empty($filename)) {
            return false;
        }
        
        // Sanitize to prevent directory traversal attack (e.g. filename = ../../index.php)
        $cleanFilename = basename($filename);
        $filePath = APPROOT . '/public/uploads/' . trim($subfolder, '/') . '/' . $cleanFilename;
        
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
}
