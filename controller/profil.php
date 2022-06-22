<?php
require_once 'model/GetInfos.php';
$getinfo = new GetInfos();
require_once 'model/Registration.php';
$register = new Registration();
$id = $_SESSION['user']['id'];

if (isset($_POST['submit'])){
   $data['id'] = $id;
   $data['pseudo'] = htmlspecialchars($_POST['pseudo'])??'';
   $data['email'] = htmlspecialchars($_POST['email'])??'';
   $data['number_road'] = htmlspecialchars($_POST['number_road'])??'';
   $data['address'] = htmlspecialchars($_POST['address'])??'';
   $data['postal_code'] = htmlspecialchars($_POST['postal_code'])??'';
   $data['city'] = htmlspecialchars($_POST['city'])??'';
   $register->updateUser($data);
}

$info_user = $getinfo->getInfoUser($id);
$info_def = $getinfo->getUserDefunctList($id)->fetchAll();
$nbr = count($info_def);

require 'view/profil.php';
