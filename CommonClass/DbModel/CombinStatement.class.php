<?php
namespace CommonClass\DbModel;
/**
* Created by PhpStorm.
* User: Administrator
* Date: 2016/10/16
* Time: 9:32
*/
class CombinStatement
{
    /**
     *
     */
    private $_where = null;

    /**
     *
     */
    private $_insert = null;

    /**
     *
     */
    private $_update = null;

    /**
     *
     */
    private $_del = null;

    /**
     *
     */
    private $_limit = null;

    /**
     * 表名字
     */
    private $_tableName = null;

    /**
     *
     */
    private $_execute = null;

    /**
     *
     */
    public function __construct($varTableName = null){
        $this->_tableName = $varTableName;

    }

    /**
     * 设置execution
     */
    public function execute($data){
        $this->_execute = $data;
        return $this;
    }


    /**
     *
     */
    public function where($varData){
        $this->_where = $varData;
        return $this;

    }

    /**
     *
     */
    public function insert($varInsert){
        $this->_insert = $varInsert;
        return $this;

    }
    
    /**
     *
     */
    public function update($varUpdate){
        $this->_update = $varUpdate;
        return $this;

    }

    /**
     *
     */
    public function del($varDel = true){
        $this->_del = $varDel;
        return $this;

    }

    /**
     *
     */
    public function limit($varLimit){
        $this->_limit = $varLimit;
        return $this;

    }

    /**
     * 运行
     */
    public function run(){
        if($this->_tableName){
            $DbObj = M($this->_tableName);
        }

        if($this->_where){
            $DbObj->where($this->_where);
        }

        if($this->_limit){
            $DbObj->limit($this->_limit);
        }

        if(!empty($this->_insert)){
            if(is_array(reset($this->_insert))){
                $result = $DbObj->addAll($this->_insert);
            }else{
                $result = $DbObj->add($this->_insert);
            }
        }elseif(!empty($this->_update)){
            $result = $DbObj->save($this->_update);
        }elseif(!empty($this->_del)){
            $result = $DbObj->delete();
        }elseif($this->_execute){
            $Model = new \Think\Model();
            $result = $Model->db()->execute($this->_execute);
        }
        return $result;
    }

    /**
     * 查看
     */
    public function display(){
        return array(
            'tableName' => $this->_tableName,
            'where' => $this->_where,
            'limit' => $this->_limit,
            'insert' => $this->_insert,
            'update' => $this->_update,
            'del' => $this->_del,
            'execute' => $this->_execute,
        );



    }

}