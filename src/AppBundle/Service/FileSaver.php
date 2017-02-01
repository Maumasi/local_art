<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 11:20 PM
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileSaver
{

    private $uploadDir;

    public function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function img(UploadedFile $img)
    {
        $itemImg = md5(uniqid()).'.'.$img->guessExtension();

        $img->move($this->uploadDir, $itemImg);

        return $itemImg;
    }

}