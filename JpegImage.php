<?php
/**
 * @author igor <onachenko@gmail.com>
 */
class JpegImage extends Image
{
    public function save($filename = null)
    {
        $thumb  = imagecreatetruecolor($this->_width, $this->_height);
        $source = imagecreatefromjpeg($this->_fileName);
        imagecopyresampled(
            $thumb, 
            $source, 
            0, 0, 0, 0, 
            $this->_width, 
            $this->_height, 
            $this->_imgData[0], 
            $this->_imgData[1]
        );
        
        if (!imagejpeg($thumb, $filename, 100)) {
            throw new Exception("Failed to save file into {$filename}");
        }
    }
}