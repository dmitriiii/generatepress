<?php
class Kd89Init 
{
	public function __construct(){ 
		foreach(glob(get_template_directory() . "/helper-classes/*.php") as $file){
		  require $file;
		}
	}
} 
new Kd89Init;