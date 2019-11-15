<?php
/*
	Функция изменяет размер изображения,
	 если передать вместо ширины/высоты 0, то размер изменится пропорционально

	@param string полный путь к файлу изображения
	@param string путь для нового изображения
	@param int    ширина
	@param int    высота
	@param string цвет фона, если (останется свободное место)
	@param int    качество на выходе в %
	
	@return boolean */
function img_resize($src, $out, $width, $height, $color = 0xFFFFFF, $quality = 80) 
{
    // Если файл не существует
    if (!file_exists($src)) {
        return false;  
    }

    // Получаем массив с информацией о размере и формате картинки (mime)
    $size = getimagesize($src);

    // Исходя из формата (mime) картинки, узнаем с каким форматом имеем дело
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    //и какую функцию использовать для ее создания
    $picfunc = 'imagecreatefrom'.$format;

    // Вычилсить горизонтальное соотношение
    $gor = $width  / $size[0];
    // Вертикальное соотношение
    $ver = $height / $size[1];  

    // Если не задана высота, вычислить изходя из ширины, пропорционально
    if ($height == 0) {
        $ver = $gor;
        $height  = $ver * $size[1];
    }
	// Так же если не задана ширина
	elseif ($width == 0) {
        $gor = $ver;
        $width   = $gor * $size[0];
    }

    // Формируем размер изображения
    $ratio   = min($gor, $ver);
    // Нужно ли пропорциональное преобразование
    if ($gor == $ratio)
        $use_gor = true;
    else
        $use_gor = false;

    $new_width   = $use_gor  ? $width  : floor($size[0] * $ratio);
    $new_height  = !$use_gor ? $height : floor($size[1] * $ratio);
    $new_left    = $use_gor  ? 0 : floor(($width - $new_width)   / 2);
    $new_top     = !$use_gor ? 0 : floor(($height - $new_height) / 2);

    $picsrc  = $picfunc($src);
    // Создание изображения в памяти
    $picout = imagecreatetruecolor($width, $height);

    // Заполнение цветом
    imagefill($picout, 0, 0, $color);
    // Нанесение старого на новое
    imagecopyresampled($picout, $picsrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

    // Создание файла изображения
    imagejpeg($picout, $out, $quality);

    // Очистка памяти
    imagedestroy($picsrc);
    imagedestroy($picout);

    return true;
}
?>