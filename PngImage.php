<?php
/**
 * adapter for PNG files
 * @author igor <onachenko@gmail.com>
 */
class PngImage extends Image
{
    public function save($filename = null)
    {
        $thumb  = imagecreatetruecolor($this->_width, $this->_height);
        $source = imagecreatefrompng($this->_fileName);
        imagecopyresampled(
            $thumb, 
            $source, 
            0, 0, 0, 0, 
            $this->_width, 
            $this->_height, 
            $this->_imgData[0], 
            $this->_imgData[1]
        );
        
        if (!imagepng($thumb, $filename, 9)) {
            throw new Exception("Failed to save file into {$filename}");
        }
    }
}