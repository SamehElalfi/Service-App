<?php

/**
 * return specific value from config files
 * 
 * @param string $key the key of the config you want to get
 * @param mixed $default =null the default value if this function failed to get the $key
 * 
 * @return mixed
 */
function get_config(String $key, $default = null)
{
  global $base_dir;
  $splitted_key = explode('.', $key);
  $value = include(CONFIG_DIR . '/' . $splitted_key[0] . '.php');

  try {
    foreach (array_slice($splitted_key, 1) as $config_name) {
      $value = $value[$config_name];
    }
  } catch (\Throwable $th) {
    return $default;
  }

  return $value;
}
