<?php

//数据类型
echo '<hr/><h3>数据类型</h3>';
echo gettype(12).'<br>';
echo gettype(0.122).'<br>';
echo gettype(true).'<br>';
echo gettype('我胡汉三又回来了').'<br>';
echo gettype(array("钱学森",2,"engineer")).'<br>';
echo gettype(new stdClass()).'<br>';
echo gettype(null).'<br>';
$fp = fopen('./syntax.php','rb');
echo gettype($fp).'<br>';
fclose($fp);



//变量、常量
echo '<hr/><h3>变量与常量</h3>';
$int_var = 12;//integer,整型，用来表示正负整数或0
$float_var = 0.122;//double,浮点型，也叫float,用来表示所有实数
$bool_var = true;//boolean,布尔型，用来表示真假两个值
$str_var = '我胡汉三又回来了'.'<hr/>';//string,字符串类型，用来表示任何字符集合
$arr_var1 = array("钱学森",2,"engineer");//array,数组
$arr_var2 = array("name"=>"詹天佑","gender"=>2,"profession"=>"engineer");//array,数组
$obj_var = new stdClass();//object,对象
$null_var = null;//NULL，没有值或者是已经被unset，或者被显式赋值为null
$res_var = fopen('./syntax.php','rb');//resource,资源类型，一般表示外部资源，文件流或数据库连接等

fclose($res_var);//将上面资源类型演示时打开的文件关闭

define('THIS_IS_A_CONST',2);
const THIS_IS_ANOTHER_CONST = 3;
echo THIS_IS_A_CONST;
echo "<br>";
echo THIS_IS_ANOTHER_CONST;

//const THIS_IS_ANOTHER_CONST = 4;

//控制结构&运算符
echo '<hr/><h3>控制结构&运算符</h3>';
if ($int_var > $float_var) {
  # code...
}elseif ($int_var != $null_var) {
  # code...
}elseif ($bool_var && (11<=$int_var)) {
  # code...
}else {
  # code...
}

while ($int_var >= 10) {
  # code...
  $int_var-=1;
}

do {
  # code...
} while ($int_var >= 10);

for ($i=0; $i < sizeof($arr_var1); $i++) {
  echo $arr_var1[$i].'<br/>';//当int类型与string类型用.操作符进行连接，会发生什么？
}

foreach ($arr_var2 as $key => $value) {
  echo "$key=>$value<br/>";//双引号与单引号的区别是什么？
}

switch ($int_var) {
  case 1:
    # code...
    break;
  case 2:
    # code...
    break;
  default:
    # code...
    break;
}

//函数
echo '<hr/><h3>函数</h3>';
function sum2number($num1, $num2){
  if ('integer' != gettype($num1) && 'double' != gettype($num1)) {
    return '第一个参数不是数字';
  }
  if ('integer' != gettype($num2) && 'double' != gettype($num2)) {
    return '第二个参数不是数字';
  }
  return $num1+$num2;
}
function the_time(){
  return time();
}

echo sum2number(1.2, 65.4);
echo "<br>";
echo the_time();

//作用域
echo '<hr/><h3>作用域</h3>';

#局部变量，全局变量，超全局变量

#1.函数里面访问不到函数外面的值
echo '<h4>在函数内部访问函数外部定义的值</h4>';
$a = 2;
function func_out(){
  echo isset($a)?$a:'没拿到$a的值';
}
func_out();


#2.函数外面访问不到函数里面定义的值
echo '<h4>在函数外部访问函数内部定义的值</h4>';
function func_in(){
  $b = 2;
}
func_in();
echo isset($b)?$b:'没拿到$b的值';

#3.函数内部访问函数外部变量的正确做法
echo '<h4>函数内部访问函数外部变量的正确做法</h4>';
$c = 'I\'m c, I\'m happy';
function change_str_c($str){
  $str = 'I\'m cc after func';
  return $str;
}
echo '此时函数返回是：' . change_str_c($c);
echo '<br/>此时变量$c的值是:' . $c;

#4.函数内部访问函数外部变量并修改它
echo '<h4>函数内部访问函数外部变量并修改它</h4>';
$d = 'I\'m d, I\'m happy';
function change_str_d(&$str){
  $str = 'I\'m dd after func';
  return $str;
}
echo '此时函数返回是：' . change_str_d($d);
echo '<br/>此时变量$d的值是:' . $d;

#4.函数内部访问全局变量
echo '<h4>函数内部通过GLOBALS[]访问全局变量</h4>';
$e = 'I\'m e, I\'m happy';
function change_str_e(){
  $GLOBALS['e'] = 'I\'m ee after func';
}
change_str_e();
echo '此时变量$e的值是:' . $e;

#5.函数内部访问全局变量的另一种方式
echo "<h4>函数内部访问全局变量的另一种方式，global</h4>";
$f = 'I\'m f, I\'m happy';
function change_str_f(){
  global $f;
  $f = 'I\'m ff after func';
}
change_str_f();
echo '此时变量$f的值是:' . $f;

#6.以上两种方式的区别
echo "<h4>以上两种方式的区别</h4>";
$g1 = 'I\'m g1, I\'m happy';
$h1 = 'I\'m h1, I\'m happy';
$g2 = 'I\'m g2, I\'m happy';
$h2 = 'I\'m h2, I\'m happy';
function change_str_g(){
  global $g1,$h1;
  $g1 = &$h1;
  $GLOBALS['g2'] = &$GLOBALS['h2'];
  echo $g1;
  echo "<br>";
  echo $GLOBALS['g2'];
}
change_str_g();
echo '<br>此时变量$g1的值是:' . $g1;
echo '<br>此时变量$g2的值是:' . $g2;

#注意，作用域一般对于函数而言，对于控制结构，变量作用域都是全局

//面向对象
echo '<hr/><h3>面向对象</h3>';
/**
 *狗的基类(父类)
 */
echo "<h4>狗的父类与实例</h4>";
class Dog
{
  public $sounds = '汪';
  public $name;
  function __construct($name)
  {
    $this->name = $name;
  }

  public function watch(){
    echo $this->name.' 看到陌生人就开始 '.$this->sounds;
  }
}

$dog = new Dog('旺财');
$dogofmine = new Dog('小黑');
$dog->watch();
echo "<br>";
$dogofmine->watch();

/**
 *狗的子类
 */
echo "<h4>狗的子类与实例</h4>";
class Hasche extends Dog
{
  public $ropeColor = '红色';
  public function cuteAct(){
    echo $this->name.' 摇动自己 '. $this->ropeColor . ' 色的绳子<br>';
  }
}

$mydog = new Hasche('吉普');
$mydog->cuteAct();
$mydog->watch();


echo "<h4>接口与实现</h4>";
interface iCar
{
  public function fillup();
  public function forward();
  public function stop();
}

/**
 *实现一个接口
 */
class Benz implements iCar
{
  public $color;
  function __construct($color)
  {
    $this->color = $color;
  }
  public function fillup()
  {
    echo "加98号汽油<br>";
  }
  public function forward(){
    echo "向前走了20米<br>";
  }
  public function stop(){
    echo "0.5米秒迅速刹车！<br>";
  }
  public function changeColor($newColor){
    $this->color = $newColor;
  }
  public function showColor(){
    echo $this->color.'<br>';
  }
}

$myBenz = new Benz('红色');
$myBenz->fillup();
$myBenz->forward();
$myBenz->changeColor('橙色');
$myBenz->showColor();
$myBenz->stop();
