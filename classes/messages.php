<?php
class Message
{
    private static $me;
    
   function __construct()
   {
                    
   }
   
   public static function GetMessage()
   {
      if(is_null(self::$me))
          self::$me = new Message();
     return self::$me;
   }  
   
   public function ShowError($msg)
    {     
            return '<div class="error">
                        <span></span>
                        <p>'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowInfo($msg)
    {     
            return '<div class="info">
                      <span></span>
                      <p>'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowSuccess($msg)
    {            
            return '<div class="success">
                      <span></span>
                      <p>'. $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }
    
   public function ShowComment($msg)
    {     
            return '<div class="comment">
                      <span></span>
                      <p>' . $msg .'</p>
                    </div>
                    <div class="badboy"></div>';
    }

}

?>