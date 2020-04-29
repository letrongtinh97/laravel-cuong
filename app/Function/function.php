<?php
	function alert($errors , $session){
	    if ($session) {
		    echo    '<div class="alert alert-success">
                        '.$session.'  
                    </div>';
	    }
        
        if (count($errors) > 0) {
            foreach ($errors->all() as $err) {
                echo    '<div class="alert alert-danger">
        	               '.$err.' <br>
        	            </div>';
            }
        }
        return $errors . $session;
	}

    function checkScript($str){
        $flag = false;
        $content = $str;
        $pattern = '/(<\/?script)/';
        $replace = ' ';
        if (preg_match($pattern , $content)) {
            preg_replace($pattern, $replace , $content);
            $flag = true;
        }
        return $flag;
    }

    function checkLevel($condition){
        if (Auth::user()->level == $condition || Auth::user()->level < $condition) {
            $alert = 'onclick="alertLevel()"';
        }else{
            $alert = '';
        }
        return $alert;
    }

?>