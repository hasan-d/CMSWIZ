<?php
function db_insert($table, $data){
    global $conn;
    $columns = implode(', ',array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $types = '';
    $values = [];
    foreach($data as $key => $value){
        $types .= is_int($value) ? 'i' : (is_float($value) ? 'd' : 's');
        $values[]=$value;
    }
    $stmt = $conn->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})");
    
    if(!$stmt) return false;
    $stmt->bind_param($types, ...$values);
    return $stmt->execute() ? $stmt->insert_id : false;
}

function db_selectOne($table, $where = [], $columns = '*'){
    global $conn;
    $sql = "SELECT {$columns} FROM {$table}";
    $types = '';
    $values = [];
    if (!empty($where)){
        $conditions = [];
        foreach($where as $key =>$value){
            $conditions[] = "{$key} = ?";
            $types .= is_int($value) ? 'i' :'s';
            $values[] = $value;
        }
        $sql .= " WHERE " . implode(' AND ', $conditions);
    }
    $sql .= " LIMIT 1";
    $stmt = $conn->prepare($sql);
    if(!$stmt) return null;
    if(!empty($values)) $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function db_selectAll($table, $where = [], $order='', $columns = '*'){
    global $conn;
    $sql = "SELECT {$columns} FROM {$table}";
    $types = '';
    $values = [];
    if(!empty($where)){
        $conditions = [];
        foreach($where as $key => $value){
        $conditions[] = "{$key} = ?";
        $types .= is_int($value) ? 'i' :'s';
        $values[] = $value;
    }
    $sql .= " WHERE " . implode(' AND ', $conditions);
    }
    if($order) $sql .= " ORDER BY {$order}";
    $stmt  = $conn->prepare($sql);
    if(!$stmt) return [];
    if(!empty($values)) $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function db_update($table, $data, $where){
    global $conn;
    $set = [];
    $types = '';
    $values = [];
    foreach($data as $key => $value){
        $set[] = "{$key} = ?";
        $types .= is_int($value) ? 'i' : 's';
        $values[] = $value;
    }
    $conditions = [];
    foreach($where as $key => $value){
        $conditions[] ="{$key} = ?";
        $types .= is_int($value) ? 'i' : 's';
        $values[] = $value;
    }
    $sql = "UPDATE {$table} SET " . implode(', ', $set) . " WHERE " . implode(' AND ', $conditions);
    $stmt = $conn->prepare($sql);
    if(!$stmt) return false;
    $stmt->bind_param($types, ...$values);
    return $stmt->execute();
}


function db_delete($table, $where){
    global $conn;
    $conditions = [];
    $types = '';
    $values = [];
    foreach($where as $key => $value){
        $conditions[]="{$key} = ?";
        $types .= is_int($value) ? 'i' : 's';
        $values[] = $value;
    }
    $sql = " DELETE FROM {$table} WHERE " . implode(' AND ', $conditions);
    $stmt = $conn->prepare($sql);
    if(!$stmt) return false;
    $stmt->bind_param($types, ...$values);
    return $stmt->execute();
}
?>