<?php
/**
 * This file is part of the sfFilebase symfony plugin.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfFilebasePluginImage is a special sfFilebasePluginFile which represents an
 * image file.
 *
 * @see        SplFileInfo
 * @see        sfFilebasePluginFile
 * @package    de.optimusprime.sfFilebasePlugin
 * @author     Johannes Heinen <johannes.heinen@gmail.com>
 * @copyright  Johannes Heinen <johannes.heinen@gmail.com>
 */
class sfFilebasePluginImage extends sfFilebasePluginFile
{
  public function resize(array $dimensions, $quality = 60)
  {
    return $this->filebase->resizeImage($this, $dimensions, $quality);
  }
  
  /**
   * Returns thumbnail for an image file.
   *
   * @param mixed sfFilebasePluginFile | string $file
   * @param array $dimensions = array(width, height)
   * @return sfFilebasePluginFile $file
   */
  public function getThumbnail(array $dimensions, $quality = 60, $mime='image/png')
  {
    return $this->filebase->getThumbnailForImage($this, $dimensions, $quality, $mime);
  }

  /**
   * Returns size of image
   *
   * @return array
   */
  public function getImagesize()
  {
    return $this->getDimensions();
  }
  
  /**
   * Returns width of image
   * 
   * @return integer $width
   */
  public function getWidth()
  {
    $dims = $this->getDimensions();
    return $dims[0];
  }

  /**
   * Returns height of image
   *
   * @return integer $height
   */
  public function getHeight()
  {
    $dims = $this->getDimensions();
    return $dims[1];
  }

  /**
   * Returns Image-Dimensions as an array.
   * {0: width, 1: height, 'width': width, 'height' : height }
   *
   * This is a wrapper function for sfFilebasePluginImage::getImageSize()
   *
   * @return array $image_dimensions
   * @throws sfFilebasePluginException
   */
  public function getDimensions()
  {
    if(!$this->fileExists()) throw new sfFilebasePluginException(sprintf('File %s does not exist.', $this->getPathname()));
    if(!$this->isReadable()) throw new sfFilebasePluginException(sprintf('File %s is read protected.', $this->getPathname()));
    if(!function_exists('getimagesize')) throw new sfFilebasePluginException('FilebaseFile::getDimensions() cannot be executed, function getimagesize does not exist.');
    if($this->isImage())
    {
      $is = getimagesize($this);
      return array(0 => $is[0], 1 => $is[1], 'width'=>$is[0], 'height'=>$is[1]);
    }
  }

  /**
   * Reads exif info from image files
   *
   * @return sfFilebasePluginFileExif $exif
   */
  public function readExif()
  {
    if(!$this->fileExists()) throw new sfFilebasePluginException(sprintf('File %s does not exist.', $this->getPathname()));
    if(!$this->isImage()) throw new sfFilebasePluginException(sprintf('File %s is no image file.', $this->getPathname()));
    if(!$this->isReadable()) throw new sfFilebasePluginException(sprintf('File %s is read protected.', $this->getPathname()));
    if(!function_exists('exif_imagetype')) throw new sfFilebasePluginException(sprintf('Exif extension currently not installed. Follow the instructions on http://php.net/manual/en/exif.setup.php to install it.'));

    $image_type = exif_imagetype($this);
    if($image_type == IMAGETYPE_JPEG || $image_type == IMAGETYPE_TIFF_II || $image_type == IMAGETYPE_TIFF_MM)
    {
       return new sfFilebasePluginFileExif($this);
    }
    else throw new sfFilebasePluginException(sprintf('Image type %s hat no build-in support for exif metadata.', $this->getExtension()));
  }

  /**
   * Rotates an image to $deg degree
   * @param float  $deg: The amount to rotate
   * @param string $bgcolor: The background color of the rotated image, #00000
   *                         as default, in html-hexadecimal notation.
   * @return sfFilebasePluginImage $image: THe rotated image
   */
  public function rotate($deg, $bgcolor = '#000000')
  {
    return $this->filebase->rotateImage($this, $deg, $bgcolor);
  }
}