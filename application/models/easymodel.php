<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
Start writing on Fri, June 20th, 2014
by yopi angi
updated Thu, Oct 7th, 2014
optimazed for postgresql
dev-environment : [
    postgresql: 9.1
    php: 5.5.14
    lampp: 1.8.3
]
*/
class EasyModel extends CI_Model{
    public $_easystr = array();
    protected $_easytable;
    protected $_easycolumn;
    protected $_easyselect = array();
    protected $_easywhere = array();
    protected $_easyjoin = array();
    protected $_easyorderby = array();
    protected $_easylimit = array();
    protected $_easyoffset = array();
    protected $_easysearch = array();
    protected $_easysql = array();
    protected $_errmessage = array();
    public function __construct($table,$column)
    {
        parent::__construct();
        /* first value or index 0 in array $column will be considered as a primary key */
        $this->_easytable = $table;
        $this->_easycolumn = $column;
    }
    public function toSelect($arr=null)
    {
        try{
            if(func_num_args() > 1) throw new Exception("Passing more than 1 arguments, required 1. You can wrap string into array instead", 1);
            if(is_array($arr)){
                array_push($this->_easyselect, implode(",",$arr));
            }elseif(is_string($arr)){
                array_push($this->_easyselect, $arr);
            }else{
                array_push($this->_easyselect, implode(',', $this->_easycolumn));
            }
            return $this;
        }catch(Exception $e){
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    /**
    * Update 14 Oct, 2014 09:59
    * by yopie
    */
    public function toJoin($arr, $join="JOIN")
    {
        try{
            if(strtoupper($join) == "NATURAL JOIN"){
                if(!is_string($arr)) throw new Exception("Passing invalid argument. String required", 1);
                array_push($this->_easyjoin, sprintf("%s %s", strtoupper($join), $arr));
            }else{
                if(!is_array($arr)) throw new Exception("Passing invalid argument. Array required", 1);
                array_push($this->_easyjoin, sprintf("%s %s ON %s", strtoupper($join), implode("", array_keys($arr)), implode("", array_values($arr))));
            }
            return $this;
        }catch(Exception $e){
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toWhere($arr)
    {
        try {
            if(!is_array($arr)) throw new Exception("Passing invalid argument. Array required", 1);
            $countjoin = count($arr);
            if(intval($countjoin) > 0){
                $lastsql = $this->_currentstr();
                $x = implode("", array_keys($arr));
                $y = implode("", array_values($arr));
                if($lastsql['last'] == 'where'){
                    if(intval($countjoin) == 1){
                        array_push($this->_easywhere,sprintf(" AND %s=%s", $x, $this->db->escape($y)));
                    }elseif(intval($countjoin) >= 1){
                        foreach ($arr as $key => $value) {
                            array_push($this->_easywhere, sprintf(" AND %s=%s", $key, $this->db->escape($value)));
                        }
                    }
                }else{
                    $i = 0;
                    foreach ($arr as $key => $value) {
                        if($i==0){
                            array_push($this->_easywhere, sprintf("%s=%s",$key,$this->db->escape($value)));
                        }else{
                            array_push($this->_easywhere, sprintf(" AND %s=%s", $key, $this->db->escape($value)));
                        }
                        $i+=1;
                    }
                }
            }
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toOrderby($str1, $str2)
    {
        try {
            array_push($this->_easyorderby, sprintf(" ORDER BY %s %s", $str1, strtoupper($str2)));
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toLimit($limit)
    {
        try {
            array_push($this->_easylimit, sprintf(" LIMIT %d", $limit));
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toOffset($offset)
    {
        try {
            array_push($this->_easyoffset, sprintf(" OFFSET %d", $offset));
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    /**
    * Search data by pattern matching [LIKE, SIMILAR, NOT SIMILAR TO]
    * http://www.postgresql.org/docs/9.1/static/functions-matching.html
    * Update 11th July, 2014 3:11PM
    * add new option pattern [IS NULL, IS NOT NULL]
    */
    public function toSearch($arr,$pattern='LIKE')
    {
        try {
            if(is_array($arr)){
                $x = implode("", array_keys($arr));
                $y = implode("", array_values($arr));
                $countstr = count($arr);
                if(count($this->_easywhere > 0)){
                        if(intval($countstr) == 1){
                            if(strtoupper($pattern) == 'LIKE'){
                                array_push($this->_easywhere,sprintf(" AND %s LIKE '%s%s%s'", $x, "%",$y, "%"));
                            }elseif(strtoupper($pattern) == 'SIMILAR'){
                                array_push($this->_easywhere,sprintf(" AND %s SIMILAR TO '%s(%s)%s'", $x, "%",$y, "%"));
                            }elseif(strtoupper($pattern) == 'NOT SIMILAR') {
                                array_push($this->_easywhere,sprintf(" AND %s NOT SIMILAR TO '%s(%s)%s'", $x, "%",$y, "%"));
                            }
                        }elseif(intval($countstr) >= 1){
                            if(strtoupper($pattern) == 'LIKE'){
                                foreach ($arr as $key => $value) {
                                    array_push($this->_easywhere, sprintf(" AND %s LIKE '%s%s%s'", $key,"%", $value,"%"));
                                }
                            }elseif(strtoupper($pattern) == 'SIMILAR'){
                                array_push($this->_easywhere, sprintf(" AND %s SIMILAR TO '%s(%s)%s'", $key, "%", implode(), "%"));
                            }elseif (strtoupper($pattern) == 'NOT SIMILAR') {
                                array_push($this->_easywhere, sprintf(" AND %s NOT SIMILAR TO '%s(%s)%s'", $key, "%", implode(), "%"));
                            }
                        }
                }else{
                    $i = 0;
                    if(strtoupper($pattern) == 'LIKE'){
                        foreach ($arr as $key => $value) {
                            if($i==0){
                                array_push($this->_easywhere, sprintf("%s LIKE '%s%s%s'",$key,"%",$value,"%"));
                            }else{
                                array_push($this->_easywhere, sprintf(" AND %s LIKE '%s%s%s'", $key, "%", $value, "%"));
                            }
                            $i+=1;
                        }
                    }elseif (strtoupper($pattern) == 'SIMILAR') {
                        foreach ($arr as $key => $value) {
                            if($i==0){
                                array_push($this->_easywhere, sprintf("%s SIMILAR TO '%s(%s)%s'",$key,"%",$value,"%"));
                            }else{
                                array_push($this->_easywhere, sprintf(" AND %s SIMILAR TO '%s(%s)%s'", $key, "%", $value, "%"));
                            }
                            $i+=1;
                        }
                    }elseif (strtoupper($pattern) == 'NOT SIMILAR') {
                        foreach ($arr as $key => $value) {
                            if($i==0){
                                array_push($this->_easywhere, sprintf("%s NOT SIMILAR TO '%s(%s)%s'",$key,"%",$value,"%"));
                            }else{
                                array_push($this->_easywhere, sprintf(" AND %s NOT SIMILAR TO '%s(%s)%s'", $key, "%", $value, "%"));
                            }
                            $i+=1;
                        }
                    }
                }
            }else{
                if(count($this->_easywhere) > 0){
                    if(strtoupper($pattern) == 'IS NULL'){
                        array_push($this->_easywhere, sprintf(" AND %s IS NULL", $arr));
                    }elseif (strtoupper($pattern) == 'IS NOT NULL') {
                        array_push($this->_easywhere, sprintf(" AND %s IS NOT NULL", $arr));
                    }else{
                        throw new Exception("Error Processing Request", 1);
                    }
                }else{
                    if(strtoupper($pattern) == 'IS NULL'){
                        array_push($this->_easywhere, sprintf(" %s IS NULL", $arr));
                    }elseif (strtoupper($pattern) == 'IS NOT NULL') {
                        array_push($this->_easywhere, sprintf(" %s IS NOT NULL", $arr));
                    }else{
                        throw new Exception("Error Processing Request", 1);
                    }
                }
            }
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toInsert($arr)
    {
        try {
            if($this->_verifycolumn($arr)['result'] === FALSE) throw new Exception('Passing invalid value. Unknown field '.$this->_verifycolumn($arr)['message'], 1);
            $field = array_keys($arr);
            $values = array();
            foreach ($arr as $key => $value) {
                array_push($values, $this->db->escape($value));
            }
            $this->_easystr['insert'] = sprintf("INSERT INTO %s(%s) VALUES(%s)", $this->_easytable, implode(",",$field), implode(",", $values));
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toUpdate($key,$arr)
    {
        try {
            if($this->_verifycolumn($arr)['result'] === FALSE) throw new Exception('Passing invalid value. Unknown field '.$this->_verifycolumn($arr)['message'], 1);
            $values = array();
            foreach ($arr as $k => $v) {
                array_push($values, sprintf("%s=%s", $k, $this->db->escape($v)));
            }
            $this->_easystr['update'] = sprintf("UPDATE %s SET %s WHERE %s=%s", $this->_easytable, implode(",", $values), array_keys($key)[0], $this->db->escape(array_values($key)[0]));
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    public function toDelete($key){
        try {
            if($this->_verifycolumn($key)['result'] === FALSE) throw new Exception('Passing invalid value. Unknown field '.$this->_verifycolumn($key)['message'].' in current table', 1);
            $this->_easystr['delete'] = sprintf("DELETE FROM %s WHERE %s=%s", $this->_easytable, array_keys($key)[0], $this->db->escape(array_values($key)[0]));
            return $this;
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    /**
    * Checking member column
    * @param Array
    * will throw warning message if you supplying unregister field in current table
    */
    private function _verifycolumn($str)
    {
        try {
            if($this->is_assoc($str) === TRUE) {
                foreach ($str as $key => $value)
                {
                    if(!in_array($key, $this->_easycolumn))
                    {
                        throw new Exception($key, 1);
                        break;
                    }
                }
            } else {
                foreach ($str as $key) {
                    if(!in_array($key, $this->_easycolumn))
                    {
                        throw new Exception($key, 1);
                        break;
                    }
                }
            }
            return array('result' => TRUE);
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return $this;
        }
    }
    private function is_assoc($array)
    {
        return (bool)(intval(count(array_filter(array_keys($array), 'is_string'))) > 0 ? TRUE : FALSE);
    }
    public function _currentstr(){
        $countstr = count($this->_easystr);
        $x = array_keys($this->_easystr);
        return array('count' => intval($countstr), 'last' => end($x));
    }
    private function _toind($str){
        $_easyto_ind = "";
        switch ($str) {
            case "insert":
                $_easyto_ind = 'Tambah';
                break;
            case "update":
                $_easyto_ind = 'Edit';
                break;
            case "delete":
                $_easyto_ind = 'Hapus';
                break;
            default:
                $_easyto_ind = $str;
                break;
        }
        return $_easyto_ind;
    }
    public function result(){
        try {
            if(count($this->_errmessage) > 0) throw new Exception(implode('\n',$this->_errmessage), 1);
            $_easysql = array();
            $_easycheck = count(array_intersect(array_keys($this->_easystr), array('insert','update','delete')));
            if(count(array_intersect(array_keys($this->_easystr), array('error'))) > 0) throw new Exception($this->_easystr['error'], 1);

            if(intval($_easycheck) === 1){
                $_easyx = implode("",array_intersect(array_keys($this->_easystr), array('insert','update','delete')));
                $this->db->query(Controls::removespace($this->_easystr[$_easyx]));
                if ($this->db->affected_rows() > 0){
                    $_easyresult = array('result' => 'success','message' => ucwords($_easyx).' is success. Data updated');
                }else{
                    $_easyresult = array('result' => 'failed','message' => ucwords($_easyx).' is fail. Data cannot save');
                }
                unset($this->_easystr);
                $this->_easystr = array();
                return json_encode($_easyresult);
            }elseif(intval($_easycheck) > 1){
                throw new Exception('Error Processing Requests. Not allowed to passing multiple request in once', 1);
            }else {
                if(count($this->_easyselect) > 0){
                    array_push($this->_easysql, sprintf("SELECT %s FROM %s", implode(' ', $this->_easyselect), $this->_easytable));
                }else{
                    array_push($this->_easysql, sprintf("SELECT %s FROM %s", implode(',', $this->_easycolumn), $this->_easytable));
                }
                if(count($this->_easyjoin) > 0){
                    array_push($this->_easysql, sprintf(" %s ", implode(" ", $this->_easyjoin)));
                }
                if(count($this->_easywhere) > 0){
                    array_push($this->_easysql, sprintf(" WHERE %s", implode("", $this->_easywhere)));
                }
                if(count($this->_easyorderby) > 0) {
                    array_push($this->_easysql, sprintf(" %s", implode(" ", $this->_easyorderby)));
                }
                if(count($this->_easylimit) > 0) {
                    array_push($this->_easysql, sprintf(" %s", implode(" ", $this->_easylimit)));
                }
                if(count($this->_easyoffset) > 0) {
                    array_push($this->_easysql, sprintf(" %s", implode(" ", $this->_easyoffset)));
                }
                $_easyquery = $this->db->query(Controls::removespace(implode(" ",$this->_easysql)));
                self::_resetarr();
                return json_encode(array('total' => $_easyquery->num_rows(), 'rows' => $_easyquery->result()));
            }
        } catch (Exception $e) {
            array_push($this->_errmessage, $e->getMessage());
            return json_encode($this->_errmessage);
        }
    }
    private function _resetarr(){
        $this->_easystr = array();
        $this->_easyselect = array();
        $this->_easywhere = array();
        $this->_easyjoin = array();
        $this->_easyorderby = array();
        $this->_easylimit = array();
        $this->_easyoffset = array();
        $this->_easysearch = array();
        $this->_easysql = array();
        $this->_errmessage = array();
    }
}
