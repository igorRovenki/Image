<?php
/**
 * Image
 * Class for working with images
 *
 * @author igor <onachenko@gmail.com>
 * @example <br/>
 * <pre>
 * $image = Image::open('test.jpg');
 * $image->resizeToWidth(100);
 * $image->save("test_width.jpg");
 * </pre>
 */
abstract class Image {
    protected $_fileName;
    protected $_width;
    protected $_height;
    protected $_imgData;

    function __construct($dest) 
    {
        if (!file_exists($dest)) {
            throw new Exception("Failed to open file '{$dest}'");
        }
        
        $this->_fileName  = $dest;
        $this->_imgData   = getimagesize($this->_fileName);
        $this->_width     = $this->_imgData[0];
        $this->_height    = $this->_imgData[1];
    }
    
    function getWidth() 
    {
        return $this->_width;
    }
    
    function getHeight() 
    {
        return $this->_height;
    }
    
    /**
     * resize with width and height
     * @param int $width
     * @param int $height 
     */
    function resize($width,  $height) 
    {
        $this->_width = $width;
        $this->_height = $height;
    }
    
    /**
     * resize width saving ratio of image
     * @param int $width 
     */
    function resizeToWidth($width) 
    {
        $ratio = $width / $this->_width;
        $this->_width  = $this->_width * $ratio;
        $this->_height = $this->_height * $ratio;
    }
    
    /**
     * resize height saving ratio of image
     * @param int $height 
     */
    function resizeToHeight($height) 
    {
        $ratio = $height / $this->_height;
        $this->_height = $this->_height * $ratio;
        $this->_width  = $this->_width * $ratio;
    }
    
    /**
     * saves file to the server
     * if parametr is null method saves image with filename giving in constructor <br/>
     * if parametr is not null method saves image with new name
     * @param string $filename 
     */
    abstract public function save($filename=null);
    
    /**
     * Opens file and choose adapter according to the image type
     * @param string $dest
     * @return Image 
     */
    static public function open($dest)
    {
        $imageData = getimagesize($dest);
        switch($imageData[2]) {
            case IMAGETYPE_JPEG : $image = new JpegImage($dest);
                break;
            case IMAGETYPE_GIF  : $image = new GifImage($dest);
                break;
            case IMAGETYPE_PNG  : $image = new PngImage($dest);
                break;
        }
        
        return $image;
    }
}