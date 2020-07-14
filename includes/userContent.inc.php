<?php

$cntctInfo = array();
$userInfo = new UserInfo();

class UserInfo{
    public $userName;
    public $userEmail;
    public $userPhone;
    function set_userName($userName){
        $this-> userName = $userName;
    }
    function get_userName(){
        return $this->userName;
    }
    function set_userEmail($userEmail){
        $this-> userEmail = $userEmail;
    }
    function get_userEmail(){
        return $this->userEmail;
    }
    function set_userPhone($userPhone){
        $this-> userPhone = $userPhone;
    }
    function get_userPhone(){
        return $this->userPhone;
    }
}

class contractInfo{
  public $contractID;
  public $startD;
  public $endD;
  public $rent;
  public $roomKey;
  public $aptoKey;
  public $damageD;
  public $bcHydro;
  public $internet;
  public $totalPay;
  public $otherPay;

    function set_cncID($contractID) {
      $this->contractID = $contractID;
    }
    function get_cncID() {
      return $this->contractID;
    }
  function set_startD($startD) {
      $this->startD = $startD;
    }
    function get_startD() {
      return $this->startD;
    }

    function set_endD($endD) {
      $this->endD = $endD;
    }
    function get_endD() {
      return $this->endD;
    }

    function set_rent($rent) {
      $this->rent = $rent;
    }
    function get_rent() {
      return $this->rent;
    }
    function set_roomKey($roomKey) {
      $this->roomKey = $roomKey;
    }
    function get_roomKey() {
      return $this->roomKey;
    }
    function set_aptoKey($aptoKey) {
      $this->aptoKey = $aptoKey;
    }
    function get_aptoKey() {
      return $this->aptoKey;
    }
    function set_damageD($damageD) {
      $this->damageD = $damageD;
    }
    function get_damageD() {
      return $this->damageD;
    }
    function set_bcHydro($bcHydro) {
      $this->bcHydro = $bcHydro;
    }
    function get_bcHydro() {
      return $this->bcHydro;
    }
    function set_internet($internet) {
      $this->internet = $internet;
    }
    function get_internet() {
      return $this->internet;
    }
    function set_totalPay($totalPay){
      $this->totalPay = $totalPay;
    }
    function get_totalPay(){
      return $this->totalPay;
    }
    function set_otherPay($otherPay){
      $this->otherPay = $otherPay;
    }
    function get_otherPay(){
      return $this->otherPay;
    }
}