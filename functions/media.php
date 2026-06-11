<?php 
function upload_media($file){
    $allowed = ['jpg','png','jpeg','gif','webp'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed)) return false;
    if($file['size'] > 5 * 1024 * 1024) return false;

    $filename = uniqid(). '_' . basename($file['name']);
    $upload_path = UPLOADS_PATH . '/media/';

    if(!is_dir($upload_path)) mkdir($upload_path, 0777, true);

    if(move_uploaded_file($file['tmp_name'], $upload_path . $filename)){
        return db_insert('media',[
            'filename' => $filename,
            'original_name' => $file['name'],
            'path' => 'uploads/media/' . $filename,
            'type' => $ext,
            'uploaded_by' => $_SESSION['user_id'],
            'size' => $file['size']
        ]);
    }
    return false;
}
function delete_media($id){
    $file = db_selectOne('media', ['id'=>$id]);
    if($file){
        $file_path = UPLOADS_PATH . '/media/' . $file['filename'];
        if(file_exists($file_path)) unlink($file_path);
        db_delete('media', ['id' => $id]);
    }
}

function get_all_media(){
    return db_selectAll('media',[],'created_at DESC');
}
?>