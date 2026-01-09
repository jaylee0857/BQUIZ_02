<?php
// 開啟session與時區
session_start();
// date_default_timezone_get("Asia/Taipei"); // get set傻傻分不清楚
date_default_timezone_set("Asia/Taipei");

function dd($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function to($url){
    header("location:$url");
}


class DB {
    // dsn連線

    private $dsn = "mysql:host=localhost;dbname=db02_1;charset=utf8;"; // urf8不是utf-8
    // mysql:host=localhost;dbname=db01_2;charset=utf8;

    private $table;
    private $pdo;

    function __construct($table){
        $this->table = $table;
        $this->pdo = new PDO($this->dsn,'root',''); // dns, 帳號, 密碼
    }

    function array_to_sql($array){ //輸入輸出都是陣列, 就是做格式作轉 ['sh'=> 1] ["`sh` = '1'"]
        $tmp=[];
        foreach ($array as $key => $value) {
            $tmp[]="`$key` = '$value'";
        }
        return $tmp;
    }
    // all find del save count max sum
    function all(...$arg){
        $sql="SELECT * FROM `$this->table` ";
        if(isset($arg[0])) {
            if(is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); // return
    }

    function find($id){
        $sql="SELECT * FROM `$this->table` ";
        if(is_array($id)) {
            $tmp = $this->array_to_sql($id);
            $sql .= " WHERE " . join(" AND ", $tmp);
        }else{
            $sql .= " WHERE `id` = '$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    
    function del($id){
        $sql="DELETE FROM `$this->table` ";
        if(is_array($id)) {
            $tmp = $this->array_to_sql($id);
            $sql .= " WHERE " . join(" AND ", $tmp);
        }else{
            $sql .= " WHERE `id` = '$id'";
        }
        return $this->pdo->exec($sql); // 刪除沒有回傳故要改exec
    }

    function save($array){ // 一定會放array因為通常會傳送$_POST 
        if (isset($array['id'])) {    //isset檢查有沒有這個key
            // 編輯 有id
            $id = $array['id']; //先存ID
            unset($array['id']); // 移除陣列內的ID因為這樣更新會有風險很愚蠢
            $sql = "UPDATE `$this->table` SET ";
            $tmp = $this->array_to_sql($array); //一樣要做陣列轉陣列[字串]處理
            // $sql .= join(" AND ", $tmp) . " WHERE `id` = '$id'"; 這是錯的 因為WHERE才是用AND間隔

            $sql .= join(",", $tmp) . " WHERE `id` = '$id'"; // UPDATE 的更新資料之間用逗號即可
        }else{
            // 新增
            $cols = join("`,`",array_keys($array));
            $values = join("','", $array);
            // $sql .= "(`" .$keys."`)" . "VALUES('" .$values ."')";   這版本太複雜
            $sql = "INSERT INTO `$this->table` (`$cols`) VALUES('$values')"; // 1行搞定

        }
        return $this->pdo->exec($sql);
    }

    function count(...$arg){
        $sql="SELECT COUNT(*) FROM `$this->table` ";
        if(isset($arg[0])) {
            if(is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn(); // return
    }

    function max($col,...$arg){
        $sql="SELECT MAX(`$col`) FROM `$this->table` ";
        if(isset($arg[0])) {
            if(is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn(); // return
    }
    function sum($col,...$arg){
        $sql="SELECT SUM(`$col`) FROM `$this->table` ";
        if(isset($arg[0])) {
            if(is_array($arg[0])) {
                $tmp = $this->array_to_sql($arg[0]);
                $sql .= " WHERE " . join(" AND ", $tmp);
            }else{
                $sql .= $arg[0];
            }
        }
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
        return $this->pdo->query($sql)->fetchColumn(); // return
    }

}

$Title = new DB('title');
$Ad = new DB('ad');
$Mvim= new DB('mvim');
$Image = new DB('image');
$Total = new DB('total');
$Bottom = new DB('bottom');
$News = new DB('news');
$Admin = new DB('admin');
$Menu = new DB('menu');

if (!isset($_SESSION['visit'])) {
    $_SESSION['visit'] = $Total->find(1);
    $t = $_SESSION['visit']['total']+1;
    $Total->save(['id'=>1,'total'=>$t]);
}

?>