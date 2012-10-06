<?php
/**
 * adapter for GIF files
 * @author igor <onachenko@gmail.com>
 */
class GifImage extends Image
{
    public function save($filename = null)
    {
        $thumb  = imagecreatetruecolor($this->_width, $this->_height);
        $source = imagecreatefromgif($this->_fileName);
        imagecopyresampled(
            $thumb, 
            $source, 
            0, 0, 0, 0, 
            $this->_width, 
            $this->_height, 
            $this->_imgData[0], 
            $this->_imgData[1]
        );
        
        if (!imagegif($thumb, $filename, 100)) {
            throw new Exception("Failed to save file into {$filename}");
        }
    }
}