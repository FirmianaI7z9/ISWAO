<?php
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function setToken(){
  $token = sha1(uniqid(mt_rand(), true));
  $_SESSION['token'] = $token;
}

function checkToken(){
  if(empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])){
    echo 'Invalid POST', PHP_EOL;
    exit;
  }
}

function validation($datas,$confirm = true)
{
  $errors = [];

  if(empty($datas['name'])) {
    $errors['name'] = 'ユーザ名を入力してください。';
  }else if(mb_strlen($datas['name']) > 16) {
    $errors['name'] = '16文字以内で入力してください。';
  }

  if(empty($datas["password"])){
    $errors['password'] = "パスワードを入力してください。";
  }else if(!preg_match('/\A[\w]{8,100}+\z/i',$datas["password"])){
    $errors['password'] = "パスワードは8文字以上16文字以下である必要があり、半角英数字以外の文字は使えません。";
  }
  if($confirm){
    if(empty($datas["confirm_password"])){
      $errors['confirm_password'] = "確認のためもう一度パスワードを入力してください。";
    }else if(empty($errors['password']) && ($datas["password"] != $datas["confirm_password"])){
      $errors['confirm_password'] = "確認用パスワードが一致しません。";
    }
    if(empty($datas["check"]) || $datas["check"] != "TRUE"){
      $errors['check'] = "利用規約およびプライバシーポリシーに同意しない場合はアカウントを作成できません。";
    }
  }

  return $errors;
}

function console_log($data){
  echo '<script>';
  echo 'console.log('.json_encode($data).')';
  echo '</script>';
}

function current_time(){
  $now = new DateTime();
  return $now->format("Y-m-d H:i:s");
}

function format_time($time) {
  $datetime = new DateTime($time);
  return $datetime->format("Y年m月d日 H:i");
}

function is_empty_str($str, $default) {
  if ($str == "") return $default;
  else return $str;
}