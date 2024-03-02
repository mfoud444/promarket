
<?php
class Translation
{
    private static $translations = [];
    
    public static function loadTranslations($translationFile)
    {
  
        self::$translations = include($translationFile);
    }
    
 
    public static function get($key, $i = 0)
    {  
      if ($i == 0)
        // Get the translation for the specified key
      {  print isset(self::$translations[$key]) ? self::$translations[$key] : $key;}
      else{
        return isset(self::$translations[$key]) ? self::$translations[$key] : $key;
      }
    }
}

$GLOBALS['t'] = 'Translation::get';
