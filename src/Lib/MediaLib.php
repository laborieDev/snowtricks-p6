<?php

namespace App\Lib;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MediaLib
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * Upload Media on Server 
     * @param File file 
     * @param String folder Server Folder Name
     * @param String name New Name of Media
     * @return Array response 
     */
    public function uploadMedia(File $file, $folder, $name = null)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        if($name == null){
            $newFilename = $this->setNameForUrl($originalFilename);
        } else {
            $newFilename = $this->setNameForUrl($name);
        }

        $newFilename = $newFilename.'-'.uniqid().'.'.$file->guessExtension();
        
        try {
            $file->move($folder,$newFilename);
            $isUpload = true;
            $data =  $newFilename;
        } catch (FileException $e) {
            $isUpload = false;
            $data =  "Error get an image : ".$e;
        }

        return[
            "is_upload" => $isUpload,
            "data" => $data
        ];
    }

     /**
     * Create an image with Entity Media
     * @param Media image 
     * @param File file 
     * @param String name New Name of Media
     * @param String folder Server Folder Name
     * @param Figure figure
     * @return Media image
     */
    public function setImage(Media $image, File $file, $name, $folder, $figure = null)
    {
        $upload = $this->uploadMedia($file, $folder, $name);

        if($upload['is_upload']){
            $fileName = $upload['data'];
            $image->setName($name);
            $image->setImgSrc($folder."/".$fileName);
            $image->setIsImage(true);
            $image->setFigure($figure);

            $this->entityManager->persist($image);
            $this->entityManager->flush();

            return $image;
        }

        return null;
    }

    /**
     * Create an image with Entity Media
     * @param File file 
     * @param String name New Name of Media
     * @param String folder Server Folder Name
     * @return Media image
     */
    public function addImage(File $file, $name, $folder, $figure = null)
    {
        $image = new Media();
        $image = $this->setImage($image, $file, $name, $folder, $figure);

        return $image;
    }

     /**
     * Upload Media on Server
     * @param String name New Name of Media
     * @return String new name 
     */
    public function setNameForUrl($name)
    {
        $name = strtolower($name);
        $name = str_replace(" ","_",$name);

        return $name;
    }

    /**
     * Remove Media 
     * @param Media $media
     */
    public function removeMedia(Media $media)
    {
        if ($media->getImgSrc() != null) {
            $filePath = $media->getImgSrc();
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $this->entityManager->remove($media);
        $this->entityManager->flush();
    }
}
