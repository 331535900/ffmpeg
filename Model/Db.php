<?php
class Model{
  //保存链接信息
  public static $link=NULL;
  //保存表名
  protected $table=NULL;
  //初始化表信息
  private $opt;
  //记录发送的sql
  public static $sqls=array();
    
  public static $sql=array();


   private static  $db_database='zhuanma';
   private static  $db_host='127.0.0.1';
   private static  $db_user='zhuanma';
   private static  $db_password='aEyxfe8bWbn7rAtE';
   private static  $db_port='3306';
   private static  $db_prefix='';

	public function __construct($table=NULL){
		$this->table = is_null($table)?self::$db_prefix.$this->table:self::$db_prefix.$table;
		//链接数据库
		$this->_connect();
		//初始化sql信息
		$this->_opt();
	}
	private function _opt(){
		$this->opt=array(
             'field' =>'*',
             'where' =>'',
             'group' =>'',
             'having'=>'',
             'order' =>'',
             'limit' =>''
			);
	}
	/**
	 * _connect 链接数据库
	 */
	private  function _connect(){

      if(is_null(self::$link)){
      	if(empty(self::$db_database)) echo('请先配置数据库');
        $link=new Mysqli(self::$db_host,self::$db_user,self::$db_password,self::$db_database,self::$db_port);
          if($link->connect_error)echo('数据库链接错误 请检查配置项');
        $link->set_charset('utf8');
        self::$link=$link;
      }
	}

    //sql执行
    public function query($sql){
	   $info_array=[];
       self::$sqls[]=$sql;
       $link=self::$link;
       $result=$link->query($sql);
       if($link->error)echo('mysql错误:'.$link->error.'<br/>SQL:'.$sql);
       for ($i=0; $i <$result->num_rows ; $i++) { 
       	$info_array[]=$result->fetch_assoc();
       }
       return $info_array;
    }
    //all方法
    public function all(){
      $sql='SELECT ' .$this->opt['field']. ' FROM ' .$this->table . $this->opt['where']. $this->opt['group']. $this->opt['having']. $this->opt['order']. $this->opt['limit'];
      return $this->query($sql);
    }
    //field方法
    public function field($field){
      $this->opt['field']=$field;
      return $this;
    }
    //where方法
    public function where($where){
      $this->opt['where']=' WHERE '.$where;
      return $this;
    }
    //group方法
    public function group($group){
      $this->opt['group']=' GROUP BY '.$group;
      return $this;
    }
    //group方法
    public function having($having){
      $this->opt['having']=' HAVING '.$having;
      return $this;
    }
    //group方法
    public function order($order){
      $this->opt['order']=' ORDER '.$order;
      return $this;
    }
    //group方法
    public function limit($limit){
      $this->opt['limit']=' LIMIT '.$limit;
      return $this;
    }
    //find方法
    public function find(){
      $info=$this->limit(1)->all();
      return isset($info[0])?$info[0]:[];
    }
	//delete方法
	public function delete(){
		if(empty($this->opt['where']))echo('删除必须有where条件');
		$sql='DELETE FROM '.$this->table .$this->opt['where'];
		return $this->exe($sql);
	}
	//add方法
	public function add($data=NULL){
		if(is_null($data)) $data=$_POST; 
		$sqlstring='';
		foreach($data as $k=>$v){
			$sqlstring.="`".$k."`='".$v."',";
		}
		$sqlstring= trim($sqlstring,',');
		$addsql='INSERT INTO '.$this->table.' SET '.$sqlstring;
		return $this->exe($addsql);
	}
    //用于增删改语句 exe
    public function exe($sql){
      self::$sql[]=$sql;
      $link =self::$link;
      $bool =$link->query($sql);
      $this->_opt();
      if(is_object($bool)){
         echo('请用query方法查询sql');
      }
      if($bool){
        return $link->insert_id ?$link->insert_id:$link->affected_rows;
      }else{
         echo('mysql错误：'.$link->error.'<br/>');
      }
    } 
	
	//接受字符串安全处理
	private function _safe_str($str){
		//判断系统是否开启了转义 如果开通了 就需要反转义
		if(get_magic_quotes_gpc()){
			$str=stripcslashes($str);
		}
		return self::$link->real_escape_sting($str);
	}

}
