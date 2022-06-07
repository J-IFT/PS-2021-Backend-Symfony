<?php
namespace App\Service;

class Reformateur
{
	public function reformaterNombre($nombre)
	{
		$nombre_reformat = number_format($nombre, 0, ",", " ");
		return $nombre_reformat;
	}
}