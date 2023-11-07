<?php
class Model{
    public function getlogin(){

        if(isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
            if($_REQUEST['username'] == 'test' && $_REQUEST['password'] == 'test'){
                return 'login';
            }else{
                return 'invalid user';
            }
        }
    }
}
?>